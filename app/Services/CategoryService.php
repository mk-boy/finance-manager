<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\DTO\CreateCategoryDTO;
use App\DTO\UpdateCategoryDTO;
use App\Models\User;
use App\Models\Category;

class CategoryService
{
    public static function getUserCategories(User $user)
    {
        $categories = Category::where('user_id', $user->id)->get();
        
        return $categories;
    }

    public static function createUserCategory(CreateCategoryDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Category::create($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function updateUserCategory(UpdateCategoryDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Category::where('id', $dto->id)->update($dataArray);
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function getUserCategoryById(int $categoryId, User $user): ?Category
    {
        return Category::where('id', $categoryId)
                     ->where('user_id', $user->id)
                     ->first();
    }

    public static function deleteUserCategory(Request $request): bool
    {
        $category = Category::find($request->category_id);

        if (!$category) {
            return false;
        }

        try {
            $category->delete();
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function canUserAccessCategory(int $categoryId, User $user): bool
    {
        return Category::where('id', $categoryId)
                     ->where('user_id', $user->id)
                     ->exists();
    }
}
