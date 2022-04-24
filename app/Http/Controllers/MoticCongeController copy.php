<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Conge;
use App\Models\Motifconge;
use Response;


use Illuminate\Http\Request;

class MotifCongeController extends Controller
{
    public function  index(){

        $conges = Motifconge::with('users')->get();
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

        $conges = Motifconge::with('users')->first();
        
        $conges->flatMap->users;
        return response()->json(['data' => $conges]);
      
    }


    public function  create(Request $request){

        $projet = new Projet();

        // $conge->type = $request->type;
        
        $projet->save();

       $motifconge = Motifconge::where('type','LIKE','0')->first();
       $user = User::where('id','=','2')->first();
       $motifconge->users()->attach($user,['date_sortie' => '2022/04/04','date_entree' => '2022/04/04',
       'etat' => '0', 'duree' => '2022'] );
        
           
        

    }
}
