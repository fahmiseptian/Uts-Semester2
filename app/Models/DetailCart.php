<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DetailCart  extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'detail_cart';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['id_cart', 'id_product', 'unit_price', 'qty', 'is_selected'];

    public function AddCart($id_cart, $data_product)
    {
        $id_product = $data_product['id'];
        $price = $data_product['price'];
        $qty = $data_product['qty'];
        $id_cd = DB::table('detail_cart')->insertGetId([
            'id_cart' => $id_cart,
            'id_product' => $id_product,
            'unit_price' => $price,
            'qty' => $qty,
            'is_selected' => 1
        ]);


        return $id_cd;
    }
}
