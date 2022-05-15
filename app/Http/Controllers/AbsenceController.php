<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Presence;
use App\Models\Absence;
use App\Models\Absencesjustifiee;
use App\Models\Conge;
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
        
        
        return view('admin.absence.index',compact('absences','types'));
    }

    
    public function  historique(Request $request){

        $date = Carbon::now()->format('Y-m-d');
        
          // $presences = User::
          // whereNotExists(function($query)
          //     {
          //         $query->select(DB::raw(1))
          //                   ->from('Presences')
          //                   ->where('date','=',Carbon::now()->format('Y-m-d'))
          //                   ->where('start_time','!=',"00:00:00")
          //                   ->whereRaw('Users.matricule = Presences.matricule');
  
                          
          //     })
  
        //   $conges = Conge::where('etat','=','1')
        //   ->where('start','=',$date)
        //   ->first();



            $presences = Presence::
            join('users', 'presences.matricule', '=', 'users.matricule')
            ->leftjoin('Absencesjustifiees', 'presences.id', '=', 'Absencesjustifiees.presence_id')

            ->select(
                'users.prenom',
                'users.nom',
                'users.matricule',
                'presences.*',
                'Absencesjustifiees.etat',
                'Absencesjustifiees.presence_id',
            )

           
            // ->whereNotExists(function($query) use ($request, $date)
            // {
            //     $query->select(DB::raw(1))
            //           ->from('Absencesjustifiees')
            //           ->whereRaw('Absencesjustifiees.presence_id = Presences.id');

            // })
          
            
            ->whereNotExists(function($query) use ($request, $date)
                {
                    $query->select(DB::raw(1))
                          ->from('Conges')
                          ->where('start','<=',$date)
                          ->where('finish','>=',$date)
                          ->whereRaw('Users.id = Conges.user_id');
                })

                  
            ->where(function ($query) {
                $query->where('start_time','=',"00:00:00")
                      ->orWhere('start_time','>',"09:00:00");
            })
              
           
            

                      


          
    
            
                ->get();
          
         
                $today = Carbon::now();

                // $time = $today->addDays(2);

                

              return view('admin.absence.historique',compact('presences','today'));
  
  
          }

    
    public function  create(Request $request){

        $this->authorize('create',Absence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       $absence = new Absence();
       $absence->user_id = Auth::user()->id;
       $absence->motif = $request->motif; 
       $absence->justification = $name;


       if(isset($request->type))
       {
        $absence->start = $request->start;
        $absence->finish = $request->finish;
        $absence->type_id = $request->type; 

       }else{
        $absence->start = $request->date;
        $absence->finish = $request->date;
        $absence->type_id = '0'; 

       }

        $absence->save();
        
    }
    

     
    public function  create2(Request $request){

        $this->authorize('create',Absence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       
       $absence = new Absencesjustifiee();
       $absence->user_id = Auth::user()->id;
       $absence->presence_id = $request->presence_id;
       $absence->motif = $request->motif; 
       $absence->justification = $name;
      $absence->date =$request->date;

      $absence->save();
    
        
    }
    
 
    
    public function edit(Request $request){

        $search_text = $request->presence_id;
        $absence = Absencesjustifiee::where('presence_id','=',$search_text)        
        ->first();

        return response()->json(['data' => $absence]);



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

    
    public function display(Request $request){

        $search_text = $request->id;
        $first = Absence::where('id','=',$search_text)        
        ->get();

        

        return response()->json([
            'filterusers' => $first,
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
            if($request->etat == $absence->etat)
            {
                $absence->etat = $request->etat;
                $absence->modifie='1';
            }else{
                $absence->etat = $request->etat;
                $absence->modifie='0';
            }
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
        return view('admin.absence.index',compact('absences','types'));
    }

}
