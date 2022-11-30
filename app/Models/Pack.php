<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pack extends Model
{
    use HasFactory, SoftDeletes;

    const PACK_TYPE_NON_SHAREABLE = 'non_shareable';
    const PACK_TYPE_SHAREABLE = 'shareable';
    const PACK_TYPE_UNLIMITED = 'unlimited';

    const PACK_TYPE = [
        'PACK_TYPE_NON_SHAREABLE' => self::PACK_TYPE_NON_SHAREABLE,
        'PACK_TYPE_SHAREABLE' => self::PACK_TYPE_SHAREABLE,
        'PACK_TYPE_UNLIMITED' => self::PACK_TYPE_UNLIMITED,
    ];

    const TAG_NAME = [
        'New',
        'Limited',
        'Popular',
        null,
    ];

    protected $fillable = [
        'disp_order',
        'pack_id',
        'pack_name',
        'pack_description',
        'pack_type',
        'total_credit',
        'tag_name',
        'validity_month',
        'pack_price',
        'newbie_first_attend',
        'newbie_addition_credit',
        'newbie_note',
        'pack_alias',
        'estimate_price',
    ];

    protected $primaryKey = 'pack_id';

    protected $keyType = 'string';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->pack_id = Str::uuid()->toString();
            $model->disp_order = $model->max('disp_order') + 1;
            $model->estimate_price = $model->total_credit ? round($model->pack_price / $model->total_credit, 2) : $model->total_credit;
        });
    }
}
