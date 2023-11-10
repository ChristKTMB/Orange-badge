<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    //
    public function index()
    {
        $categories = Categorie::orderBy('id', 'desc')->paginate(9);

        return view('categorie.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nom' => 'required|string|max:255|unique:directions,nom',
        ]);

        $nomCategorie = strtoupper($validateData['nom']);

        $categorie = Categorie::create(['nom' => $nomCategorie]);

        return redirect()->route('categorie.index');
    }

    public function edit($id)
    {

        $categorie = Categorie::find($id);
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->nom = strtoupper($request['nom']);

        $categorie->save();

        return redirect()->route('categorie.index');
    }
}
