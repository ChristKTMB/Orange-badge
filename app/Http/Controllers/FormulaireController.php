<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Approving;
use App\Models\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormulaireController extends Controller
{
    public function index(){

        $user = Auth::user();
        $managers = User::all();
        $directions = Direction::all();
        $approvers = Approving::where('etat', 1)->get()->toArray();
        return view('badge.formulaire', compact('user','managers','directions', 'approvers'));
    }
}
