<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProfileDoctor extends Model
{
    protected $fillable = [
        'speciality','description','fees','location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'profile_doctor_id','id');
    }

//    public static function allDoctors()
//    {
//        return ProfileDoctor::with('user')->paginate(10);
//    }
}
