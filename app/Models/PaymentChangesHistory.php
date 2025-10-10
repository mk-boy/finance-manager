<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentChangesHistory extends Model
{
    protected $table = 'payment_changes_histories';

    protected $fillable = [
        'payment_id',
        'old_value'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
