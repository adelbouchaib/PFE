<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AgentController extends Controller
{
    public function __construct() 
    {
        $this->middleware('agent');
    }
    public function index()
    {
        $users = User::all();
        return view('agent.index',compact('users'));
    }
    public function agent()
    {
        $users = User::all();
        return view('agent.index',compact('users'));
    }

}
