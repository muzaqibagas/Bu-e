<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'keranjang';

    protected $fillable = ['user_id', 'product_id', 'quantity'];
     // tambahkan relasi ke model Product dan User jika diperlukan
     public function product()
     {
         return $this->belongsTo(Product::class, 'product_id');
     }

     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
}
