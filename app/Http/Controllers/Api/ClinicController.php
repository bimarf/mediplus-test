<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Clinic;
use App\Models\Schedule;

class ClinicController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function index() {
        return response()->json([
            'data' => Clinic::all(),
        ]);
     }

     public function store(Request $request){
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            if(Clinic::where('name', $request->name)->exists()){
                return response()->json([
                    'success' => false,
                    'message' => 'Clinic already exists',
                    'status' => 409
                ]);
            }

            $clinic = Clinic::create([
                'name' => $request->name,
                'category' => $request->category,
                'address' => $request->address,
                'image' => $request->image ?? null,
            ]);

            return response()->json([
                'success' => true,
                'data' => Clinic::where('id', $clinic->id)->first(),
                'message' => 'Clinic created successfully',
                'status' => 200
            ]);

        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
     }

     public function delete(Request $request, $id){
        try {
            Clinic::where('id', $id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Clinic deleted successfully',
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
     }
}
