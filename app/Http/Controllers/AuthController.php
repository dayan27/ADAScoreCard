<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){


       $credentials['email']=$request->email;
       $credentials['password']=$request->password;
       if(!Auth::attempt($credentials)){
           return response()->json(
               [
               'status'=>404,
               'message'=>'unauthorized',
               ]
               );
       }
       $user=User::where('email',$credentials['email'])
       ->where('is_active',1)->first();
       if(!$user){
          return 'U are Not Allowed';
       }
       $token=$user->createToken('auth_token')->plainTextToken;
       return response()->json([
           'access_token'=>$token,
           'user'=>$user,
       ],200);

    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return[
            'message'=>'token revoke',
        ];

    }
}
