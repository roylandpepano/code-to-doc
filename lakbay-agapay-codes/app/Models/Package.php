<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_operator_id',
        'package_name',
        'package_description',
        'package_rate',
        'package_minimum_fee',
        'package_fee',
        'package_inclusions',
        'package_itinerary',
    ];
}
