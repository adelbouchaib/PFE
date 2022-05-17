<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Presence;
use App\Models\DemandeAbsence;
use App\Models\Absencesjustifiee;
use App\Models\Conge;
use App\Models\User;
use App\Models\TypeAbsence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class DemandeAbsenceController extends Controller
{
    

    public function index()
    {
        if(Auth::User()->role==0)
        {
            $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
            ->get();

        }
        else{
            $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->get();

            
        }
        $types = TypeAbsence::
        all();
        
        $users = User::all();

        return view('admin.absence.index',compact('absences','types','users'));
    }

   
    
    public function  create(Request $request){

        $this->authorize('create',DemandeAbsence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       $absence = new DemandeAbsence();
       $absence->user_id = Auth::user()->id;
       $absence->motif = $request->motif; 
       $absence->justification = $name;
        $absence->start = $request->start;
        $absence->finish = $request->finish;
        $absence->type_id = $request->type;

        $absence->save();
        
    }
    

 
    
    
    public function display(Request $request){

        $search_text = $request->id;
        $first = DemandeAbsence::where('id','=',$search_text)        
        ->first();

        $second = TypeAbsence::
            all();

            $third = User::where('id','=',Auth::id())->first()->role;
        

        return response()->json([
            'demandeabsence' => $first,
            'types' => $second,
            'users' => $third,


        ]);
    }

    


    
    public function update(Request $request)
    {

        //  $this->validate($request,[
        // ]);

        $id = $request->id;
        $absence = DemandeAbsence::find($id);

        if(isset($request->etat_update)){
            $absence->etat=$request->etat_update;

        }else{

            
            if(isset($request->type_update)){

                $absence->etat='3';
                $absence->type_id = $request->type_update;
                $absence->motif = $request->motif_update;
                $absence->start = $request->start_update;
                $absence->finish = $request->finish_update;
        
                if(isset($request->justification_update)){
                $name = $request->file('justification_update')->getClientOriginalName();
                $request->file('justification_update')->storeAs('public/images',$name);
                $absence->justification = $name;
                }


            }else{
                $absence->etat='0';

            }

        }
       
       
        
        $absence->save();
        
    }

    



    
    public function search(Request $request)
    {
    //     $presences = User::
    //     join('presences', 'users.matricule', '=', 'presences.matricule')
    //     ->whereNotExists(function($query) use ($request)
    //     {
    //         $query->select(DB::raw(1))
    //               ->from('presences')
    //               ->where('date','=',$request->date)
    //               ->whereRaw('Users.matricule = presences.matricule');
    //     })
    //     ->get();


    $types = TypeAbsence::
    all();

    $users = User::all();



    if(Auth::User()->role==0)
    {
       
                $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
                ->whereDate('DemandeAbsences.created_at','=', $request->date)
                ->orWhere('etat','=',$request->etat)
                ->orWhere('users.id','=',$request->user)
                ->get();
           
     
    }
    else
    {
        $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('DemandeAbsences.created_at','=', $request->date)
                ->orWhere('etat','=',$request->etat)
                ->get();



    }

        return view('admin.absence.index',compact('absences','types','users'));
    }

}
