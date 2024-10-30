<?php

namespace App\Http\Controllers;

use App\Models\Address;
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

    public function show_cart()
    {
        $id_user    = $this->data['id_user'];
        $check      = $this->model['Cart']->checkCart($id_user);

        if ($check > 0) {
            $id_cart = $this->model['Cart']->createCart($id_user);
            $cart = $this->model['Cart']->getCart($id_cart);

            // return response()->json(['cart'=>$cart]);
            return view('cart.cart', ['cart' => $cart]);
        }
        return view('cart.empty-cart');
    }

    function checkout()
    {
        $id_user    = $this->data['id_user'];
        $check      = $this->model['Cart']->checkCart($id_user);

        if ($check > 0) {
            $id_cart = $this->model['Cart']->createCart($id_user);
            $data_cart_selected = $this->model['Cart']->getSelectedCart($id_cart);

            // return response()->json(['cart'=>$data_cart_selected]);
            return view('cart.checkout', ['cart' => $data_cart_selected]);
        }
        return view('cart.empty-cart');
    }

    function storeCheckout(Request $request)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $city = $request->input('city');
        $code_pos = $request->input('postalCode');
        $phone = $request->input('phone');
        $pm = $request->input('paymentMethod');

        $id_user    = $this->data['id_user'];
        $check      = $this->model['Cart']->checkCart($id_user);

        if ($check > 0) {
            $id_cart = $this->model['Cart']->createCart($id_user);

            $data_address = [
                'id_user' => $id_user,
                'recipient_name' => $name,
                'address' => $address,
                'city' => $city,
                'zip_code' => $code_pos,
                'phone_number' => $phone,
            ];

            $address = Address::create($data_address);

            if (!$address) {
                return response()->json(data: [
                    'success' => false,
                    'massage' => 'Failed to process the address',
                ]);
            }
            $checkout = $this->model['Cart']->FinishCheckout($id_cart, $pm, $address->id);

            if (!$checkout) {
                $address->delete();
                return response()->json(data: [
                    'success' => false,
                    'massage' => 'Checkout process failed',
                ]);
            }
            return response()->json(data: [
                'success' => false,
                'massage' => 'Checkout process succeed',
            ]);
        }
        return response()->json(data: [
            'success' => false,
            'massage' => 'Checkout process failed',
        ]);
    }
}
