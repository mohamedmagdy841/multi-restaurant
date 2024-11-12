<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id','id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id','id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id','id');
    }
}
