<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function __construct() 
    {
        $this->middleware('employee');
    }
    public function index()
    {
        $users = User::all();
        return view('employee.index',compact('users'));
    }
}
