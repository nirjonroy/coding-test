<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',  // Add this line
        'date',
        'user_id',
        'transaction_type',
        'description',
        // Add other fields as needed
    ];
}
