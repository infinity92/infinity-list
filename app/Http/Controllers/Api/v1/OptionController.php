<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Managers\OptionManager;
use App\Models\Option;
use App\Models\Task;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function create(Task $task, OptionRequest $request, OptionManager $optionManager)
    {
        $optionManager->create($task->id, $request->all());
    }

    public function update(Option $option, OptionRequest $request, OptionManager $optionManager)
    {
        $optionManager->update($option, $request->all());
    }

    public function delete(Option $option, OptionManager $optionManager)
    {
        $optionManager->delete($option);
    }

    public function complete(Option $option, OptionManager $optionManager)
    {
        $optionManager->complete($option);
    }

    public function restore(Option $option, OptionManager $optionManager)
    {
        $optionManager->restore($option);
    }
}
