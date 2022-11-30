<?php

namespace App\Repositories;

use App\Interfaces\PromoCodeRepositoryInterface;
use App\Models\PromoCode;

class PromoCodeRepository implements PromoCodeRepositoryInterface
{
    public function getPromoCodeByCode(string $code): ?PromoCode
    {
        return PromoCode::query()->where('code', $code)->first();
    }

    public function getPromoCodeByid(int $id): ?PromoCode
    {
        return PromoCode::query()->find($id);
    }
}
