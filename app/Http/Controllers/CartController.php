<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DetailCart;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class CartController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $data;
    protected $model;

    public function __construct(Request $request)
    {
        // Log::info('Session Data: ', $request->all());
        $this->data['id_user'] =  $request->session()->get('id');
        $this->model['Cart'] = new Cart();
        $this->model['DetailCart'] = new DetailCart();
    }

    function addCart(Request $request)
    {
        Log::info('Session Data in addCart: ', session()->all());
        $id_product = $request->input('id_product'); // Perbaiki typo 'id_prouct' menjadi 'id_product'
        $qty        = $request->input('qty');
        $id_user    = $this->data['id_user'];

        // return response()->json(['id_user' => $id_user]);

        $product = Product::find($id_product);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404);
        }

        $id_cart = $this->model['Cart']->createCart($id_user);
        // return response()->json(['id_user' => $id_cart]);
        if ($id_cart == null) {
            return response()->json([
                'success' => false,
                'message' => 'Cart failed to create.'
            ], 400);
        }

        // Add to detailCart
        try {
            $data_product = [
                'id' => $product->id,
                'price' => $product->harga,
                'qty' => $qty,
            ];
            $id_cd =  $this->model['DetailCart']->AddCart($id_cart, $data_product);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add to detail cart: ' . $th->getMessage()
            ], 500);
        }

        // Add to cart
        try {
            $this->model['Cart']->updateCart($id_cart);
        } catch (\Throwable $th) {
            $detailCart = DetailCart::find($id_cd);
            $detailCart->delete();
            return response()->json([
                'success' => false,
                'message' => 'Failed to add to cart: ' . $th->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item successfully added to cart and detail cart.'
        ]);
    }
}
