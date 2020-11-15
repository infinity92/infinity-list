<?php


namespace App\Managers;


use App\Enums\CompletionStatusEnum;
use App\Events\AfterCreateTask;
use App\Events\AfterDuplicateTask;
use App\Events\AfterUpdateTask;
use App\Events\BeforeCreateTask;
use App\Events\BeforeDeleteTask;
use App\Events\BeforeDuplicateTask;
use App\Events\BeforeUpdateTask;
use App\Events\CompleteTask;
use App\Events\RestoreTask;
use App\Models\Task;
use Carbon\Carbon;

class TaskManager
{
    /**
     * Create the new task
     *
     * @param int $userId
     * @param array $data
     * @return Task
     * @throws \Throwable
     */
    public function create(int $userId, array $data)
    {
        event(new BeforeCreateTask($data));
        $task = new Task($data);
        $task->user_id = $userId;
        $task->saveOrFail();
        event(new AfterCreateTask($task));

        return $task;
    }

    /**
     * Mark the task as complete
     *
     * @param Task $task
     * @param CompletionStatusEnum $status
     * @return Task
     * @throws \Throwable
     */
    public function complete(Task $task, CompletionStatusEnum $status)
    {
        $task->is_complete = true;
        $task->completion_date = Carbon::now();
        $task->completion_status = $status->getValue();
        event(new CompleteTask($task));
        $task->saveOrFail();

        return $task;
    }

    /**
     * Return the task to list
     *
     * @param Task $task
     * @return Task
     * @throws \Throwable
     */
    public function restore(Task $task)
    {
        $task->is_complete = false;
        $task->completion_date = null;
        $task->completion_status = null;
        event(new RestoreTask($task));
        $task->saveOrFail();

        return $task;
    }

    /**
     * Update the task
     *
     * @param Task $task
     * @param $data
     * @return bool
     */
    public function update(Task $task, $data)
    {
        event(new BeforeUpdateTask($task, $data));
        $result = $task->update($data);
        event(new AfterUpdateTask($task));

        return $result;
    }

    /**
     * Delete the task
     *
     * @param Task $task
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Task $task)
    {
        event(new BeforeDeleteTask($task));

        return $task->delete();
    }

    public function move()
    {
        //
    }

    public function transform()
    {
        //
    }

    /**
     * Duplicate the task
     *
     * @param Task $task
     * @return bool
     */
    public function duplicate(Task $task)
    {
        event(new BeforeDuplicateTask($task));
        $newTask = $task->replicate();
        event(new AfterDuplicateTask($newTask));

        return $newTask->push();
    }
}
