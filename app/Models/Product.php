<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product  extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'product';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok', 'status', 'kategori'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public static function GetProductActive()
    {
        return self::where('status', 'active')->get();
    }
}
