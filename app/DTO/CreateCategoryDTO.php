<?php

namespace App\DTO;

use Illuminate\Http\Request;
use App\Models\User;

class CreateCategoryDTO
{
    public function __construct(
        public readonly string $name,
        public readonly int $type_id,
        public readonly int $user_id,
        public readonly ?string $description,
        public readonly ?string $tag_color
    ) {}

    public static function fromRequest(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type_id' => 'required|integer',
            'description' => 'nullable|string|max:255',
            'tag_color' => 'nullable|string|max:7',
        ]);

        return new self(
            name: $validated['name'],
            type_id: (int) $validated['type_id'],
            user_id: $user->id,
            description: $validated['description'] ?? null,
            tag_color: $validated['tag_color'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type_id' => $this->type_id,
            'user_id' => $this->user_id,
            'description' => $this->description,
            'tag_color' => $this->tag_color,
        ];
    }
}
