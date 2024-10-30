<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Cart  extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['id_user', 'invoice', 'total', 'qty', 'status', 'payment_method'];
    public function createCart($id_user)
    {
        // Get the ID of the existing cart for the user without an invoice
        $id_cart = DB::table('cart')
            ->where('id_user', $id_user)
            ->whereNull('invoice')
            ->value('id');

        // If no cart exists, create a new cart
        if (!$id_cart) {
            $cart = self::create(['id_user' => $id_user]);
            $id_cart = $cart->id;
        }

        return $id_cart;
    }


    public function updateCart($id_cart)
    {
        $details = DB::table('detail_cart')
            ->where('id_cart', $id_cart)
            ->selectRaw('SUM(qty) as total_qty, SUM(qty * unit_price) as total_price')
            ->first();

        // Ensure the results are valid before updating
        if ($details) {
            // Update the cart's `qty` and `total` fields with the calculated values
            return self::where('id', $id_cart)
                ->update([
                    'qty' => $details->total_qty,
                    'total' => $details->total_price,
                ]);
        }
    }

    function checkCart($id_user)
    {
        $id_cart = DB::table('cart')
            ->where('id_user', $id_user)
            ->whereNull('invoice')
            ->count();

        return $id_cart;
    }

    public function getCart($id_cart)
    {
        $cart = DB::table('cart as c')
            ->select(
                'c.total',
                'c.qty',
                'c.status',
            )
            ->where('c.id', $id_cart)
            ->first();

        $cart->products = DB::table('detail_cart as cd')
            ->select(
                'cd.unit_price as harga_satuan',
                'cd.qty',
                'cd.is_selected',
                'p.nama as nama_produk',
                'p.id as id_produk'
            )
            ->join('product as p', 'cd.id_product', '=', 'p.id')
            ->where('cd.id_cart', $id_cart)
            ->get()
            ->map(function ($product) {
                $productModel = Product::find($product->id_produk);
                if ($productModel && $productModel->hasMedia('product')) {
                    $product->image_url = $productModel->getFirstMediaUrl('product');
                } else {
                    $product->image_url = null;
                }
                return $product;
            });

        return $cart;
    }

    function getSelectedCart($id_cart)
    {
        $cart = DB::table('detail_cart')
            ->where('id_cart', $id_cart)
            ->where('is_selected', 'yes')
            ->selectRaw('SUM(qty) as total_qty, SUM(qty * unit_price) as total_price')
            ->first();
        $cart->detail = DB::table('detail_cart as cd')
            ->select(
                'cd.unit_price as harga_satuan',
                'cd.qty',
                'cd.is_selected',
                'p.nama as nama_produk',
                'p.id as id_produk'
            )
            ->join('product as p', 'cd.id_product', '=', 'p.id')
            ->where('cd.id_cart', $id_cart)
            ->where('cd.is_selected', 'yes')
            ->get()
            ->map(function ($product) {
                $productModel = Product::find($product->id_produk);
                if ($productModel && $productModel->hasMedia('product')) {
                    $product->image_url = $productModel->getFirstMediaUrl('product');
                } else {
                    $product->image_url = null;
                }
                return $product;
            });
        return $cart;
    }

    function FinishCheckout($id_cart, $pm , $id_address)
    {
        $invoice = $this->generateInvoice($id_cart);
        return self::where('id', $id_cart)
            ->update([
                'payment_method' => $pm,
                'id_address' => $id_address,
                'status' => 'invoiced',
                'invoice' => $invoice,
            ]);
    }

    function generateInvoice($id_cart)
    {
        $date = date('Ymd');
        $id_cart_str = str_pad($id_cart, 6, '0', STR_PAD_LEFT); // Pad dengan 0 di depan jika kurang dari 6 digit
        $combinedID = $date . $id_cart_str;
        if (strlen($combinedID) > 10) {
            $invoice = substr($combinedID, 0, 10);
        } else {
            $neededLength = 10 - strlen($combinedID);
            $invoice = $combinedID . mt_rand(1, pow(10, $neededLength) - 1); // Tambahkan angka acak
        }

        return $invoice;
    }
}
