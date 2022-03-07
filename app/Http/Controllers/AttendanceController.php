<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class AttendanceController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $attendances = Attendance::all();
        return view('attendance.index',compact('attendances'));
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

 
    public function startWork(Request $request)
    {

        $this->validate($request,[
            'user_id'=>'required',
        ]);

        $idd=1;
        if($idd==1){
            $attendance = new Attendance();
            $attendance->date = Date('Y-m-d');
            $attendance->start_time = Date('H:i:s');
            $attendance->end_time = "0:0:0";
            $attendance->user_id = $request->user_id;
            $attendance->save();
            return redirect(route('dashboard.attendances.index'));
        }
        else
        {
            $currentDate = Date('Y-m-d');
        $attendance = Attendance::whereDate('date',$currentDate)->where('user_id',Auth::User()->id)->first();
        $attendance->end_time = Date('H:i:s');
            $attendance->save();
            return redirect(route('dashboard.attendances.index'));
        }

        
       
    }
    public function finishWork(Request $request)
    {
        $currentDate = Date('Y-m-d');
        $attendance = Attendance::whereDate('date',$currentDate)->where('user_id',Auth::User()->id)->first();
        $attendance->end_time = Date('H:i:s');
        $attendance->save();
        return redirect(route('dashboard.attendances.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
