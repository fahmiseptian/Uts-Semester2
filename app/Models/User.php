<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['name', 'username', 'email', 'password', 'access', 'status'];

    function checkEmail($email, $access)
    {
        $check = DB::table('users')
            ->where('email', $email)
            ->where('access', $access)
            ->count();
        return $check;
    }

    function CheckUser($email)
    {
        $data = DB::table('users')
            ->where('email', $email)
            ->where('status', 'active')
            ->get();
        return $data;
    }
}
