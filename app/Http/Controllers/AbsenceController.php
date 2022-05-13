<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Absence;
use App\Models\User;
use App\Models\TypeAbsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class AbsenceController extends Controller
{
    

    public function index()
    {
       
       

        if(Auth::User()->role==0)
        {
            $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
            ->get();
            $types = TypeAbsence::
                all();
        }
        else{
            $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->get();
            $types = TypeAbsence::
                all();
            
        }
        
        
        return view('admin.attendance.absence',compact('absences','types'));
    }

    // public function  absence(Request $request){

      


    //     $attendances = User::whereNotExists(function($query)
    //         {
    //             $query->select(DB::raw(1))
    //                   ->from('Attendances')
    //                   ->where('date','=',Carbon::now()->format('Y-m-d'))
    //                   ->whereRaw('Users.matricule = Attendances.matricule');
    //         })
    //         ->get();


    //         return view('admin.attendance.index',compact('attendances'));


    //     }
    
    public function  create(Request $request){

        $this->authorize('create',Absence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

        $absence = new Absence();
        $absence->user_id = Auth::user()->id;
        $absence->type_id = $request->type; 
        $absence->motif = $request->motif; 
        $absence->start = $request->start;
        $absence->finish = $request->finish;
        $absence->justification = $name;
        $absence->save();
        
    }
    
 
    
    public function display2(Request $request){

        $search_text = $request->id;
        $first = Absence::where('id','=',$search_text)        
        ->get();

        $second = TypeAbsence::
            all();

            $third = User::where('id','=',Auth::id())
            ->get();
        

        return response()->json([
            'filterusers' => $first,
            'types' => $second,
            'users' => $third,


        ]);
    }

    
    public function update(Request $request)
    {

         $this->validate($request,[
        ]);

        $id = $request->id;
        $absence = Absence::find($id);

        if(Auth::User()->role == 0)
        {
        $absence->etat = $request->etat;
        $absence->modifie='1';
        }
        else{
        
        if($request->modifie == 0){
            $absence->modifie='0';
            $absence->etat = '0';
        }else{
            $absence->modifie='0';
            $absence->etat='2';
                }
        
        }
       
        $absence->type_id = $request->type;
        $absence->motif = $request->motif;
        $absence->start = $request->start;
        $absence->finish = $request->finish;
        $absence->save();
        
    }


    
    public function search(Request $request)
    {
    //     $attendances = User::
    //     join('attendances', 'users.matricule', '=', 'attendances.matricule')
    //     ->whereNotExists(function($query) use ($request)
    //     {
    //         $query->select(DB::raw(1))
    //               ->from('Attendances')
    //               ->where('date','=',$request->date)
    //               ->whereRaw('Users.matricule = Attendances.matricule');
    //     })
    //     ->get();


    $types = TypeAbsence::
    all();



    if(Auth::User()->role==0)
    {
        if(isset($request->date))
        {
            if(isset($request->etat))
            {
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
                ->whereDate('absences.created_at','=', $request->date)
                ->where('etat','=',$request->etat)
                ->get();
            }else{
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
                ->whereDate('absences.created_at','=', $request->date)
                ->get();
            }
           
        }else
        {
            if(isset($request->etat))
            {
            $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
            ->where('etat','=',$request->etat)
            ->get();
            }else
            {
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
            ->get();
            }
        }
    }




    else
    {
        if(isset($request->date))
        {
            if(isset($request->etat))
            {
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('absences.created_at','=', $request->date)
                ->where('etat','=',$request->etat)
                ->get();
            }else{
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('absences.created_at','=', $request->date)
                ->get();
            }
           
        }else
        {
            if(isset($request->etat))
            {
            $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->where('etat','=',$request->etat)
            ->get();
            }else
            {
                $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
                ->where('user_id','=',Auth::User()->id)
            ->get();
            }
        }
    }
        return view('admin.attendance.absence',compact('absences','types'));
    }

}
