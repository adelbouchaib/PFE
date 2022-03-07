<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class DashboardController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }
    public function index()
    {
        $users = User::all();
        return view('index',compact('users'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('login'));
    }
}
