<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Managers\OptionManager;
use App\Models\Option;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionController extends Controller
{
    public function create(Task $task, OptionRequest $request, OptionManager $optionManager)
    {
        $option = $optionManager->create($task->id, $request->all());

        return JsonResource::make($option);
    }

    public function update(Option $option, OptionRequest $request, OptionManager $optionManager)
    {
        $optionManager->update($option, $request->all());

        return JsonResource::make($option);
    }

    public function delete(Option $option, OptionManager $optionManager)
    {
        $optionManager->delete($option);

        return response(['success' => true], 200);
    }

    public function complete(Option $option, OptionManager $optionManager)
    {
        $option = $optionManager->complete($option);

        return JsonResource::make($option);
    }

    public function restore(Option $option, OptionManager $optionManager)
    {
        $option = $optionManager->restore($option);

        return JsonResource::make($option);
    }
}
