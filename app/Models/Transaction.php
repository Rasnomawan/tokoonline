<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    protected $fillable = [
        'product_id',
        'customer_id',
        'quantity',
        'total_price'
    ];

    public function product(){
        return $this->belongsTo(Product::class,'product_id');;
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'transaction_id');
    }

}
