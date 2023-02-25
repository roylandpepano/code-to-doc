<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationPackage extends Model
{
    use HasFactory;

    protected $table = 'destination_packages';
    protected $fillable = [
        'destination_id',
        'dest_pkg_name',
        'dest_pkg_description',
        'dest_pkg_rate',
        'dest_pkg_min_fee',
        'dest_pkg_inclusions',
    ];
}
