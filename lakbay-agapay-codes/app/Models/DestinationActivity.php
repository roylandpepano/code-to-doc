<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationActivity extends Model
{
    use HasFactory;

    protected $table = 'destination_activities';
    protected $fillable = [
        'destination_id',
        'activity',
        'activity_description',
        'activity_fee',
        'activity_number_of_pax',
    ];
}
