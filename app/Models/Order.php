<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_total',
        'gst',
        'discount',
        'grand_total',
        'promo_code_code',
        'promo_code_description',
        'promo_code_discount',
        'promo_code_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function orderPacks()
    {
        return $this->belongsToMany(Pack::class, 'order_packs','order_id', 'pack_id')->withTimestamps();
    }


}
