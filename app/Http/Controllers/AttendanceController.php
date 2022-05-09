<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\User;
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
       
        $attendances = Attendance::where('date','=',Carbon::now()->format('Y-m-d'))->get();
        return view('admin.attendance.index',compact('attendances'));
    }
    public function search(Request $request)
    {
       
        $attendances = Attendance::where('date','=',$request->date)->get();
        return view('admin.attendance.index',compact('attendances'));
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
            'matricule'=>'required',
        ]);

        if(DB::table('users')->where('matricule', $request->matricule)->exists()){
            $todayDate = Carbon::now()->format('Y-m-d'); 
        if(DB::table('attendances')->where('matricule', $request->matricule)->where('date', $todayDate)->doesntExist()){
            $attendance = new Attendance();
            $attendance->date = Date('Y-m-d');
            $attendance->start_time = Date('H:i:s');
            $attendance->end_time = "0:0:0";
            $attendance->matricule = $request->matricule;
            $attendance->save();
            return response()->json(['success' => true, 'created'=> true, 'msg' => 'Bonne journée']);
         
        }
        else
        {
            $currentDate = Date('Y-m-d');
            $attendance = Attendance::whereDate('date',$currentDate)->where('matricule',$request->matricule)->first();
            $attendance->end_time = Date('H:i:s');
            $attendance->save();
            return response()->json(['success' => true, 'created'=> true, 'msg' => 'Au revoir']);

          
           
            
        }
        }else  return response()->json(['success' => true, 'created'=> true, 'msg' => 'Qr code erroné']);


        
       
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
