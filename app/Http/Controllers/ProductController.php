<?php

namespace App\Http\Controllers;

use App\Models\biaya;
use App\Models\product;
use LaravelDaily\LaravelCharts;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index()
    {
        $products = product::all();
        return view('product', ['products' => $products]);
    }
    public function loadProduct()
    {
        $products = product::all(); // Mengambil semua data produk dari database
        return view('menu')->with('products', $products); // Meneruskan data produk ke view
    }
    public function takeProduct(){
        // Mengambil lima produk pertama dari database
    $products = product::take(5)->get();

    // Kirim data produk ke view home.blade.php
    return view('home', ['products' => $products]);
    }

    public function create()
    {
        return view('create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'date' => 'required|date',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $product = new Product();
        $product->name_product = $request->name_product;
        $product->image = $imageName;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->date = $request->date;
        $product->save();

        return redirect(route('products.index'))->with('success', 'Product created successfully.');
    }


    public function edit($id)
    {
        $product = product::findOrFail($id);
        return view('edit-product', ['product' => $product]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name_product' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'required|integer',
        'date' => 'required|date',
    ]);

    $product = product::findOrFail($id);
    $product->name_product = $request->name_product;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->stock = $request->stock;
    $product->date = $request->date;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    public function delete($id)
    {
        $product = product::findOrFail($id);
        $product->delete();

        // Redirect ke halaman index produk dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show(Product $product)
    {
        return view('detail-product', compact('product'));
    }

}
