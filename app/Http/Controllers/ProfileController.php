<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function edit($id)
    {

        $user = User::find($id);

        $usersResponse = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');
        $managers = json_decode($usersResponse->body());
        $directions = Direction::all();

        return view("profile", compact("user", "managers", "directions"));
    }

    public function update(Request $request, $user)
    {

        $user = User::find($user);
        $user->update([
            'direction_id' => $request->direction_id,
            'fonction' => $request->fonction,
            'matricule' => $request->matricule,
            'manager' => $request->manager,
            'profil_complete' => 1,
            'role' => $request->role,
        ]);
        $user->status = $request->status;
        $user->profil_complete = 1;
        $user->save();
        if (Auth::user()->role == 'admin') {
            return redirect()->route('user.index');
        }else{
            return redirect()->route('historic');
        } 
    }
}
