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
        return new self(
            id: (int) $request->validated()['payment_id'],
            name: $request->validated()['name'],
            type_id: (int) $request->validated()['type_id'],
            currency_id: (int) $request->validated()['currency_id']
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
