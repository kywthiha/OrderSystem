<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface ActivityLogRepositoryInterface
{
    public function storeLog(Model $model,array $data): void;
}
