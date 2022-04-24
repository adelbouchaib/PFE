<?php

namespace App\Http\Controllers;
use App\Models\Vacance;
use Illuminate\Http\Request;
use Auth;




class VacanceController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request->ajax())
    	{
    		$data = Vacance::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}
    	return view('admin.vacance.index');
    }

    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
   
                $event = new Vacance();
                $event->title = $request->title;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->save();

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
                $id = $request->id;
                $event = Vacance::find($id);
                $event->title = $request->title;
                $event->start = $request->start;
                $event->end = $request->end;
                $event->save();

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Vacance::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }

    	
    

    
}
