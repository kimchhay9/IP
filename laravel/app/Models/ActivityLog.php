<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs'; // Ensure this matches your database table name

    protected $fillable = ['model', 'model_id', 'action', 'changes'];

    protected $casts = [
        'changes' => 'array', // Ensure changes are stored as JSON
    ];
}

