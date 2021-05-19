<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ProfileDoctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
        $doctors = ProfileDoctor::with('user')->paginate(10);
        return responseJson(1,'doctors list',$doctors);
    }
}
