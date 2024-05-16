<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\biaya;
use App\Models\Cart;
use App\Models\category;
use App\Models\dashboard;
use App\Models\product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Logika untuk dashboard admin
        return view('dashboard');
    }

    public function userDashboard()
    {
        // Logika untuk dashboard user
        return view('home');
    }
    public function loadMenu(){
        // Mengambil data produk untuk ditampilkan di menu
    $products = Product::all();

    // Kirim data produk ke view menu.blade.php
    return view('menu', ['products' => $products]);
    }
    public function loadDashboard(){
        return view('dashboard');
    }
    public function loadCategories(){
        $categories = category::all();
        return view('category', ['categories' => $categories]);

    }
    public function loadProducts(){
        $products = product::all();
        return view('product', ['products' => $products]);
    }

    public function loadBiaya(){
        $biaya = Biaya::all();
        return view('biaya', ['biaya' => $biaya]);
    }

    public function loadAdmin(){
        $admins = Admin::all();
        return view('account', ['admins' => $admins]);
    }

    public function loadCart(){
        $carts = Cart::all();
        return view('cart', ['carts' => $carts]);
    }
    public function keranjang(){
        $carts = Cart::all();
        return view('keranjang', ['carts' => $carts]);
    }
}
