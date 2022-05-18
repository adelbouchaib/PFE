<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Direction;
use App\Models\Branche;

use Illuminate\Http\Request;

class StructureController extends Controller
{

      


    public function direction()
    {
        $allusers= User::all();
        $branches= Branche::all();
        $directions = Direction::
        join('users', 'directions.user_id', '=', 'users.id')
        ->join('branches', 'directions.branche_id', '=', 'branches.id')
        ->get();

        return view('admin.structure.direction',compact('allusers','directions','branches'));
    }

    public function branche()
    {
        $allusers= User::all();
        $branches = Branche::all();

        return view('admin.structure.branche',compact('allusers','branches'));
    }


        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $date_debut
     * @param  int  $date_fin
     * @param  int  $newDate
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
    
           $direction = new Direction();
           $direction->nom_direction = $request->nom_direction;
           $direction->branche_id = $request->branche_id;
           $direction->user_id = $request->user_id;
           $direction->save();
           return redirect(route('admin.structure.direction'));

    
        }
        public function save(Request $request){
    
            $branche = new Branche();
            $branche->nom_branche = $request->nom_branche;
            $branche->save();
            return redirect(route('admin.structure.branche'));
 
     
         }
     
    
    
}
