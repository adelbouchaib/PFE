<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Conge;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;



class AdminController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        $usersnb = User::count();
        $usersnbatt = Attendance::where('date',Carbon::today())->count();
        $usersnbconge = Conge::where('date_entree','>=',Carbon::today())->count();
        $conges = User::
        join('conges', 'users.id', '=', 'conges.user_id')
        ->where('etat','=','0')->orderBy('created_at','desc')->limit(4)
        ->get(array('users.first_name','users.last_name', 'conges.*'));

        $attendance = Attendance::select(DB::raw("COUNT(*) as count"))
        ->whereYear('date',date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('count');

        $months = Attendance::select(DB::raw("Month(date) as month"))
        ->whereYear('date',date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->pluck('month');


        $datas = array(0,0,0,0,0,0,0,0,0,0,0,0,100);

        foreach($months as $index => $month)
        {
            $datas[$month-1] = $attendance[$index]/$usersnb/Carbon::now()->month($month)->daysInMonth
            *100;
        }

        return view('admin.index',compact('users', 'usersnb', 'usersnbatt','usersnbconge','conges','datas'));

    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
