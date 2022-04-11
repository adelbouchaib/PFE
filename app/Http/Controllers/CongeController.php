<?php

namespace App\Http\Controllers;
use App\Models\Conge;
use Illuminate\Http\Request;
use Auth;




class CongeController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Conge::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title','user_id', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('admin.conge.index');
    }

    	
    

    
}
