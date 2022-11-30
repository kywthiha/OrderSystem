<?php

namespace App\Observers;

use App\Interfaces\ActivityLogRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ActivityLogObserver
{
    public $afterCommit = true;


    private ActivityLogRepositoryInterface $activityLogRepository;

    public function __construct(ActivityLogRepositoryInterface $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }




    private function storeLog(Model $model)
    {
        $logData = [
            'action' => $model->getTable() . '_' . $model->getKey() . '_' . debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'],
            'data' => $model->getAttributes(),
            'user_id' => auth()->id() ?? null,
            'user_name' => auth()->user()->name ?? null,
            'request_ip' => request()->ip(),
            'request_user_agent' => request()->userAgent(),
            'request_url' => request()->fullUrl(),
            'request_method' => request()->method(),
            'request_headers' => request()->headers->all(),
            'request_input' => request()->all(),
            'request_query' => request()->query(),
            'request_server' => request()->server()
        ];

        try {
            Log::info('ActivityLogObserver: ' . $model->getTable() . '_' . $model->getKey() . '_' . debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'], $logData);
        } catch (\Exception $e) {
            Log::error('ActivityLogObserver: ' . $e->getMessage());
        }
        $this->activityLogRepository->storeLog($model, $logData);
    }

    public function created(Model $model)
    {
        $this->storeLog($model);
    }


    public function updated(Model $model)
    {
        $this->storeLog($model);
    }


    public function deleted(Model $model)
    {
        $this->storeLog($model);
    }


    public function restored(Model $model)
    {
        $this->storeLog($model);
    }


    public function forceDeleted(Model $model)
    {
        $this->storeLog($model);
    }
}
