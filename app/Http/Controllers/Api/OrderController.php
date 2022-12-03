<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends BaseApiController
{

    private OrderRepositoryInterface $orderRepository;
    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = $this->orderRepository->getAll($request->q, $request->sort, ["user_id" => auth()->user()->id]);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $orders,
            ], Response::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $order = $this->orderRepository->store([
                'user_id' => auth()->id(),
                'note' => $request->note
            ], $request->orderItems);

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        $order = $this->orderRepository->show($order);
        return  response()
            ->json([
                "errorCode" => 0,
                "message" => "Success",
                'data' =>  $order,
            ], Response::HTTP_OK);
    }
}
