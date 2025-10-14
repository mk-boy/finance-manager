<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateProfileDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email
    ) {}

    public static function fromRequest(Request $request, User $user): self
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        return new self(
            id: $user->id,
            name: $validated['name'],
            email: $validated['email']
        );
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'email' => $this->email
        ];
    }
}
