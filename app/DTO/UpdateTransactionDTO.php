<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateTransactionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly float $sum,
        public readonly int $type_id,
        public readonly int $category_id,
        public readonly int $payment_id
    ) {}

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'transaction_id' => 'required|integer',
            'name'           => 'required|string|max:255',
            'sum'            => 'required|numeric|min:1',
            'type_id'        => 'required|integer',
            'category_id'    => 'required|integer',
            'payment_id'     => 'required|integer'
        ]);

        return new self(
            id: (int) $validated['transaction_id'],
            name: $validated['name'],
            sum: (float) $validated['sum'],
            type_id: (int) $validated['type_id'],
            category_id: (int) $validated['category_id'],
            payment_id: (int) $validated['payment_id']
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
