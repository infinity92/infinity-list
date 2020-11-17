<?php


namespace App\Managers;


use App\Enums\CompletionStatusEnum;
use App\Events\AfterCreateTask;
use App\Events\AfterDuplicateTask;
use App\Events\AfterTransformTask;
use App\Events\AfterUpdateTask;
use App\Events\BeforeCreateTask;
use App\Events\BeforeDeleteTask;
use App\Events\BeforeDuplicateTask;
use App\Events\BeforeTransformTask;
use App\Events\BeforeUpdateTask;
use App\Events\CompleteTask;
use App\Events\RestoreTask;
use App\Models\Category;
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

    /**
     * Move to another category
     *
     * @param Task $task
     * @param Category|null $category
     * @return Task
     */
    public function move(Task $task, Category $category = null)
    {
        $task->category_id = $category ? $category->id : null;

        return $task;
    }

    /**
     * Convert task to category
     *
     * @param Task $task
     * @return Category
     * @throws \Throwable
     */
    public function transform(Task $task)
    {
        event(new BeforeTransformTask($task));
        $category = new Category();
        $category->name = $task->name;
        $category->description = $task->description;
        $category->start_date = $task->start_date;
        $category->user_id = $task->user_id;
        $category->notification = $task->notification;
        $category->deadline = $task->deadline;
        $category->is_complete = $task->is_complete;
        $category->is_someday = $task->is_someday;
        $category->completion_date = $task->completion_date;
        $category->completion_status = $task->completion_status;
//        $category->sort = $task->sort; //todo сделать логику добавления категории в конец
        $category->saveOrFail();
        $task->delete();

        event(new AfterTransformTask($category));

        return $category;
    }

    /**
     * Duplicate the task
     *
     * @param Task $task
     * @return Task
     */
    public function duplicate(Task $task)
    {
        event(new BeforeDuplicateTask($task));
        $newTask = $task->replicate();
        event(new AfterDuplicateTask($newTask));
        $newTask->push();

        return $newTask;
    }
}
