<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    use ValidatesRequests; // Memperbolehkan penggunaan validasi

    protected $model;

    public function __construct()
    {
        $this->model = new User(); // Menginisialisasi model User
    }

    public function index()
    {
        return view('admin.auth.index'); // Menampilkan halaman login admin
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Mencari pengguna berdasarkan email
        $user = $this->model->where('email', $credentials['email'])->first();

        // Memeriksa apakah pengguna ditemukan
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Invalid credentials.']);
        }

        // Memeriksa kecocokan password
        if (Hash::check($credentials['password'], $user->password)) {
            // Menyimpan data sesi
            $request->session()->put([
                'id' => $user->id,
                'nama' => $user->name,
                'access' => $user->access,
                'is_buyer' => true
            ]);
            Log::info('After setting session: ', session()->all());
            return response()->json(['success' => true]);
        }

        // Jika tidak ada kecocokan, kembalikan respon gagal
        return response()->json(['success' => false, 'message' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // Hapus semua sesi
        $request->session()->flush();

        // Redirect ke halaman login
        return redirect('/admin/login')->with('success', 'You have been logged out successfully.');
    }
}
