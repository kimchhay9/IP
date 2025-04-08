<?php
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use softDeletes;
    protected $fillable = ['customer_id', 'product_id', 'quantity'];
    protected $dates = ['deleted_at']; 

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}