<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit($id){

        $user = auth()->user();
        $managers = User::all();

        return view("profile",compact("user", "managers"));
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
        return redirect()->route('home');
    }
}
