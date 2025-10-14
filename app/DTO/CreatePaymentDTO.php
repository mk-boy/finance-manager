<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\Models\User;

class CreatePaymentDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int $type_id,
        public readonly int $user_id,
        public readonly int $currency_id
    ) {}

    public static function fromRequest(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type_id'     => 'required|integer',
            'currency_id' => 'required|integer',
        ]);

        return new self(
            name: $validated['name'],
            type_id: (int) $validated['type_id'],
            user_id: $user->id,
            currency_id: (int) $request->currency_id
        );
    }

    public function toArray(): array
    {
        return [
            'name'            => $this->name,
            'type_id'         => $this->type_id,
            'user_id'         => $this->user_id,
            'currency_id'     => $this->currency_id,
        ];
    }
}