<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Direction;


use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index()
    {
        $allusers= User::all();
        $directions = User::join('directions', 'users.id', '=', 'directions.user_id')
        ->get();

        return view('admin.direction.index',compact('allusers','directions'));
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
           $direction->title = $request->title;
           $direction->user_id = $request->user_id;
           $direction->save();
           return redirect(route('admin.direction.index'));

    
        }
    
    
}
