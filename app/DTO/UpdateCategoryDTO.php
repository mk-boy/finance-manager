<?php

namespace App\DTO;

use Illuminate\Http\Request;

class UpdateCategoryDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $type_id,
        public readonly ?string $description,
        public readonly ?string $tag_color
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: (int) $request->validated()['category_id'],
            name: $request->validated()['name'],
            type_id: (int) $request->validated()['type_id'],
            description: $request->validated()['description'] ?? null,
            tag_color: $request->validated()['tag_color'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'type_id'     => $this->type_id,
            'description' => $this->description,
            'tag_color'   => $this->tag_color
        ];
    }
}
