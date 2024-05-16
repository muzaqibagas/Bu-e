<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_product',
        // tambahkan field lain yang perlu diisi secara massal di sini
        'price',
        'description',
        'image',
        'stock',
        'date'
    ];
}
