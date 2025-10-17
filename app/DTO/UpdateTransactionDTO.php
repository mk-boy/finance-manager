<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateTransactionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $sum,
        public readonly int $type_id,
        public readonly int $category_id,
        public readonly int $payment_id
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: (int) $request->validated()['transaction_id'],
            name: $request->validated()['name'],
            sum: (float) $request->validated()['sum'],
            type_id: (int) $request->validated()['type_id'],
            category_id: (int) $request->validated()['category_id'],
            payment_id: (int) $request->validated()['payment_id']
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'sum'         => $this->sum,
            'type_id'     => $this->type_id,
            'category_id' => $this->category_id,
            'payment_id'  => $this->payment_id
        ];
    }
}
