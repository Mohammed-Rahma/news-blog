<?php

namespace App\Http\Controllers\api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'email'=>['required' , 'email'],
            'password'=>['required'],
            'device_name'=>['nullable'],
            'abilities'=>['array']

        ]);



        $user = User::where('email', '=', $request->email)
            ->first(); 

        if ($user && Hash::check($request->password, $user->password)) {

            $name = $request->input('device_name', $request->userAgent()); 
            $token =  $user->createToken($name, $request->input('abilities' , ['*']), now()->addDays(30)); 
            return response([
                'access_token' => $token->plainTextToken,
                'usre' => $user 
            ]);
        }

        return response([
            'message' => 'Invalid credentails'
        ],  401); 

    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
        $user->currentAccessToken()->delete();

        return response([
            'message' => 'Invalid credentails'
        ],  204); 

        $user->tokens()->delete();
    }

    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        return $user->tokens;
    }
}
