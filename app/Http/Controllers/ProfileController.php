<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function edit($id){

        $user = User::find($id);

        $usersResponse = Http::get('http://10.143.41.70:8000/promo2/odcapi/?method=getUsers');
        $managers = json_decode($usersResponse->body());
        $directions = Direction::all();

        return view("profile",compact("user", "managers","directions"));
    }

    public function update(Request $request, $user){ 
        
        $user = User::find($user);

        $data = $request->validate([
            'direction' => 'required',
            'fonction' => 'required',
            'matricule' => 'required',
            'manager' => 'required',
            'role' => 'required|in:user,admin',
            'status' => 'required|in:1,0'
        ]);
        
        $user->direction = $data['direction'];
        $user->fonction = $data['fonction'];
        $user->matricule = $data['matricule'];
        $user->manager = $data['manager'];
        $user->profil_complete = true;
        $user->role = $data['role'];
        $user->status = $data['status'];
        $user->save();
        
        if($user->role =='admin'){
            return redirect()->route('user.index');
        }
        return redirect()->route('historic');
    }
}
