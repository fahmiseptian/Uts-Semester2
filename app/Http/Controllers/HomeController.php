<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $Mproducts = new Product();
        $products = $Mproducts->GetProductActive();
        return view('home.index',['products' => $products]);
    }
}
