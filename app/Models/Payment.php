<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    
    protected $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    protected $fillable = [
        'id',
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
