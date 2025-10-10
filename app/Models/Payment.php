<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const CASH_PAYMENT_TYPE = 1;
    public const BANK_CARD_PAYMENT_TYPE = 2;
    public const CREDIT_CARD_PAYMENT_TYPE = 3;
    public const SAVING_PAYMENT_TYPE = 4;

    public const CASH_PAYMENT_TITLE = 'Наличные';
    public const BANK_CARD_PAYMENT_TITLE = 'Банковская карта';
    public const CREDIT_CARD_PAYMENT_TITLE = 'Кредитная карта';
    public const SAVING_PAYMENT_TITLE = 'Сберегательный счёт';

    public const PAYMENTS_TITLES = [
        self::CASH_PAYMENT_TYPE => self::CASH_PAYMENT_TITLE,
        self::BANK_CARD_PAYMENT_TYPE => self::BANK_CARD_PAYMENT_TITLE,
        self::CREDIT_CARD_PAYMENT_TYPE => self::CREDIT_CARD_PAYMENT_TITLE,
        self::SAVING_PAYMENT_TYPE => self::SAVING_PAYMENT_TITLE
    ];

    protected $table = 'payments';

    protected $fillable = [
        'name', 'type_id', 'user_id', 'current_balance', 'currency_id'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
