<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\CompletionStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompleteRequest;
use App\Http\Requests\TaskRequest;
use App\Managers\TaskManager;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function create(TaskRequest $request, TaskManager $taskManager)
    {
        $task = $taskManager->create(Auth::id(), $request->all());

        return JsonResource::make($task);
    }

    public function update(TaskRequest $request, Task $task, TaskManager $taskManager)
    {
        $result = $taskManager->update($task, $request->all());

        return response(['success' => $result], 200);
    }

    public function delete(Task $task, TaskManager $taskManager)
    {
        $taskManager->delete($task);

        return response(['success' => true], 200);
    }

    public function transform(Task $task, TaskManager $taskManager)
    {
        $category = $taskManager->transform($task);

        return JsonResource::make($category);
    }

    public function duplicate(Task $task, TaskManager $taskManager)
    {
        $newTask = $taskManager->duplicate($task);

        return JsonResource::make($newTask);
    }

    public function complete(Task $task, CompleteRequest $request, TaskManager $taskManager)
    {
        $task = $taskManager->complete($task, new CompletionStatusEnum($request->status));

        return JsonResource::make($task);
    }

    public function restore(Task $task, TaskManager $taskManager)
    {
        $task = $taskManager->restore($task);

        return JsonResource::make($task);
    }
}
