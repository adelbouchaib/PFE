<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Presence;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class PresenceController extends Controller
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
            $presences = Presence::join('users', 'presences.matricule', '=', 'users.matricule')
            ->where('start_time','!=',"00:00:00")
            ->where('start_time','<=',"09:00:00")
            ->where('end_time','>=',"15:00:00")
            ->orderBy('presences.id', 'DESC')
            ->get();
        }
        else{
            $presences = User::join('presences', 'users.matricule', '=', 'presences.matricule')
            ->where('start_time','!=',"00:00:00")
            ->where('start_time','<=',"09:00:00")
            ->where('end_time','>=',"15:00:00")
            ->where('users.matricule','=',Auth::User()->matricule)
            ->orderBy('presences.id', 'DESC')
            ->get();
        }

       
        
        return view('admin.presence.index',compact('presences'));
    }

    public function search(Request $request)
    {
        if(Auth::User()->role==0){
            if(isset($request->date)){
                $presences = Presence::join('users', 'presences.matricule', '=', 'users.matricule')
                ->where('date','=',$request->date)
                ->orderBy('presences.id', 'DESC')
                ->get();           
            }
            else{
                $presences = presence::join('users', 'presences.matricule', '=', 'users.matricule')
                ->orderBy('presences.id', 'DESC')
                ->get(); 
            }
        }else{
            if(isset($request->date)){
                $presences = Presence::join('users', 'presences.matricule', '=', 'users.matricule')
                ->where('date','=',$request->date)
                ->where('users.matricule','=',Auth::User()->matricule)
                ->orderBy('presences.id', 'DESC')
                ->get();           
            }
            else{
                $presences = Presence::join('users', 'presences.matricule', '=', 'users.matricule')
                ->where('users.matricule','=',Auth::User()->matricule)
                ->orderBy('presences.id', 'DESC')
                ->get(); 
            }

        }
        
        return view('admin.presence.index',compact('presences'));
    }



    public function startWork(Request $request)
    {

        $this->validate($request,[
            'matricule'=>'required',
        ]);

        if(DB::table('users')->where('matricule', $request->matricule)->exists()){
            $todayDate = Carbon::now()->format('Y-m-d'); 
            $p = DB::table('presences')->where('matricule', $request->matricule)->where('date', $todayDate)->first();
                if($p->start_time == "00:00:00"){
                    $presence = Presence::whereDate('date',$todayDate)->where('matricule',$request->matricule)->first();
                    $presence->start_time = Date('H:i:s');
                    $presence->save();
                    return response()->json(['success' => true, 'created'=> true, 'msg' => 'Bonne journée']);
                
                }
                else
                {
                    $presence = Presence::whereDate('date',$todayDate)->where('matricule',$request->matricule)->first();
                    $presence->end_time = Date('H:i:s');
                    $presence->save();
                    return response()->json(['success' => true, 'created'=> true, 'msg' => 'Au revoir']);
                }
        }else  return response()->json(['success' => true, 'created'=> true, 'msg' => 'Qr code erroné']);



       
    }
    
}
