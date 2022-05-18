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
    public function index()
{

  
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
    

}
