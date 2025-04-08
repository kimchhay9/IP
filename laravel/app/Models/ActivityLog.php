<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use SoftDeletes; // Enable soft deletes

    protected $fillable = ['model', 'model_id', 'action', 'changes'];
    protected $casts = ['changes' => 'array']; // Ensure changes are stored as JSON

    protected $dates = ['deleted_at']; // Track soft delete timestamp
}
