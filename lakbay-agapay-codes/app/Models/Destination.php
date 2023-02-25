<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Destination extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'dest_owner',
        'dest_operating',
        'dest_longitude',
        'dest_latitude',
        'dest_name',
        'dest_city',
        'dest_main_picture',
        'dest_business_permit',
        'dest_address',
        'dest_phone',
        'dest_email',
        'dest_date_opened',
        'dest_working_hours',
        'dest_description',
        'dest_direction',
        'dest_fare',
        'dest_entrance_fee',
        'dest_category',
        'dest_fb',
        'dest_twt',
        'dest_ig',
        'dest_web',
        'famous',
        'hidden_gem',
        'dest_approval',
        'dest_rating_average'
    ];
    public function rate(){
        return $this->hasMany('App\Models\DestinationRating');
    }

}
