<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\CompletionStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CompleteRequest;
use App\Managers\CategoryManager;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(CategoryRequest $request, CategoryManager $categoryManager)
    {
        $category = $categoryManager->create(Auth::id(), $request->all());

        return JsonResource::make($category);
    }

    public function update(CategoryRequest $request, Category $category, CategoryManager $categoryManager)
    {
        $result = $categoryManager->update($category, $request->all());

        return response(['success' => $result], 200);
    }

    public function delete(Category $category, CategoryManager $categoryManager)
    {
        $categoryManager->delete($category);

        return response(['success' => true], 200);
    }

    public function duplicate(Category $category, CategoryManager $categoryManager)
    {
        $newCategory = $categoryManager->duplicate($category);

        return JsonResource::make($newCategory);
    }

    public function complete(Category $category, CompleteRequest $request, CategoryManager $categoryManager)
    {
        $category = $categoryManager->complete($category, new CompletionStatusEnum($request->status));

        return JsonResource::make($category);
    }

    public function restore(Category $category, CategoryManager $categoryManager)
    {
        $category = $categoryManager->restore($category);

        return JsonResource::make($category);
    }
}
