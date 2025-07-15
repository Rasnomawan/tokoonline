<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'category_id',
        'description',
        'image',
        'stock',
        'price'
    ];
    public function category(){
        return $this->belongsto(Categories::class);
    }
}
