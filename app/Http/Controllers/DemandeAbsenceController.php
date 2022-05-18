<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Presence;
<<<<<<< HEAD
use App\Models\Demandeabsence;
=======
use App\Models\DemandeAbsence;
use App\Models\Absencesjustifiee;
use App\Models\Conge;
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
use App\Models\User;
use App\Models\TypeAbsence;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
<<<<<<< HEAD
class DemandeabsenceController extends Controller
=======
class DemandeAbsenceController extends Controller
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
{
    

    public function index()
    {
        if(Auth::User()->role==0)
        {
<<<<<<< HEAD
            $absences = User::join('demandeabsences', 'users.id', '=', 'demandeabsences.user_id')
=======
            $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
            ->get();

        }
        else{
<<<<<<< HEAD
            $absences = User::join('demandeabsences', 'users.id', '=', 'demandeabsences.user_id')
=======
            $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
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

<<<<<<< HEAD
       $absence = new Demandeabsence();
=======
       $absence = new DemandeAbsence();
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
       $absence->user_id = Auth::user()->id;
       $absence->motif = $request->motif; 
       $absence->justification = $name;
        $absence->start = $request->start;
        $absence->finish = $request->finish;
        $absence->type_id = $request->type_id;

        $absence->save();
        
    }
    

 
    
    
    public function display(Request $request){

        $search_text = $request->id;
<<<<<<< HEAD
        $first = Demandeabsence::where('id','=',$search_text)        
=======
        $first = DemandeAbsence::where('id','=',$search_text)        
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
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
<<<<<<< HEAD
        $absence = Demandeabsence::find($id);
=======
        $absence = DemandeAbsence::find($id);
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2

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
       
<<<<<<< HEAD
                $absences = User::join('Demandeabsences', 'users.id', '=', 'Demandeabsences.user_id')
                ->whereDate('Demandeabsences.created_at','=', $request->date)
=======
                $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
                ->whereDate('DemandeAbsences.created_at','=', $request->date)
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
                ->orWhere('etat','=',$request->etat)
                ->orWhere('users.id','=',$request->user)
                ->get();
           
     
    }
    else
    {
<<<<<<< HEAD
        $absences = User::join('Demandeabsences', 'users.id', '=', 'Demandeabsences.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('Demandeabsences.created_at','=', $request->date)
=======
        $absences = User::join('DemandeAbsences', 'users.id', '=', 'DemandeAbsences.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('DemandeAbsences.created_at','=', $request->date)
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
                ->orWhere('etat','=',$request->etat)
                ->get();



    }

        return view('admin.absence.index',compact('absences','types','users'));
    }

}
