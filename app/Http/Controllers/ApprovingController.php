<?php

namespace App\Http\Controllers;

use App\Models\Approving;
use Illuminate\Http\Request;

class ApprovingController extends Controller
{
    public function index()
    {
        $input = [
            'name' => 'Demo Title',
            'approving' => 'kakesa'
        
        ];
  
        $item = Approving::create($input);
  
        dd($item->data);
  
    }
}
