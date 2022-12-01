<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'sub_category_id',
        'created_user',
        'updated_user'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_user');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_user');
    }

    public function scopeSearch($query, string $search = null)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('items.name', 'like', "%{$search}%")
                    ->orWhere('categories.name', 'like', "%{$search}%")
                    ->orWhere('sub_categories.name', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    public function scopeOrder($query,  $data)
    {
        if ($data && is_array($data)) {
            foreach ($data as $key => $value) {
                $query->orderBy($key, $value);
            }
        }
    }
}
