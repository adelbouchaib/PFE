<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MotifAbsenceController extends Controller
{
    public function index()
    {
        $allusers= User::all();
        $motifs = MotifAbsence::
        join('absence', 'motif_absences.id', '=', 'absence.user_id')
        ->join('absence', 'users.id', '=', 'absence.user_id')
        ->get();

        return view('admin.structure.direction',compact('allusers','motifs'));
    }

}
