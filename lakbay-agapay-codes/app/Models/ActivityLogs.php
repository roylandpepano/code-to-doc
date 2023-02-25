<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';
    protected $fillable = [
        'user_id',
        'destination_id',
        'tour_operator_id',
        'log_activity',
        'editor',
        'log_action'
    ];
}
