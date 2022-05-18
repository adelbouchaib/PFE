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


class AbsencesjustifieeController extends Controller
{
     
    public function  index(Request $request){

        
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

      // if(Auth::User()->role==0)
      // {
      //     $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
      //     ->get();

      // }
      // else{
      //     $absences = User::join('absences', 'users.id', '=', 'absences.user_id')
      //     ->where('user_id','=',Auth::User()->id)
      //     ->get();

          
      // }

        
          // ->whereNotExists(function($query) use ($request, $date)
          // {
          //     $query->select(DB::raw(1))
          //           ->from('Absencesjustifiees')
          //           ->whereRaw('Absencesjustifiees.presence_id = Presences.id');

          // })
        
          $date = Carbon::now()->format('Y-m-d');

      if(Auth::User()->role==1)
      {
          $presences = Presence::
          join('users', 'presences.matricule', '=', 'users.matricule')
          ->where('presences.matricule','=',Auth::User()->matricule)
          ->leftjoin('Absencesjustifiees', 'presences.id', '=', 'Absencesjustifiees.presence_id')

          ->select(
              'users.prenom',
              'users.nom',
              'users.matricule',
              'presences.*',
              'Absencesjustifiees.etat',
              'Absencesjustifiees.presence_id',
          )
          ->whereNotExists(function($query) use ($request, $date)
              {
                  $query->select(DB::raw(1))
                        ->from('Conges')
                        ->where('etat','1')
                      //   ->where('start','<=',$date)
                      //   ->where('finish','>=',$date)
                        ->whereRaw('Users.id = Conges.user_id');
              })

                
          ->where(function ($query) {
              $query->where('start_time','=',"00:00:00")
                    ->orWhere('start_time','>',"09:00:00");
          })
          ->get();

      }else{

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
          ->whereNotExists(function($query) use ($request, $date)
              {
                  $query->select(DB::raw(1))
                        ->from('Conges')
                        ->where('etat','1')
                      //   ->where('start','<=',$date)
                      //   ->where('finish','>=',$date)
                        ->whereRaw('Users.id = Conges.user_id');
              })

                
          ->where(function ($query) {
              $query->where('start_time','=',"00:00:00")
                    ->orWhere('start_time','>',"09:00:00");
          })
          ->get();
      }
          


              $today = Carbon::now();
              

            return view('admin.absence.historique',compact('presences','today'));


        }

        

        public function search(Request $request){
                    
          $date = Carbon::now()->format('Y-m-d');

          if(Auth::User()->role==1)
          {
              $presences = Presence::
              join('users', 'presences.matricule', '=', 'users.matricule')
              ->where('date','=',$request->date)
              ->where('presences.matricule','=',Auth::User()->matricule)
              ->leftjoin('Absencesjustifiees', 'presences.id', '=', 'Absencesjustifiees.presence_id')
    
              ->select(
                  'users.prenom',
                  'users.nom',
                  'users.matricule',
                  'presences.*',
                  'Absencesjustifiees.etat',
                  'Absencesjustifiees.presence_id',
              )
              ->whereNotExists(function($query) use ($request)
                  {
                      $query->select(DB::raw(1))
                            ->from('Conges')
                            ->where('etat','1')
                            ->where('start','<=',$request->date)
                            ->where('finish','>=',$request->date)
                            ->whereRaw('Users.id = Conges.user_id');
                  })
    
                    
              ->where(function ($query) {
                  $query->where('start_time','=',"00:00:00")
                        ->orWhere('start_time','>',"09:00:00");
              })
              ->get();
    
          }else{
    
              $presences = Presence::
              join('users', 'presences.matricule', '=', 'users.matricule')
              ->where('presences.date','=',$request->date)
              ->leftjoin('Absencesjustifiees', 'presences.id', '=', 'Absencesjustifiees.presence_id')
    
              ->select(
                  'users.prenom',
                  'users.nom',
                  'users.matricule',
                  'presences.*',
                  'Absencesjustifiees.etat',
                  'Absencesjustifiees.presence_id',
              )
              ->whereNotExists(function($query) use ($request)
                  {
                      $query->select(DB::raw(1))
                            ->from('Conges')
                            ->where('etat','1')
                            ->where('start','<=',$request->date)
                            ->where('finish','>=',$request->date)
                            ->whereRaw('Users.id = Conges.user_id');
                  })
    
                    
              ->where(function ($query) {
                  $query->where('start_time','=',"00:00:00")
                        ->orWhere('start_time','>',"09:00:00");
              })
              ->get();
          }
              
    
    
                  $today = Carbon::now();
                  
    
                return view('admin.absence.historique',compact('presences','today'));
    
    
            }
        
     
    public function  create(Request $request){

        // $this->authorize('create',Absence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       
       $absence = new Absencesjustifiee();
       $absence->user_id = Auth::user()->id;
       $absence->presence_id = $request->presence_id;
       $absence->motif = $request->motif; 
       $absence->justification = $name;
        $absence->save();
    
        
    }
    
    
    public function edit(Request $request){

        $search_text = $request->presence_id_update;
        $absence = Absencesjustifiee::where('presence_id','=',$search_text)
        ->first();

        $user = Auth::User()->role;

        return response()->json(['data' => $absence,
        'user' => $user]
    
    );



    }



    
    public function update(Request $request)
    {

         $this->validate($request,[
        ]);

   
     

        $presence_id = $request->presence_id_update;
        $absence = Absencesjustifiee::where('presence_id','=',$presence_id)->first();

        $absence->motif = $request->motif_update;

        if(isset($request->etat_update)){

        $absence->etat = $request->etat_update;
        }
           
        if(isset($request->image_update)){
            $name = $request->file('image_update')->getClientOriginalName();
            $request->file('image_update')->storeAs('public/images',$name);
            $absence->justification = $name;
        }

        $absence->save();
        
    }


}
