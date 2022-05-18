<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Presence;
use App\Models\Absencesjustifiee;
use App\Models\Conge;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class AbsencesjustifieeController extends Controller
{
     
    public function  index(Request $request){
        
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
                 
          ->where(function ($query) {
            $query->where('start_time','=',"00:00:00")
                  ->orWhere('start_time','>',"09:00:00");
        })

        ->orwhere(function ($query) {
          $query->where('end_time','=',"00:00:00")
                ->orWhere('end_time','<',"15:00:00");
        })

          ->whereNotExists(function($query) use ($request, $date)
              {
                  $query->select(DB::raw(1))
                        ->from('Conges')
                        ->where('etat','1')
                      //   ->where('start','<=',$date)
                      //   ->where('finish','>=',$date)
                        ->whereRaw('Users.id = Conges.user_id');
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
                          
        ->where(function ($query) {
            $query->where('start_time','=',"00:00:00")
                  ->orWhere('start_time','>',"09:00:00");
        })

        ->orwhere(function ($query) {
          $query->where('end_time','=',"00:00:00")
                ->orWhere('end_time','<',"15:00:00");
         })

          ->whereNotExists(function($query) use ($request, $date)
              {
                  $query->select(DB::raw(1))
                        ->from('Conges')
                        ->where('etat','1')
                      //   ->where('start','<=',$date)
                      //   ->where('finish','>=',$date)
                        ->whereRaw('Users.id = Conges.user_id');
              })

          ->get();
      }
                        

            return view('admin.absence.historique',compact('presences'));


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

        $this->authorize('create',Absence::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       
       $absence = new Absencesjustifiee();
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

    
    public function edit2(Request $request){

        $search_text = $request->absence_id;
        $absence = Presence::where('id','=',$search_text)
        ->first();

        return response()->json(['data' => $absence]);



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


    
    
    public function update2(Request $request)
    {


        $absence_id = $request->absence_id;
        $absence = Presence::where('id','=',$absence_id)->first();

        $absence->start_time = "$request->start_time_update";
        $absence->end_time = $request->end_time_update;
        $absence->save();
        
    }




}
