<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payer extends Model
{
    use HasFactory;

    protected $table = 'payer';
    protected $fillable = [
        'entity_type',
        'type',
        'email',
        'identification_type',
        'identification_number',
    ];
}
