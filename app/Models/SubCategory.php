<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'created_user',
        'updated_user'
    ];

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
                $query->where('name', 'like', "%{$search}%");
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
