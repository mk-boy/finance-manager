<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public const INCOME_TYPE_ID = 1;
    public const EXPENSE_TYPE_ID = 2;

    public const TRANSACTION_TITLES = [
        self::INCOME_TYPE_ID => 'Доход',
        self::EXPENSE_TYPE_ID => 'Расход'
    ];

    protected $table = 'transactions';

    protected $fillable = [
        'name', 'user_id', 'category_id', 'payment_id', 'type_id', 'sum'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
