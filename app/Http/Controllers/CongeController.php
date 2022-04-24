<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Conge;
use App\Models\Motifconge;
use Response;


use Illuminate\Http\Request;

class CongeController extends Controller
{
    
    public function  index(){

        $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
        ->where('etat','0')
        ->get();
        return view('admin.conge.index',compact('conges'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $conge = Conge::find('1');
        return response()->json(['data' => $conge]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $conge = Conge::find($id);
        $conge->date_sortie = $request->date_sortie;
        $conge->date_entree = $request->date_entree;
        $conge->duree = $request->duree;
        $conge->etat = $request->etat;
        $conge->save();
    }

    public function search(Request $request){

        
        $search_text = $request->data;

            $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
            ->where('etat','=',$search_text)
            ->get();


        
        return view('admin.conge.index',compact('conges'));
    }


}
