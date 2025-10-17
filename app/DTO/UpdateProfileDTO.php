<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateProfileDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $password
    ) {}

    public static function fromRequest(Request $request, User $user): self
    {
        $validated = $request->validated();
        
        return new self(
            id: $user->id,
            name: $validated['name'],
            email: $validated['email'],
            password: isset($validated['password']) ? bcrypt($validated['password']) : null
        );
    }

    public function toArray(): array
    {
        $data = [
            'name'  => $this->name,
            'email' => $this->email
        ];
        
        if ($this->password) {
            $data['password'] = $this->password;
        }
        
        return $data;
    }
}
