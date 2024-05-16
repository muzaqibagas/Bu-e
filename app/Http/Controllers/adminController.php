<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('account', compact('admins'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('edit-account', ['admin' => $admin]);
    }

    // Method untuk melakukan update admin
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);

        // Update data admin
        $admin->update([
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
        ]);

        // Redirect ke halaman index admin dengan pesan sukses
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
    }
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
    }
    // public function adminChart()
    // {
    //     // Ambil jumlah admin dari database
    //     $adminCount = Admin::count();

    //     // Kirim data ke tampilan
    //     return view('dashboard', compact('adminCount'));
    // }
}
