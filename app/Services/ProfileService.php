<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use App\DTO\UpdateProfileDTO;
use App\Models\User;

class ProfileService
{
    public function getUserProfile(User $user): User
    {
        return $user;
    }

    public function updateUserProfile(UpdateProfileDTO $dto): bool
    {
        $dataArray = $dto->toArray();

        try {
            User::where('id', $dto->id)->update($dataArray);

            Log::info('Обновлён профиль пользователя', $dataArray);
            
            return true;
        } catch (Exception $ex) {
            Log::error("Ошибка при обновлении профиля пользователя", [
                'data_array'    => $dataArray,
                'error_message' => $ex->getMessage(),
                'error_code'    => $ex->getCode(),
                'stack_trace'   => $ex->getTraceAsString()
            ]);

            return false;
        }
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
