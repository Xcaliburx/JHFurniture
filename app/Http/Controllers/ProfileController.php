<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    //
    public function view(){
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('profile.view', ['user' => $user]);
    }

    public function edit(){
        $id = Auth::user()->id;

        $user = User::where('id', $id)->first();

        return view('profile.update', ['user' => $user]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'name' => 'required|alpha_spaces|string|unique:users,name,'.$user->id,
            'email' => 'required|string|email|unique:users,email,'.$user->id,
            'password' => 'required|string|min:5|max:29'
        ]);

        User::where('id', $user->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        if($user->roleId == 2){
            $request->validate([
                'address' => 'required|string|min:5|max:95'
            ]);
            User::where('id', $user->id)->update([
                'address' => $request->input('address')
            ]);
        }

        return redirect('/profile');
    }
}
