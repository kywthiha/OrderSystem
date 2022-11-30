<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'json',
        'request_headers' => 'json',
        'request_input' => 'json',
        'request_query' => 'json',
        'request_server' => 'json',
    ];

    protected $fillable = [
        'action',
        'data',
        'user_id',
        'user_name',
        'request_ip',
        'request_user_agent',
        'request_url',
        'request_method',
        'request_headers',
        'request_input',
        'request_query',
        'request_server',
    ];
}
