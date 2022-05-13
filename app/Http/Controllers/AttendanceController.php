<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Absence;
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
        if(Auth::User()->role==0)
        {
            $attendances = User::join('attendances', 'users.matricule', '=', 'attendances.matricule')
            ->orderBy('attendances.id', 'DESC')
            ->get();
        }
        else{
            $attendances = User::join('attendances', 'users.matricule', '=', 'attendances.matricule')
            ->where('users.matricule','=',Auth::User()->matricule)
            ->orderBy('attendances.id', 'DESC')
            ->get();
        }
       
        
        return view('admin.attendance.index',compact('attendances'));
    }

    public function search(Request $request)
    {
        if(Auth::User()->role==0){
            if(isset($request->date)){
                $attendances = Attendance::join('users', 'attendances.matricule', '=', 'users.matricule')
                ->where('date','=',$request->date)
                ->orderBy('attendances.id', 'DESC')
                ->get();           
            }
            else{
                $attendances = Attendance::join('users', 'attendances.matricule', '=', 'users.matricule')
                ->orderBy('attendances.id', 'DESC')
                ->get(); 
            }
        }else{
            if(isset($request->date)){
                $attendances = Attendance::join('users', 'attendances.matricule', '=', 'users.matricule')
                ->where('date','=',$request->date)
                ->where('users.matricule','=',Auth::User()->matricule)
                ->orderBy('attendances.id', 'DESC')
                ->get();           
            }
            else{
                $attendances = Attendance::join('users', 'attendances.matricule', '=', 'users.matricule')
                ->where('users.matricule','=',Auth::User()->matricule)
                ->orderBy('attendances.id', 'DESC')
                ->get(); 
            }

        }
        
        return view('admin.attendance.index',compact('attendances'));
    }



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
    
}
