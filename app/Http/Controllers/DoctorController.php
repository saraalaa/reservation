<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::with('profileDoctor')
                    ->latest()
                    ->where('type','doctor')
                    ->paginate(10);

        return view('doctor.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctor.create');
    }

    public function store(DoctorRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);
        $user->profileDoctor()->create($validated);

        Auth::login($user);
        return redirect('home');
    }

    public function approve(User $user){
        $doctor = $user->profileDoctor;
        $doctor->is_approved = true;
        $doctor->save();

        return back();
    }

    public function reject(User $user){
        $doctor = $user->profileDoctor;
        $doctor->is_approved = false;
        $doctor->save();
        return back();
    }

    public function specialities()
    {
        $doctors = User::whereHas('profileDoctor', function ($query) {
            $query->where('is_approved','=','1');
        })
            ->with('profileDoctor')
            ->latest()
            ->where('type','doctor')
            ->paginate(10);

//        $is_served_before = new IsServedBefore($doctor);

        return view('doctor.index', compact('doctors'));
    }
}
