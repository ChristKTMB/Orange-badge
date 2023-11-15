<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Approving;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::paginate(9);

        return view("user.index", compact("users"));
    }

    public function interim()
    {
        $email = auth()->user()->email;
        $approvingUser = Approving::where('email', $email)->where('etat', 1)->first();

        if ($approvingUser || auth()->user()->role == 'admin') {
            $userId = auth()->user()->id;
            $user = User::find($userId);
            $users = $user->delegues;
            $userAll = User::all();

            return view("user.interim", compact("users", "userAll"));
        } else {
            return response()->view('erreur.error403', [], 403);
        }
    }

    public function edit_status(Request $request, $userId, $delegue)
    {
        $status = ($request->status) ? false : true;
        $date_fin = ($status) ? null : now();
        $user = User::find($userId);

        $user->delegues()->updateExistingPivot($delegue, [
            'status' => $status,
            'date_fin' => $date_fin
        ]);

        return redirect()->back()->with('success', 'Modification reussie');
    }

    public function add_interim(Request $request)
    {
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $request->validate([
            'delegue' => 'required'
        ]);
        $delegue = $request->delegue;


        $user->delegues()->attach($delegue);

        return redirect()->back()->with('success', 'Enregistrement reussi');
    }

    public function edit($id)
    {
        $direction = User::find($id);
    }

    public function update(Request $request, $id)
    {
        $direction = User::find($id);
        $direction->nom = $request->input('nom');
        $direction->save();

        return redirect()->route('direction.index');
    }
}
