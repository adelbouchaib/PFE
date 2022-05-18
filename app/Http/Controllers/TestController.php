<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\helper;

use Rap2hpoutre\FastExcel\FastExcel;

use Carbon\Carbon;
use App\Models\Presence;
use App\Models\Absence;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Auth;

class TestController extends Controller
{
 
public function calculate(Request $request)
{

<<<<<<< HEAD
    $this->validate($request,[
        'start_date'  => 'required|date',
        'end_date'    => 'required|date|after:start_date',
    ]);

=======
  
    $users = User::all();
    $list = collect([
    ]);

    foreach($users as $user)
    {
        $counter = User::join('presences', 'users.matricule', '=', 'presences.matricule')
        ->where('users.matricule','=',$user->matricule)
        ->where('date','>',"2022-05-01")
        ->where('date','<',"2022-05-31")
                ->where('start_time','=',"00:00:00")
                ->orwhere('start_time','>',"09:00:00")
        ->count();


        $projets = User::join('projet_user', 'users.id', '=', 'projet_user.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->join('projets', 'projet_user.projet_id', '=', 'projets.id')
        ->where('type','=','1')
        ->get();

        $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('etat','=','1')
        ->get();

        $demandesabsences = User::join('absences', 'users.id', '=', 'absences.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('etat','=','1')
        ->get();


        $Date = Carbon::createFromFormat('Y-m-d', "2022-05-01");
        $todayDate = Carbon::createFromFormat('Y-m-d', "2022-05-31");


        $absencesjustifiees = User::join('absencesjustifiees', 'users.id', '=', 'absencesjustifiees.user_id')
        ->join('presences', 'users.matricule', '=', 'presences.matricule')
        ->where('users.matricule','=',$user->matricule)
        ->where('absencesjustifiees.etat','=','1')
        ->whereBetween('date', [$Date,$todayDate] )
        ->count();

       
        $counter2 = 0;
        $i = 0;
        foreach($projets as $projet)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->finish);

            if($start < "2022-05-01"){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-01");
            }
            if($finish > "2022-05-31"){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-31");
            }
            $j= $start->diffInDays($finish)+1;
            $counter2= $i + $j;
        }

        $counter3 = 0;
        $i = 0;
        foreach($conges as $conge)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$conge->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$conge->finish);

            if($start < "2022-05-01"){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-01");
            }
            if($finish > "2022-05-31"){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-31");
            }
            $j= $start->diffInDays($finish)+1;
            $counter3= $i + $j;
        }

        $counter4 = 0;
        $i = 0;
        foreach($demandesabsences as $demandesabsence)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$demandesabsence->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$demandesabsence->finish);

            if($start < "2022-05-01"){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-01");
            }
            if($finish > "2022-05-31"){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',"2022-05-31");
            }
            $j= $start->diffInDays($finish)+1;
            $counter4= $i + $j;
        }


        $absence = $counter - $counter2 -$counter3 -$counter4 - $absencesjustifiees;





        $list[]=['matricule'=> $user->matricule, 'absences'=> $absence];

    }

    return (new FastExcel($list))->download('file.xlsx');
}
>>>>>>> 88bddf8adac36768e0c832b7db6f4b84dbfb76f2
    
  
    $users = User::all();
    $list = collect([
    ]);


            
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    foreach($users as $user)
    {
        $absences = User::join('presences', 'users.matricule', '=', 'presences.matricule')
        ->where('users.matricule','=',$user->matricule)
        ->where('date','>',$startDate)
        ->where('date','<',$endDate)
        ->where(function ($query) {
            $query ->where('start_time','=',"00:00:00")
            ->orwhere('start_time','>',"09:00:00");
        })
        ->count();

        
        $absencesj = Presence::join('users', 'presences.matricule', '=', 'users.matricule')
        ->join('absencesjustifiees', 'presences.id', '=', 'absencesjustifiees.presence_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('absencesjustifiees.etat','=','1')
        ->whereBetween('date', [$startDate,$endDate] )
        ->count();


        
        $projets = User::join('projet_user', 'users.id', '=', 'projet_user.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->join('projets', 'projet_user.projet_id', '=', 'projets.id')
        ->where('type','=','1')
        ->get();

        $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('etat','=','1')
        ->get();

        $demandesabsences = User::join('demandeabsences', 'users.id', '=', 'demandeabsences.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('etat','=','1')
        ->get();




       
        $counter2 = 0;
        $i = 0;
        foreach($projets as $projet)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->finish);

            if($start < $startDate){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',$startDate);
            }
            if($finish > $endDate){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$endDate);
            }
            $j= $start->diffInDays($finish)+1;
            $counter2= $i + $j;
        }

        $counter3 = 0;
        $i = 0;
        foreach($conges as $conge)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$conge->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$conge->finish);

            if($start < $startDate){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',$startDate);
            }
            if($finish > $endDate){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$endDate);
            }
            $j= $start->diffInDays($finish)+1;
            $counter3= $i + $j;
        }

        $counter4 = 0;
        $i = 0;
        foreach($demandesabsences as $demandesabsence)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$demandesabsence->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$demandesabsence->finish);

            if($start < $startDate){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',$startDate);
            }
            if($finish > $endDate){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$endDate);
            }
            $j= $start->diffInDays($finish)+1;
            $counter4= $i + $j;
        }


        $absencesnonj = $absences - $absencesj - $counter2 -$counter3 -$counter4 ;



        $congesnon = User::join('conges', 'users.id', '=', 'conges.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->where('etat','=','1')
        ->where('type_id','=','1')
        ->get();

        $counter5 = 0;
        $i = 0;
        foreach($congesnon as $congenon)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$congenon->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$congenon->finish);

            if($start < $startDate){
                $start = \Carbon\Carbon::createFromFormat('Y-m-d',$startDate);
            }
            if($finish > $endDate){
                $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$endDate);
            }
            $j= $start->diffInDays($finish)+1;
            $counter5= $i + $j;
        }

        

        
        $projets = User::join('projet_user', 'users.id', '=', 'projet_user.user_id')
        ->where('users.matricule','=',$user->matricule)
        ->join('projets', 'projet_user.projet_id', '=', 'projets.id')
        ->get();

        
       
        $prime = 0;
        $i = 0;
        foreach($projets as $projet)
        {
            $start = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->start);
            $finish = \Carbon\Carbon::createFromFormat('Y-m-d',$projet->finish);

            if($start < $startDate){
                $start_update = \Carbon\Carbon::createFromFormat('Y-m-d',$startDate);
            }
            if($finish > $endDate){
                $finish_update = \Carbon\Carbon::createFromFormat('Y-m-d',$endDate);
            }

            $j= $start->diffInDays($finish)+1;
            $j_update= $start_update->diffInDays($finish_update)+1;

            $prime= $prime + ($projet->prime_chef/$j*$j_update) + ($projet->prime_equipe/$j*$j_update);
        }




        $list[]=['matricule'=> $user->matricule, 'absences non justifié'=> $absencesnonj, 'conge non rumunéré'=> $counter5,'prime'=> $prime];

    }

    return (new FastExcel($list))->download('file.xlsx');
}

}
