<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const INCOME_TYPE_ID = 1;
    public const EXPENSE_TYPE_ID = 2;

    protected $table = 'categories';

    protected $fillable = [
        'name', 'type_id', 'description', 'tag_color', 'user_id'
    ];
}
