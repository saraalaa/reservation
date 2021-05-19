<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Notifications\ReserveAccepted;
use App\Notifications\ReserveMade;
use App\Notifications\ReserveRejected;
use App\User;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function store(){

        $doctor = User::findOrFail(\request('doctor'));

        $this->validateServe();

        $reservation = Reservation::create([
            'profile_doctor_id' => $doctor->profileDoctor->id,
            'user_id' => auth()->id(),
        ]);


        // send notification to doctor

        $doctor->notify(new ReserveMade($reservation->id));
        return redirect()->back();

    }

    private function validateServe(){

        $doctor = User::findOrFail(\request('doctor'));

        if (!($doctor && $doctor->type == 'doctor' && $doctor->profileDoctor->is_approved == 1) ){
            abort(403);
        }

        // check if this user reserve at this session before
        if (Reservation::hasReservation($doctor->profileDoctor->id))
            abort(403,'you reserve at this session before');


    }

    public function doctorReservations(){

        // this function for all reservations of login doctor

        $pending_reservations = Reservation::where('profile_doctor_id' , auth()->user()->profileDoctor->id)
            ->where('status','pending')
            ->whereHas('profileDoctor', function ($query) {
                $query->where('is_approved','=','1');
            })
            ->whereHas('user', function ($query) {
                $query->where('is_ban','!=','1');
            })
            ->latest()
            ->paginate(10);

        $done_reservations = Reservation::where('profile_doctor_id' , auth()->user()->profileDoctor->id)
            ->where('status','!=','pending')
            ->latest()
            ->paginate(10);

        return view('reservation.doctor_reservations' , compact('pending_reservations', 'done_reservations'));
    }

    public function accept(){

        // validate
        $this->validateReservation();

        $reservation = Reservation::findOrFail(\request('reservation'));
        $reservation->status = 'accepted';
        $reservation->save();

        $doctor = $reservation->profileDoctor->user;
        $user = $reservation->user;;

        $user->notify(new ReserveAccepted($doctor->id ,$doctor->name));

        return back();
    }
    public function reject(){

        // validate
        $this->validateReservation();

        $reservation = Reservation::findOrFail(\request('reservation'));
        $reservation->status = 'rejected';
        $reservation->save();

        $doctor = $reservation->profileDoctor->user;
        $user = $reservation->user;;

        $user->notify(new ReserveRejected($doctor->id ,$doctor->name));


        return back();

    }

    public function validateReservation(){
        $reservation = Reservation::where('id',\request('reservation'))
            ->where('profile_doctor_id' , auth()->user()->profileDoctor->id)
            ->where('status','pending')
            ->whereHas('profileDoctor', function ($query) {
                $query->where('is_approved','=','1');
            })
            ->whereHas('user', function ($query) {
                $query->where('is_ban','!=','1');
            })
            ->first();
        if (!$reservation) abort(403);
    }

    public function index(){
        $done_reservations = Reservation::where('status','!=','pending')
            ->latest()
            ->paginate(10);

        $pending_reservations = Reservation::where('status','=','pending')
            ->latest()
            ->paginate(10);


        return view('reservation.index',compact('done_reservations','pending_reservations'));

    }
}
