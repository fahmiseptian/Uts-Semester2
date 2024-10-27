<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Redirect;

class HomeAdminController extends BaseController
{
    protected $Model;
    protected $id_user;

    public function __construct(Request $request) {}

    public function index()
    {
        return view('admin.home.index');
    }
}
