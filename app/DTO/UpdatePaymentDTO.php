<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdatePaymentDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $type_id,
        public readonly int $currency_id
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'payment_id'  => 'required|integer',
            'name'        => 'required|string|max:255',
            'type_id'     => 'required|integer',
            'currency_id' => 'required|integer'
        ]);

        return new self(
            id: (int) $validated['payment_id'],
            name: $validated['name'],
            type_id: (int) $validated['type_id'],
            currency_id: (int) $validated['currency_id']
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'type_id'     => $this->type_id,
            'currency_id' => $this->currency_id
        ];
    }
}
