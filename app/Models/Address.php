<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address  extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['id_user', 'recipient_name', 'address', 'city', 'zip_code', 'phone_number'];
}
