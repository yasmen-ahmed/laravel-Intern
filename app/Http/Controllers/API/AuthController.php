<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatUserRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    
    public function create(CreatUserRequest $request){
       
        $user =new User();
        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=\Hash::make($request->password);
        $user->role=$request->role;
        $user->save();

        return [
            '$user'=>$user,
            'token'=> $user->createToken('ios')->plainTextToken
        ];



    }


    public function login(LoginRequest $request){
        
       if(\Auth::attempt($request->only('email','password'))){
          return [
            'user'=>\Auth::user(),
            'token'=>\Auth::user()->createToken('ForRole')->plainTextToken
        ];
    }
        else{
            return "it's not a valiable";
        }

       }

}
