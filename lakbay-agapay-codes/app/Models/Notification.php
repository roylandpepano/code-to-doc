<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination_id',
        'tour_operator_id',
        'user_id',
        'notif_type',
        'notif_message',
        'notif_read'
    ];
}
