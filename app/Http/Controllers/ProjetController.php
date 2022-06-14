<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Task;
use App\Models\Projet;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use Auth;
class ProjetController extends Controller
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
       $allusers = User::all();

       if(Auth::user()->role == 0)
       {
        $projetstodo = Projet::
        join('users', 'projets.user_id', '=', 'users.id')
        ->where('status','=','0')
        ->select('projets.*','users.prenom','users.nom')
        ->where(function ($query) {
         $query ->where('user_id','=',Auth::user()->id)
         ->orwhere('users.role','=','0');
        })
        ->get();
       }
       
       else{
        $projetstodo = Projet::join('projet_user', 'projets.id', '=', 'projet_user.projet_id')
        ->join('users', 'projets.user_id', '=', 'users.id')
        ->where('status','=','0')
        ->select('users.prenom','users.nom','projets.*','projet_user.user_id as user_id2')
        ->get();
       }

       if(Auth::user()->role == 0)
       {
        $projetsinprogress = Projet::
        join('users', 'projets.user_id', '=', 'users.id')
        ->where('status','=','1')
        ->select('projets.*','users.prenom','users.nom')
        ->where(function ($query) {
         $query ->where('user_id','=',Auth::user()->id)
         ->orwhere('users.role','=','0');
        })
        ->get();
       }
       
       else{
        $projetsinprogress = Projet::join('projet_user', 'projets.id', '=', 'projet_user.projet_id')
        ->join('users', 'projets.user_id', '=', 'users.id')
        ->where('projet_user.user_id','=',Auth::User()->id)
        ->where('status','=','1')
        ->select('users.prenom','users.nom','projets.*','projet_user.user_id as user_id2')
        ->get();
       }
       
       
       if(Auth::user()->role == 0)
       {
        $projetsdone = Projet::
        join('users', 'projets.user_id', '=', 'users.id')
        ->where('status','=','2')
        ->select('projets.*','users.prenom','users.nom')
        ->where(function ($query) {
         $query ->where('user_id','=',Auth::user()->id)
         ->orwhere('users.role','=','');
        })
        ->get();
       }
       
       else{
        $projetsdone = Projet::join('projet_user', 'projets.id', '=', 'projet_user.projet_id')
        ->join('users', 'projets.user_id', '=', 'users.id')
        ->where('projet_user.user_id','=',Auth::User()->id)
        ->select('users.prenom','users.nom','projets.*','projet_user.user_id as user_id2')
        ->where('status','=','2')
        ->get();
       }
      

      

       $todayDate = Carbon::now()->format('Y-m-d'); 
       $Date = Carbon::createFromFormat('Y-m-d', $todayDate);
       $Date->subDays(7);




       $tasks = Task::all();

       $tasksselected = Task::
       where('status','=','1')
       ->get();

        return view('admin.projet.index',compact('allusers','projetstodo','projetsinprogress','projetsdone','tasks','tasksselected'));
    }

    public function historique()
    {

       $projets = User::join('projets', 'users.id', '=', 'projets.user_id')
       ->where('status','=','2')
       ->get();

        return view('admin.projet.historique',compact('projets'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $projet = Projet::find($id);


        // $equipe = User::
        // join('projet_user', 'users.id', '=', 'projet_user.user_id')
        // ->where('projet_id','=',$projet->id)
        // ->select('users.*')
        // ->get();

        $allusers = User::all();

        return response()->json(['data' => $projet,
        'allusers' => $allusers
      ]);
    }

    
    public function  create(Request $request){


      $projet = new Projet();   
      $projet->user_id = $request->chef; 
      $projet->title = $request->title;
      $projet->type = $request->type;
      $projet->description = $request->description;
      $projet->start = $request->start;
      $projet->finish = $request->finish;
      $projet->prime_chef = $request->prime_chef;
      $projet->status = 0;
      $projet->nbtasks = 0;
      $projet->save();

      $datas = $request->data;

        $i=1;
        foreach($datas as $data2)
        {
          foreach($data2 as $data)
          {
            $user = User::where('id','=',$data)->get();
            $projet->users()->attach($user, ['prime' => $request->prime[$i]]);
          }
          
            $i++;
        }
        

      
  }

  
  public function  task(Request $request){


    $task = Task::findOrFail($request->id); 
    if(isset($request->status))
    {
      $done = '1';
      $task->status = $done; 
      $task->save();
      $projet = Projet::findOrFail($request->projet_id); 
      $tasks = Task::where('projet_id','=',$projet->id)
      ->where('status','=','1')
      ->count();

      if($tasks == $projet->nbtasks)
      {
        $projet->status = '2';
        $projet->save();
      }
      else{
        $task->status = $done; 
        $task->save();

      $projet->status = '1';
      $projet->save();
      }


    }
    else{
      $done = '0';
      $task->status = $done;
      $task->save();

      $projet = Projet::findOrFail($request->projet_id); 
      $tasks = Task::where('projet_id','=',$projet->id)
      ->where('status','=','1')
      ->count();
      
      if($tasks == 0)
      {
        $projet->status = '0';
        $projet->save();
      }
      else{

      $projet->status = '1';
      $projet->save();
      }

     
    }

    return redirect(route('admin.projet.index'));

    // dd($request->status);

  }

  
  public function update(Request $request)
  {

      //  $this->validate($request,[
      // ]);

      $id = $request->id_update;
      $projet = Projet::find($id);

              $projet->start = $request->start_update;
              $projet->finish = $request->finish_update;
              $projet->title = $request->title_update;
              $projet->description = $request->description_update;
              $projet->prime_chef = $request->prime_chef_update;

           if(isset($request->chef_update)){
             $projet->user_id = $request->chef_update;
           }  
      
      $projet->save();

      $datas = $request->data;

      if(isset($datas)){
        $projet = Projet::find($id);
        $projet->users()->detach();
        $i=1;
        foreach($datas as $data2)
        {
          foreach($data2 as $data)
          {
            $user = User::where('id','=',$data)->get();
            $projet->users()->attach($user, ['prime' => $request->prime[$i]]);
          }
          
            $i++;
        }
      }

      
  }

  
  public function destroy(Request $request)
  {

    $id = $request->id;


    $userprojets = DB::table('projet_user')
    ->where('projet_id','=',$id)
    ->delete();

    
    $tasks = DB::table('tasks')
    ->where('projet_id','=',$id)
    ->delete();

      $projet = Projet::find($id);
      $projet->delete();


      
      return redirect(route('admin.projet.index'));
  }  
       
}