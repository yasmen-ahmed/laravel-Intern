<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(Request $request, $id)
    {
        $user=User::find($id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->role=$request->role;
            $user->save();
            return $user;
      
    }


    public function destroy( $id)
    {
        $user=User::find($id);
       
            User::find($id)->delete();

              return "user is deleted ";

    }
}
