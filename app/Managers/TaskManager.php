<?php


namespace App\Managers;


use App\Enums\CompletionStatusEnum;
use App\Models\Task;
use Carbon\Carbon;

class TaskManager
{
    //todo добавить события
    public function create(int $userId, array $data)
    {
        $task = new Task($data);
        $task->user_id = $userId;
        $task->saveOrFail();
//        event();

        return $task;
    }

    //todo добавить события
    public function complete(Task $task, CompletionStatusEnum $status)
    {
        $task->is_complete = true;
        $task->completion_date = Carbon::now();
        $task->completion_status = $status;
        $task->saveOrFail();
//        event();

        return $task;
    }


}
