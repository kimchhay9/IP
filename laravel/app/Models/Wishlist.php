<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
use SoftDeletes;
protected $fillable = ['customer_id', 'product_id'];
protected $dates = ['deleted_at'];

public function product()
{
return $this->belongsTo(Product::class, 'user_id', 'id');


}
public function customer()
{
return $this->belongsTo(Customer::class, 'product_id', 'id');
}
}
