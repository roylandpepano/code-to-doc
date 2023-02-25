<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TourOperator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        protected $fillable = [
            'user_id',
            'operator_company',
            'operator_main_picture',
            'operator_operating',
            'operator_business_permit',
            'operator_location',
            'operator_city',
            'operator_description',
            'operator_services',
            'operator_email',
            'operator_phone_number',
            'operator_fb',
            'operator_twitter',
            'operator_instagram',
            'operator_website',
            'operator_approval',
            'operator_reasons'
        ];
    public function rate(){
        return $this->hasMany('App\Models\TourOperatorRating');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
