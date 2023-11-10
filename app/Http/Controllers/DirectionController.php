<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index(){
        $directions = Direction::orderBy('id', 'desc')->paginate(9);

        return view('direction.index', compact('directions'));
    }

    // public function store(Request $request){
        
    //     $nomDirection = strtolower($request->input('nom'));
    //     dd($nomDirection);

    //     $validateData = $request->validate([
    //         'nom' => 'required|string|max:255',
    //     ]);

    //     $direction = Direction::create($validateData);

    //     return redirect()->route('direction.index');
    // }

    public function store(Request $request){
        $validateData = $request->validate([
            'nom' => 'required|string|max:255|unique:directions,nom',
        ]);
    
        $nomDirection = strtoupper($validateData['nom']);
        
        $direction = Direction::create(['nom' => $nomDirection]);
    
        return redirect()->route('direction.index');
    }
    
    public function edit($id){

        $direction = Direction::find($id);  
    }

    public function update(Request $request, $id){
        $direction = Direction::find($id);
        $direction->nom = strtoupper($request['nom']);
        $direction->save();

        return redirect()->route('direction.index');
    }

    // public function destroy(Direction $direction){
    //     $direction->delete();

    //     return redirect()->route('direction.index');
    // }
}
