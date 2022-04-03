<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AbsenceController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function conge(){

        return view('admin.absence.conge');
    }
}
