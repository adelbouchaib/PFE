<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direction;
use App\Models\Branche;

use App\Helpers\helper;


use App\Models\Absence;
use Auth;
class UserController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }

    public function direction(Request $request){
        
        $branche = $request->id;
       
        $first = Direction::where('branche_id','=',$branche)->get();

        return response()->json([
            'directions' => $first,

        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $directions = Direction::all();
        $branches = Branche::all();
        return view('admin.user.index',compact('users','directions','branches'));
    }

    
    public function search(Request $request){


        $users =  User::where('prenom','LIKE','%'.$request->data.'%')
        ->orWhere('nom','LIKE','%'.$request->data.'%')
        ->orWhere('fonction','LIKE','%'.$request->data.'%')
        ->orWhere('matricule','LIKE','%'.$request->data.'%')
        ->orWhere('email','LIKE','%'.$request->data.'%')
        ->orWhere('num_telephone','LIKE','%'.$request->data.'%')
        ->get();
        $directions = Direction::all();
        $branches = Branche::all();
        return view('admin.user.index',compact('users','directions','branches'));
    }
    
    public function employee($matricule)
    {
        $users = User::all();
        $presences = Presence::all();
        $users2 = User::where('matricule','=',$matricule)->first();
        return view('admin.user.employee', ['users2' => $users2], compact('users', 'presences'));
    }




    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        return response()->json(['data' => $user]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



}
