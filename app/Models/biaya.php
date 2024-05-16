<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biaya extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_product',
        'amount',
        'type',
        'description',
        'start_date',
        'end_date',
        // tambahkan _token ke dalam fillable
    ];
}
