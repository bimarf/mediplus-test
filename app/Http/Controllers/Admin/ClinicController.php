<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clinic;
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

        return Inertia('Admin/Index', [
            'clinic' => $clinic
        ]);
    }

    public function create(){
        return Inertia('Admin/Create');
    }

    public function store(Request $request) {
        try {
            $validate = $request->validate([
                'name' => 'required',
                'address' => 'required',
                'category' => 'required',
            ]);

            $data = $request->all();

            $data['image'] = Storage::disk('public')->put('clinic', $request->file('image'));
            $clinic = Clinic::create($data);

            return redirect()->route('admin.dashboard.clinic.index')->with([
                'message' => "Successfuly Created!",
                'type' => "success"
            ]);

        } catch (\Throwable $th) {
            return redirect()->back()->with([
                'message' => $th->getMessage(),
                'type' => "error"
            ]);
        }
    }

    public function destroy($id) {
        $clinic = Clinic::find($id);
        $clinic->delete();
        return redirect()->route('admin.dashboard.clinic.index')->with([
            'message' => "Successfuly Deleted!",
            'type' => "success"
        ]);
    }
}
