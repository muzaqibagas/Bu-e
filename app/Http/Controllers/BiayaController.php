<?php

namespace App\Http\Controllers;

use App\Models\biaya;
use Illuminate\Http\Request;
use TCPDF;

class BiayaController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data biaya dari database berdasarkan rentang tanggal jika tersedia
        if ($startDate && $endDate) {
            $biaya = Biaya::whereBetween('date', [$startDate, $endDate])->get();
        } else {
            // Jika rentang tanggal tidak tersedia, ambil semua data biaya
            $biaya = Biaya::all();
        }

        return view('biaya', ['biaya' => $biaya]);
    }
    public function downloadPDF($id)
    {
        // Ambil data biaya dari database berdasarkan ID yang diberikan
        $biaya = biaya::find($id);

        // Pastikan data biaya tersedia
        if (!$biaya) {
            // Jika tidak ditemukan, bisa dilakukan redirect atau respons error
            return redirect()->back()->with('error', 'Data biaya tidak ditemukan.');
        }

        // Buat instance TCPDF
        $pdf = new TCPDF();

        // Set judul dan margin
        $pdf->SetTitle('Detail Biaya');
        $pdf->SetMargins(10, 10, 10);

        // Tambahkan halaman baru ke PDF
        $pdf->AddPage();

        // Set font untuk konten
        $pdf->SetFont('dejavusans', '', 12); // Gunakan font DejaVu Sans

        // Tambahkan judul
        $pdf->Cell(0, 10, 'Detail Biaya', 0, 1, 'C');
        $pdf->Ln(10);

        // Tambahkan tabel
        $html = '<table border="1" cellpadding="5">
                    <tr>
                        <th>Tanggal</th>
                        <td>' . $biaya->start_date . '</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>' . $biaya->end_date . '</td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td>' . $biaya->name_product . '</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>' . $biaya->amount . '</td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td>' . $biaya->type . '</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>' . $biaya->description . '</td>
                    </tr>
                </table>';

        // Tambahkan konten ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Keluarkan PDF ke browser dan download dengan nama file 'detail_biaya.pdf'
        $pdf->Output('biaya.pdf', 'D');
    }
    public function downloadAllPDF()
{
    // Ambil semua data biaya dari database
    $biayas = Biaya::all();

    // Buat instance TCPDF
    $pdf = new TCPDF();

    // Set judul dan margin
    $pdf->SetTitle('Semua Detail Biaya');
    $pdf->SetMargins(10, 10, 10);

    // Tambahkan halaman baru ke PDF
    $pdf->AddPage();

    // Set font untuk konten
    $pdf->SetFont('dejavusans', '', 12); // Gunakan font DejaVu Sans

    // Tambahkan judul
    $pdf->Cell(0, 10, 'Semua Detail Biaya', 0, 1, 'C');
    $pdf->Ln(10);

    // Inisialisasi total pendapatan dan pengeluaran
    $totalPemasukan = 0;
    $totalPengeluaran = 0;

    // Iterasi melalui setiap data biaya
    foreach ($biayas as $biaya) {
        // Tambahkan tabel untuk setiap data biaya
        $html = '<table border="1" cellpadding="5">
                        <tr>
                        <th>Tanggal Produksi</th>
                        <td>' . $biaya->start_date . '</td>
                    </tr>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <td>' . $biaya->end_date . '</td>
                    </tr>
                    <tr>
                        <th>Nama Produk</th>
                        <td>' . $biaya->name_product . '</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>' . $biaya->amount . '</td>
                    </tr>
                    <tr>
                        <th>Tipe</th>
                        <td>' . $biaya->type . '</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>' . $biaya->description . '</td>
                    </tr>
                </table>';

        // Tambahkan konten ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Tambahkan jumlah pendapatan atau pengeluaran ke total sesuai tipe biaya
        if ($biaya->type == 'income') {
            $totalPemasukan += $biaya->amount;
        } else if ($biaya->type == 'expense') {
            $totalPengeluaran += $biaya->amount;
        }

        // Tambahkan halaman baru jika masih ada data biaya yang tersisa
        if ($biaya !== $biayas->last()) {
            $pdf->AddPage();
        }
    }

    // Tambahkan total pendapatan dan pengeluaran ke PDF
    $totalHtml = '<strong>Total Pendapatan:</strong> Rp' . number_format($totalPemasukan, 0, ',', '.') . '<br>';
    $totalHtml .= '<strong>Total Pengeluaran:</strong> Rp' . number_format($totalPengeluaran, 0, ',', '.') . '<br>';
    $pdf->writeHTML($totalHtml, true, false, true, false, '');

    // Keluarkan PDF ke browser dan download dengan nama file 'semua_detail_biaya.pdf'
    $pdf->Output('semua_laporan.pdf', 'D');
}


// public function edit($id)
// {
//     // Temukan biaya berdasarkan ID yang diberikan
//     $biaya = Biaya::findOrFail($id);

//     // Kirim data biaya ke halaman edit
//     return view('edit-biaya', compact('biaya'));
// }

// public function update(Request $request, $id)
// {
//     // Validasi input
//     $request->validate([
//         'name_product' => 'required|string',
//         'amount' => 'required|numeric',
//         'type' => 'required|in:income,expense',
//         'description' => 'nullable|string',
//         'date' => 'required|date',
//     ]);

//     // Temukan biaya berdasarkan ID yang diberikan
//     $biaya = Biaya::findOrFail($id);

//     // Update data biaya
//     $biaya->update([
//         'name_product' => $request->name_product,
//         'amount' => $request->amount,
//         'type' => $request->type,
//         'description' => $request->description,
//         'date' => $request->date,
//     ]);

//     // Redirect ke halaman biaya dengan pesan sukses
//     return redirect()->route('biaya')->with('success', 'Data biaya berhasil diperbarui.');
// }
public function edit($id)
    {
        $biaya = Biaya::findOrFail($id);
        return view('edit-biaya', compact('biaya'));
    }

    public function update(Request $request, $id)
    {
        $biaya = biaya::findOrFail($id);
        // Lakukan validasi data jika diperlukan
        $biaya->update($request->all());
        return redirect()->route('index')->with('success', 'Data berhasil diperbarui.');   }

    public function delete($id)
    {
        $biaya = biaya::findOrFail($id);
        $biaya->delete();
        return redirect()->route('index')->with('success', 'Data berhasil dihapus.');
    }


    // Method untuk menampilkan halaman form tambah data
    public function create()
    {
        return view('create-biaya');
    }

    // Method untuk menyimpan data baru ke database
    public function store(Request $request)
    {
        // Validasi data (opsional)
        $request->validate([
            'name_product' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan data ke database
        biaya::create($request->all());

        // Redirect ke halaman yang sesuai atau tampilkan pesan berhasil
        return redirect()->route('index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function ChartDashboard()
{
    // Ambil data biaya dari database
    $income = Biaya::where('type', 'income')->pluck('amount')->toArray();
    $expense = Biaya::where('type', 'expense')->pluck('amount')->toArray();
    $labels = Biaya::pluck('name_product')->toArray(); // Misalnya, gunakan 'name_product' sebagai label

    // Kirim data ke tampilan
    return view('dashboard', compact('income', 'expense', 'labels'));
}

    public function downloadFilteredPDF(Request $request)
{
    // Ambil tanggal mulai dan tanggal selesai dari permintaan
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    // Query data dari database berdasarkan rentang tanggal
    $filteredData = Biaya::whereBetween('start_date', [$startDate, $endDate])->get();

    // Hitung jumlah pemasukan dan pengeluaran
    $totalPemasukan = $filteredData->where('type', 'income')->sum('amount');
    $totalPengeluaran = $filteredData->where('type', 'expense')->sum('amount');

    // Format jumlah pemasukan dan pengeluaran ke mata uang Rupiah (IDR)
    $totalPemasukanFormatted = 'Rp ' . number_format($totalPemasukan, 0, ',', '.');
    $totalPengeluaranFormatted = 'Rp ' . number_format($totalPengeluaran, 0, ',', '.');

    // Buat instance TCPDF
    $pdf = new TCPDF();

    // Set judul dan margin
    $pdf->SetTitle('Filtered Data PDF');
    $pdf->SetMargins(10, 10, 10);

    // Tambahkan halaman baru ke PDF
    $pdf->AddPage();

    // Tambahkan judul
    $pdf->Cell(0, 10, 'Filtered Data', 0, 1, 'C');
    $pdf->Ln(10);

    // Tambahkan tabel
    $html = '<table border="1" cellpadding="5">
                <tr>
                    <th>Tanggal Produksi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Product</th>
                    <th>Jumlah</th>
                    <th>Tipe</th>
                    <th>Deskripsi</th>
                </tr>';
    foreach ($filteredData as $data) {
        $html .= '<tr>
                    <td>' . $data->start_date . '</td>
                    <td>' . $data->end_date . '</td>
                    <td>' . $data->name_product . '</td>
                    <td>' . $data->amount . '</td>
                    <td>' . $data->type . '</td>
                    <td>' . $data->description . '</td>
                  </tr>';
    }
    $html .= '<tr>
                <td colspan="6"></td>
             </tr>
             <tr>
                <td colspan="2">Total Pemasukan</td>
                <td colspan="4">' . $totalPemasukanFormatted . '</td>
             </tr>
             <tr>
                <td colspan="2">Total Pengeluaran</td>
                <td colspan="4">' . $totalPengeluaranFormatted . '</td>
             </tr>';
    $html .= '</table>';

    // Tambahkan konten ke PDF
    $pdf->writeHTML($html, true, false, true, false, '');

    // Keluarkan PDF ke browser dan download dengan nama file 'filtered_data.pdf'
    $pdf->Output('data terfilter.pdf', 'D');
}
    // public function showIncomeAndExpense()
    // {
    //     // Menghitung total pemasukan
    //     $totalincome = Biaya::where('type', 'income')->sum('amount');

    //     // Menghitung total pengeluaran
    //     $totalexpense = Biaya::where('type', 'expense')->sum('amount');

    //     return view('dashboard', [
    //         'totalIncome' => $totalincome,
    //         'totalExpense' => $totalexpense,
    //     ]);
    // }

}



