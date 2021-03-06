<?php


namespace App\Managers;

use App\Models\Option;

class OptionManager
{
    /**
     * Create the new option
     *
     * @param int $taskId
     * @param array $data
     * @return Option
     * @throws \Throwable
     */
    public function create(int $taskId, array $data)
    {
        $option = new Option($data);
        $option->task_id = $taskId;
        $option->saveOrFail();

        return $option;
    }

    /**
     * Mark the option as complete
     *
     * @param Option $option
     * @return Option
     * @throws \Throwable
     */
    public function complete(Option $option)
    {
        $option->is_complete = true;
        $option->saveOrFail();

        return $option;
    }

    /**
     * Return the option to list
     *
     * @param Option $option
     * @return Option
     * @throws \Throwable
     */
    public function restore(Option $option)
    {
        $option->is_complete = false;
        $option->saveOrFail();

        return $option;
    }

    /**
     * Update the option
     *
     * @param Option $option
     * @param $data
     * @return bool
     */
    public function update(Option $option, $data)
    {
        return $option->fill($data)->saveOrFail();
    }

    /**
     * Delete the option
     *
     * @param Option $option
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Option $option)
    {
        return $option->delete();
    }
}
