<?php

namespace App\Services;

use Exception;
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
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function getUserById(int $userId): ?User
    {
        return User::find($userId);
    }
}
