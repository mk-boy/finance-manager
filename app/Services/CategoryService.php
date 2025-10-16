<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DTO\CreateCategoryDTO;
use App\DTO\UpdateCategoryDTO;
use App\Models\User;
use App\Models\Category;

class CategoryService
{
    public function getUserCategories(User $user)
    {
        $categories = Category::where('user_id', $user->id)->get();
        
        return $categories;
    }

    public function createUserCategory(CreateCategoryDTO $dto)
    {
        $dataArray = $dto->toArray();

        try {
            Category::create($dataArray);

            Log::info('Создана новая категория', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при создании категории", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function updateUserCategory(UpdateCategoryDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            Category::where('id', $dto->id)->update($dataArray);

            Log::info('Обновлена категория', $dataArray);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при редактировании категории", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function getUserCategoryById(int $categoryId, User $user): ?Category
    {
        return Category::where('id', $categoryId)
                     ->where('user_id', $user->id)
                     ->first();
    }

    public function deleteUserCategory(Request $request): bool
    {
        $category = Category::find($request->category_id);

        if (!$category) {
            return false;
        }

        try {
            $category->delete();

            Log::info('Удалена категория', [
                'category_id' => $request->category_id
            ]);

            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при удалении категории", [
                'dataArray'     => [
                    'id'          => $category->id,
                    'user_id'     => $category->user_id,
                    'type_id'     => $category->type_id,
                    'name'        => $category->name,
                    'description' => $category->description,
                    'tag_color'   => $category->tag_color
                ],
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);
            
            return false;
        }
    }

    public function canUserAccessCategory(int $categoryId, User $user): bool
    {
        return Category::where('id', $categoryId)
                     ->where('user_id', $user->id)
                     ->exists();
    }
}
