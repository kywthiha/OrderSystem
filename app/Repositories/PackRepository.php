<?php

namespace App\Repositories;

use App\Interfaces\PackRepositoryInterface;
use App\Models\Pack;
use Illuminate\Support\Facades\Hash;

class PackRepository implements PackRepositoryInterface
{
    public function getAll(): array
    {
        return [
            "total_item" => 6,
            "total_page" => 1,
            "mem_tier" => "newbie",
            "total_expired_class" => 0,
            "pack_list" => Pack::query()->latest('disp_order')->take(6)->get(),
        ];
    }

    public function getDetailByPack(Pack $pack): Pack
    {

        return $pack;
    }

    public function getSubTotalByPackIds(array $order_packs): float
    {
        return Pack::query()->whereIn('pack_id', $order_packs)->sum('pack_price');
    }
}
