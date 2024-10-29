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

    protected $fillable = ['id_user', 'invoice', 'total', 'qty', 'status'];
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
}
