<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Payment extends Model
{
    use HasFactory, SoftDeletes; // Enable soft deletes

    protected $fillable = ['order_id', 'payment_method', 'amount', 'customer_id', 'payment_date'];

    protected $dates = ['deleted_at']; // Track soft delete timestamp

    protected function paymentDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i:s'), // Fixed format string
            set: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i:s') // Fixed format string
        );
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
