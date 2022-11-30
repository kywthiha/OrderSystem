<?php

namespace App\Repositories;

use App\Interfaces\ActivityLogRepositoryInterface;
use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    public function storeLog(Model $model, array $data): void
    {
        try {
            ActivityLog::create($data);
        } catch (\Exception $e) {
            Log::error('ActivityLog Database Store:' . $e->getMessage());
        }
    }
}
