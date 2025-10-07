<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public const CASH_PAYMENT_TYPE = 1;
    public const BANK_CARD_PAYMENT_TYPE = 2;
    public const CREDIT_CARD_PAYMENT_TYPE = 3;
    public const SAVING_PAYMENT_TYPE = 4;
}
