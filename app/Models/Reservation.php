<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'profile_doctor_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function profileDoctor()
    {
        return $this->belongsTo(ProfileDoctor::class,'profile_doctor_id','id');
    }

    public static function hasReservation($doctor_id)
    {
       return Reservation::where('user_id',auth()->id())
            ->where('profile_doctor_id',$doctor_id)
            ->where('status','pending')
            ->exists();
    }
}
