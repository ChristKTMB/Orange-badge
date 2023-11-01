<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index(){
        $users = User::paginate(9);

        return view("user.index",compact("users"));
    }

    public function edit($id){

        $direction = User::find($id);  
    }

    public function update(Request $request, $id){
        $direction = User::find($id);
        $direction->nom = $request->input('nom');
        $direction->save();

        return redirect()->route('direction.index');
    }
}
