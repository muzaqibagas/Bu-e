<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\product;
use App\Models\User;
use TCPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Ambil pengguna yang terautentikasi
        $user = Auth::user();

        // Tambahkan item ke keranjang belanja
        Cart::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    public function getTotalSales()
    {
        // Mengambil jumlah total penjualan dari tabel keranjang
        $totalSales = Cart::sum('quantity');

        return response()->json(['totalSales' => $totalSales]);
    }
    public function showcart(){
        $carts = Cart::all();
        return view('cart', ['carts' => $carts]);
    }
    public function downloadPDF($id)
    {
        // Temukan keranjang berdasarkan ID
        $cart = Cart::find($id);

        // Pastikan keranjang ditemukan
        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang tidak ditemukan.');
        }

        // Ambil detail produk terkait dengan keranjang
        $product = Product::find($cart->product_id);

        // Ambil detail pengguna terkait dengan keranjang
        $user = User::find($cart->user_id);

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set judul dan margin
        $pdf->SetTitle('Struk Pembelian');
        $pdf->SetMargins(10, 10, 10);

        // Tambahkan halaman baru ke PDF
        $pdf->AddPage();

        // Set font untuk konten
        $pdf->SetFont('helvetica', '', 12);

        // Tambahkan judul
        $pdf->Cell(0, 10, 'Struk Pembelian', 0, 1, 'C');
        $pdf->Ln(10);

        // Tambahkan tabel
        $html = '<table border="1" cellpadding="5">
                    <tr>
                        <th>Cart ID</th>
                        <td>' . $cart->id . '</td>
                    </tr>
                    <tr>
                        <th>Quantity</th>
                        <td>' . $cart->quantity . '</td>
                    </tr>
                    <tr>
                        <th>Product Name</th>
                        <td>' . $product->name_product . '</td>
                    </tr>
                    <tr>
                        <th>User Username</th>
                        <td>' . $user->username . '</td>
                    </tr>
                    <tr>
                        <th>User Phone</th>
                        <td>' . $user->phone . '</td>
                    </tr>
                </table>';

        // Tambahkan konten ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Keluarkan PDF ke browser dan download dengan nama file 'struk_pembelian.pdf'
        $pdf->Output('struk_pembelian.pdf', 'D');
    }
    // Fungsi untuk menandai pesanan sebagai selesai dan menghapusnya dari keranjang
    public function markAsFinished($id)
    {
        // Temukan pesanan berdasarkan ID
        $cart = Cart::find($id);

        // Periksa apakah pesanan ditemukan
        if (!$cart) {
            return response()->json(['message' => 'Pesanan tidak ditemukan.'], 404);
        }

        // Hapus pesanan dari keranjang
        $cart->delete();

        // Kirim respons berhasil
        return response()->json(['message' => 'Pesanan berhasil ditandai sebagai selesai.'], 200);
    }
}
