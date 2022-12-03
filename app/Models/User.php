<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_activate',
        'created_user',
        'updated_user'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeSearch($query, string $search = null)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
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

    public function scopeIsAdmin($query)
    {
        return $query->where('is_admin', true);
    }

    public function scopeIsUser($query)
    {
        return $query->where('is_admin', false);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_user');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_user');
    }
}
