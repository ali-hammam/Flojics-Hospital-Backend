<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function getPatientName(Request $request){
        $data = [];
        if($request['patientName'] === ''){
            $data = User::all();
        }else{
            $data = User::where('name', 'like', '%'. $request['patientName'].'%')
                ->where('is_admin',0)
                ->get();
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function makeReservation(Request $request){
        $request['appointment'] = date('Y-m-d H:i:s', strtotime($request['appointment']));
        $reserve = Reserve::create($request->all());
        return response()->json([
            'status' => 200
        ]);
    }

    public function deleteReservation($id){
        Reserve::where('id', '=', $id)->delete();
        return response()->json([
            'status' => 200
        ]);
    }

    public function updateReservation(Request $request, $id){
        $request['appointment'] = date('Y-m-d H:i:s', strtotime($request['appointment']));
        Reserve::where('id', '=', $id)->update(['appointment' => $request['appointment']]);
        return response()->json([
            'status' => 200
        ]);
    }
}
