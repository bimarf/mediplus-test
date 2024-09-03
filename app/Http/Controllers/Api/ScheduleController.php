<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Schedule;

class ScheduleController extends Controller
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

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'price' => 'required|numeric',
                'kuota' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if (Schedule::where('date', $request->date)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Schedule already exists',
                    'status' => 409
                ]);
            }

            $schedule = Schedule::create([
                'date' => $request->date,
                'price' => $request->price,
                'kuota' => $request->kuota,
            ]);

            return response()->json([
                'success' => true,
                'data' => Schedule::where('id', $schedule->id)->first(),
                'message' => 'Schedule created successfully',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
