<?php

namespace App\Services;

use App\Interfaces\PackRepositoryInterface;

class OrderService
{
    private PackRepositoryInterface $packRepository;

    public function __construct(PackRepositoryInterface $packRepository)
    {
        $this->packRepository = $packRepository;
    }

    public function calculateOrder(array $orderDetails): array
    {
        $sub_total = $this->packRepository->getSubTotalByPackIds($orderDetails['order_packs']);
        $gst = $sub_total * 0.07;
        $grand_total = $sub_total + $gst;
        if (isset($orderDetails['promo_code'])) {
            $promoCode = $orderDetails['promo_code'];
            $promo_code_code = $promoCode->code;
            $promo_code_description = $promoCode->description;
            $promo_code_discount = $promoCode->discount;
            $promo_code_id = $promoCode->id;

            if ($promo_code_discount > $grand_total) {
                $discount = $grand_total;
            } else {
                $discount = $promo_code_discount;
            }

            $grand_total = $grand_total - $discount;
        } else {
            $promo_code_code = null;
            $promo_code_description = null;
            $promo_code_discount = 0;
            $discount = 0;
            $promo_code_id = null;
        }

        return [
            'sub_total' => $sub_total,
            'gst' => $gst,
            'discount' => $discount,
            'grand_total' => $grand_total,
            'promo_code_code' => $promo_code_code,
            'promo_code_description' => $promo_code_description,
            'promo_code_discount' => $promo_code_discount,
            'promo_code_id' => $promo_code_id,
        ];
    }
}
