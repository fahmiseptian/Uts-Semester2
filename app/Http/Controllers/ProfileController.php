<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ProfileController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $data;
    protected $model;

    public function __construct(Request $request)
    {
        // Log::info('Session Data: ', $request->all());
        $this->data['id_user'] =  $request->session()->get('id');
        $this->model['Cart'] = new Cart();
    }
    public function index()
    {
        return view('profile.index');
    }

    public function v_content($content)
    {
        if ($content == 'profile') {
            $data = User::find($this->data['id_user']);
            return view('profile.v_profile', ['user' => $data]);
        } elseif ($content == 'all' || $content == 'in_process' || $content == 'checking' || $content == 'completed') {
            $data = $this->model['Cart']->getTranscasion($this->data['id_user']);
            // return response()->json($data);
            return view('profile.v_transaction', ['data' => $data]);
        } else {
            return view('profile.v_logout');
        }
    }

    public function updateProfile(Request $request)
    {
        $id_user = $this->data['id_user'];

        // Ambil data user saat ini dari database
        $user = User::findOrFail($id_user);

        // Variabel untuk menyimpan perubahan
        $changes = [];

        // Periksa perbedaan data
        if ($request->name !== $user->name) {
            $changes['name'] = $request->name;
        }

        if ($request->email !== $user->email) {
            $changes['email'] = $request->email;
        }

        if ($request->username !== $user->username) {
            $changes['username'] = $request->username;
        }

        // Jika tidak ada perubahan, return response
        if (empty($changes)) {
            return response()->json(['message' => 'No changes detected.'], 200);
        }

        // Lakukan update
        $user->update($changes);

        return response()->json(['message' => 'Profile updated successfully.'], 200);
    }
}
