<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $fillable = [
        'transaction_amount',
        'installments',
        'token',
        'payer_id',
        'payment_method_id',
        'notification_url',
        'status',
    ];

    public function payer()
    {
        return $this->belongsTo(Payer::class);
    }
}
