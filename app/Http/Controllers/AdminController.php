<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
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
        return view('admin.index',compact('users', 'usersnb', 'usersnbatt'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
