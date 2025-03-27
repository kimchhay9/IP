<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';
    protected $fillable = ['order_date'];

    protected function orderDate(): Attribute
    {
        return Attribute::make(
            // Mutator: Convert input format (DD/MM/YYYY HH:MM:SS) to MySQL format (Y-m-d H:i:s)
            set: function ($value) {
                return $value ? Carbon::createFromFormat('d/m/Y H:i:s', $value)->format('Y-m-d H:i:s') : null;
            },

            // Accessor: Convert stored format back to DD/MM/YYYY HH:MM:SS when retrieving
            get: function ($value) {
                return $value ? Carbon::parse($value)->format('d/m/Y H:i:s') : null;
            }
        );
    }
}
