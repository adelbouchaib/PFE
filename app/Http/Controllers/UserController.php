<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Direction;
use App\Models\Branche;

use App\Helpers\helper;


use App\Models\Attendance;
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


        $users =  User::where('first_name','LIKE','%'.$request->data.'%')
        ->orWhere('last_name','LIKE','%'.$request->data.'%')
        ->orWhere('position','LIKE','%'.$request->data.'%')
        ->orWhere('matricule','LIKE','%'.$request->data.'%')
        ->orWhere('email','LIKE','%'.$request->data.'%')
        ->orWhere('phone','LIKE','%'.$request->data.'%')
        ->get();
        $directions = Direction::all();
        $branches = Branche::all();
        return view('admin.user.index',compact('users','directions','branches'));
    }
    
    public function employee($matricule)
    {
        $users = User::all();
        $attendances = Attendance::all();
        $users2 = User::where('matricule','=',$matricule)->first();
        return view('admin.user.employee', ['users2' => $users2], compact('users', 'attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required',
            'role'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);

        $matricule = Helper::matricule($request->departement, $request->start_date, "F");

        $user = new User();
        $user->matricule = $matricule;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->departement = $request->departement;
        $user->role = $request->role;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;


        $user->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::find($id);
        return response()->json(['data' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         $this->validate($request,[
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required',
            'role'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);
        $id = $request->id;
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->delete();
        return $user;
    }


}
