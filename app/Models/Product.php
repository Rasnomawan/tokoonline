<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'category_id',
        'description',
        'image',
        'stock',
        'price'
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function transaction(){
        return $this->hasMany(Transaction::class,'product_id');
    }
}
