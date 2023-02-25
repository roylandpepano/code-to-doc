<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinationImage extends Model
{
    use HasFactory;

//    /**
//     * @var false|mixed|string
//     */
    protected $table = 'destination_images';
    protected $fillable = [
        'destination_id',
        'dest_image'
    ];
}
