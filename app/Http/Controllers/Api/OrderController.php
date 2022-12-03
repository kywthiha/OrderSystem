<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PromoCodeRepositoryInterface;
use App\Models\Order;
use App\Models\Pack;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{

    private OrderRepositoryInterface $orderRepository;
    private PromoCodeRepositoryInterface $promoCodeRepository;
    private OrderService $orderService;

    public function __construct(OrderRepositoryInterface $orderRepository, PromoCodeRepositoryInterface $promoCodeRepositoryInterface, OrderService $orderService)
    {
        $this->orderRepository = $orderRepository;
        $this->promoCodeRepository = $promoCodeRepositoryInterface;
        $this->orderService = $orderService;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            $orderDetails = $request->validated();

            if(isset($orderDetails['promo_code'])){
                $promoCode = $this->promoCodeRepository->getPromoCodeByCode($orderDetails['promo_code']);

                if ($promoCode) {
                    $orderDetails['promo_code'] = $promoCode;
                } else {
                    return response()
                        ->json([
                            "errorCode" => 1,
                            "message" => "Promo code not found",
                        ], Response::HTTP_NOT_FOUND);
                }
            }


            $order = $this->orderRepository->storeOrder([
                'order_packs' => $orderDetails['order_packs'],
                'user_id' => auth()->id(),
            ] + $this->orderService->calculateOrder($orderDetails));

            return response()
                ->json([
                    "errorCode" => 0,
                    "message" => "Success",
                    'data' =>  $order,
                ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()
                ->json([
                    "errorCode" => 1,
                    "message" => $e->getMessage(),
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
