<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationAmenity extends Model
{
    use HasFactory;

    protected $table = 'destination_amenities';
    protected $fillable = [
        'destination_id',
        'amenity',
        'amenity_description',
        'amenity_fee',
    ];
}
