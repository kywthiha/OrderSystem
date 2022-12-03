<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount',
        'note',
        'user_id'
    ];


    public function items()
    {
        return $this->belongsToMany(Item::class)->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeSearch($query, string $search = null)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('users.name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%");
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

    public function scopeFilter($query,  $data)
    {
        if ($data && is_array($data)) {
            foreach ($data as $key => $value) {
                if ($value) {
                    $query->where($key, $value);
                }
            }
        }
    }
}
