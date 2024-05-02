<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    protected $fillable = [
        'category', 'title', 'date', 'amount', 'withdrawn'
    ];

    // Optionally specify the table if it's different from the default naming convention
    protected $table = 'spendings';
}