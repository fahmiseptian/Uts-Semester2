<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;

class ProductAdminController extends BaseController
{
    protected $Model;
    protected $id_user;

    public function __construct(Request $request) {}

    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', ['products' => $products]);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'kategori' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        // Simpan data produk ke database
        $product = Product::create([
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'status' => $request->status,
        ]);

        $media = $product->addMedia($request->file('gambar'))
            ->usingFileName(time() . '_' . now()->format('YmdHis') . '.jpg') // Nama file unik
            ->toMediaCollection('product', 'images');

        $product->save();

        return response()->json(['message' => 'Produk berhasil ditambahkan!']);
    }
}
