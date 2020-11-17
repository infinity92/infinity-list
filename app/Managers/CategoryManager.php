<?php


namespace App\Managers;


use App\Enums\CompletionStatusEnum;
use App\Events\AfterCreateCategory;
use App\Events\AfterUpdateCategory;
use App\Events\BeforeCreateCategory;
use App\Events\BeforeDeleteCategory;
use App\Events\BeforeUpdateCategory;
use App\Events\CompleteCategory;
use App\Events\RestoreCategory;
use App\Models\Category;
use Carbon\Carbon;

class CategoryManager
{
    /**
     * Create the new category
     *
     * @param int $userId
     * @param array $data
     * @return Category
     * @throws \Throwable
     */
    public function create(int $userId, array $data)
    {
        event(new BeforeCreateCategory($data));
        $category = new Category($data);
        $category->user_id = $userId;
        $category->saveOrFail();
        event(new AfterCreateCategory($category));

        return $category;
    }

    /**
     * Mark the category as complete
     *
     * @param Category $category
     * @param CompletionStatusEnum $status
     * @return Category
     * @throws \Throwable
     */
    public function complete(Category $category, CompletionStatusEnum $status)
    {
        $category->is_complete = true;
        $category->completion_date = Carbon::now();
        $category->completion_status = $status->getValue();
        event(new CompleteCategory($category));
        $category->saveOrFail();

        return $category;
    }

    /**
     * Return the category to list
     *
     * @param Category $category
     * @return Category
     * @throws \Throwable
     */
    public function restore(Category $category)
    {
        $category->is_complete = false;
        $category->completion_date = null;
        $category->completion_status = null;
        event(new RestoreCategory($category));
        $category->saveOrFail();

        return $category;
    }

    /**
     * Update the category
     *
     * @param Category $category
     * @param $data
     * @return bool
     */
    public function update(Category $category, $data)
    {
        event(new BeforeUpdateCategory($category, $data));
        $result = $category->update($data);
        event(new AfterUpdateCategory($category));

        return $result;
    }

    /**
     * Delete the category
     *
     * @param Category $category
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Category $category)
    {
        event(new BeforeDeleteCategory($category));

        return $category->delete();
    }
}
