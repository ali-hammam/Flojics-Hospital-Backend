<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $request['password'] = Hash::make($request['password']);
        $userData = $request->all();
        $userData['is_admin'] = 0;
        $user = User::create($userData);

        return response()->json([
            "status" => 200,
            "user" =>  $user
        ]);
    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email' , 'password'))){
            return response()->json([
                'message' => 'invalid credentials',
                'data' => $request->all()
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt' , $token , 60*24);
        return response()->json([
            'message' => $token,
            'user' => $user
        ])->withCookie($cookie);
    }

    public function  logout(){
        $cookie = \Illuminate\Support\Facades\Cookie::forget('jwt');
        return \response()->json([
            'message' => 'success'
        ])->withCookie($cookie);
    }

    public function user(){
        return response()->json([
            'user' => Auth::user()
        ]);
    }

    public function loginValidation(Request $request){
        $user = User::where('email', $request['email'])->first();
        if($user) {
            $user->makeVisible(['password']);
            return $user['password'] === $request['password'];
        }
        return 0;
    }

    public function addImage(/*Request $request*/$previwImage, $previewTitle){
        $base64_str = substr($previwImage, strpos($previwImage, ",")+1);
        $image = base64_decode($base64_str );
        file_put_contents(public_path('images/users/'.$this->imageName($previewTitle)),$image);
    }

    private function imageName($previewTitle){
        return time().$previewTitle;
    }
}
