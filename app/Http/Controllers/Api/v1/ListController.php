<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Managers\TaskManager;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    public function inbox(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getInboxList());
    }

    public function today(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getTodayList());
    }

    public function any(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getAnyList());
    }

    public function tomorrow(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getTomorrowList());
    }

    public function archive(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getArchiveList());
    }

    public function schedule(TaskManager $taskManager)
    {
        return JsonResource::collection($taskManager->getScheduledList());
    }
}
