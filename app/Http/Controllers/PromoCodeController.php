<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromoCodeCheckRequest;
use App\Interfaces\PromoCodeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PromoCodeController extends Controller
{

    private PromoCodeRepositoryInterface $promoCodeRepository;

    public function __construct(PromoCodeRepositoryInterface $promoCodeRepository)
    {
        $this->promoCodeRepository = $promoCodeRepository;
    }

    public function check(PromoCodeCheckRequest $request)
    {
        $code = $request->input('code');
        $promoCode = $this->promoCodeRepository->getPromoCodeByCode($code);
        if ($promoCode) {
            return response()
                ->json([
                    "errorCode" => 0,
                    "message" => "Success",
                    'data' =>  $promoCode,
                ], Response::HTTP_OK);
        } else {
            return response()
                ->json([
                    "errorCode" => 1,
                    "message" => "Promo code not found",
                ], Response::HTTP_NOT_FOUND);
        }
    }
}
