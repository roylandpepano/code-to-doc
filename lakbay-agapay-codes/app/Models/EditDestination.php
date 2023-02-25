<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class EditDestination extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'edit_destination_details';
    protected $fillable = [
        'user_id',
        'destination_id',
        'dest_name',
        'dest_operating',
        'dest_owner',
        'dest_business_permit',
        'dest_city',
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
        'edt_dest_reason',
        'edit_dest_approval',
    ];
}
