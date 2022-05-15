<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conge;
use App\Models\Presence;
use App\Models\Projet;


use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;



class DashboardController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::User()->role == 0)
        {
        $users = User::all();
        $usersnb = User::count();
        $usersnbatt = Presence::where('date',Carbon::today())->count();
        $usersnbconge = Conge::where('start','>=',Carbon::today())->count();
        $conges = User::
        join('conges', 'users.id', '=', 'conges.user_id')
        ->where('etat','=','0')->orderBy('created_at','desc')->limit(4)
        ->get(array('users.prenom','users.nom', 'conges.*'));

        $presence = Presence::select(DB::raw("COUNT(*) as count"))
        ->whereYear('date',date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('count');

        $months = Presence::select(DB::raw("Month(date) as month"))
        ->whereYear('date',date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('month');


        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0,100);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $presence[$index]/$usersnb/Carbon::now()->month($month)->daysInMonth
            *100;
        }

        $projets= 
        User::join('projets', 'users.id', '=', 'projets.user_id')
        ->paginate(5);

        return view('admin.index',compact('users', 'projets','usersnb', 'usersnbatt','usersnbconge','conges','datas'));


       
   
}elseif(Auth::User()->role == 1)
{
    $users = User::all();
        return view('employee.index',compact('users'));
  
}
else{
    $users = User::all();
        return view('agent.index',compact('users'));
}

    }

public function logout(Request $request)
{
    Auth::logout();
    return redirect(route('login'));
}

}
