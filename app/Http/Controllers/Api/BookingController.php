<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ScheduleBooked;
use App\Models\Schedule;

class BookingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'schedule_id' => 'required|exists:schedules,id',
                'user_id' => 'required|exists:users,id',
                'clinic_id' => 'required|exists:clinics,id',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if(ScheduleBooked::where('schedule_id', $request->schedule_id)->exists() && ScheduleBooked::where('user_id', $request->user_id)->exists()){
                return response()->json([
                    'success' => false,
                    'message' => 'Already booked!',
                    'status' => 409
                ]);
            }

            if (ScheduleBooked::where('schedule_id', $request->schedule_id)->count() == Schedule::find($request->schedule_id)->kuota) {
                return response()->json([
                    'success' => false,
                    'message' => 'Schedule is full!',
                    'status' => 409
                ]);
            }

            $schedule = ScheduleBooked::create([
                'schedule_id' => $request->schedule_id,
                'user_id' => $request->user_id,
                'clinic_id' => $request->clinic_id,
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'user_name' => $schedule->user->name,
                    'name' => $schedule->clinic->name,
                    'address' => $schedule->clinic->address,
                    'date' => $schedule->schedule->date
                ],
                'message' => 'Booking created successfully',
                'status' => 200
            ]);

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
