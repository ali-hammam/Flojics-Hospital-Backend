<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Reserve;
use App\Models\Specializtion;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getSpecializations(){
        return response()->json([
           'data' => Specializtion::all()
        ]);
    }

    public function addDoctor(Request $request){
        $doctor = $request->all();
        $doctor['image'] = 's';
        return response()->json([
            'doctor' => Doctor::create($doctor)
        ]);
    }

    public function getDoctors(){
        return response()->json([
           'data' => Doctor::get(['id', 'name'])
        ]);
    }

    public function getAllDoctors(){
        return response()->json([
            'data' => Doctor::all()
        ]);
    }

    public function editDoctor(Request $request){
        $doctor = Doctor::findOrFail($request['doctor_id']);
        if($request['field'] == 'specialization'){
            $doctor['specializtion_id'] = $request['specializtion_id'];
        }else {
            $doctor[$request['field']] = $request[$request['field']];
        }
        $doctor->save();

        return response()->json([
           'status' => 'updated'
        ]);
    }

    public function deleteDoctor(Request $request){
        $doctor = Doctor::findOrFail($request['doctor_id']);
        $doctor->delete();
        return response()->json([
            'status' => 'deleted'
        ]);
    }

    public function getDoctorReservations(Request $request, $id){
        $reservations = Reserve::where('doctor_id', $id)->with('user')->get();

        return response()->json([
            'data' => $reservations
        ]);
    }
}
