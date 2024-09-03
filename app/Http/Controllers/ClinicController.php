<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;
use App\Models\Schedule;
use App\Models\ScheduleBooked;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ClinicController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function index() {
        $clinic = Clinic::all();

        return Inertia('User/Index', [
            'clinic' => $clinic
        ]);
    }

    public function booking($id) {
        $check = ScheduleBooked::where('user_id', Auth::user()->id)->where('clinic_id', $id)->first();
        if($check) {
            return redirect('/dashboard')->with([
                'message' => "Already Booked!",
                'type' => "warning"
            ]);
        }

        $clinic = Clinic::find($id);
        $schedule = Schedule::all();
        return Inertia('User/Booking', [
            'schedule' => $schedule,
            'clinic' => $clinic
        ]);
    }

    public function storeBooking(Request $request) {
        $data = [
            'clinic_id' => $request->clinic_id,
            'schedule_id' => $request->schedule_id,
            'user_id' => Auth::user()->id
        ];

        ScheduleBooked::create($data);
        return redirect('/dashboard')->with([
            'message' => "Successfuly Booked!",
            'type' => "success"
        ]);
    }
}
