<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit($id){

        $user = auth()->user();
        $managers = User::all();
        $directions = Direction::all();

        return view("profile",compact("user", "managers","directions"));
    }

    public function update(Request $request){ 
        
        $user = auth()->user();

        $data = $request->validate([
            'direction' => 'required',
            'fonction' => 'required',
            'matricule' => 'required',
            'manager' => 'required',
        ]);

        $user->direction = $data['direction'];
        $user->fonction = $data['fonction'];
        $user->matricule = $data['matricule'];
        $user->manager = $data['manager'];
        $user->save();
        
        return redirect()->route('historic');
    }
}
