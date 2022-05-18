<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Presence;
use App\Models\Conge;
use App\Models\User;
use App\Models\TypeConge;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CongeController extends Controller
{

    public function index()
    {
       
       

        if(Auth::User()->role==0)
        {
            $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
            ->get();
            $types = TypeConge::
                all();
        }
        else{
            $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->get();
            $types = TypeConge::
                all();
            
        }
        
        
        return view('admin.conge.index',compact('conges','types'));
    }

    
    public function  create(Request $request){

        $this->authorize('create',Absence::class);

        
        $name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/images',$name);
 
         $conge = new Conge();
         $conge->user_id = Auth::user()->id;
         $conge->type_id = $request->type; 
         $conge->motif = $request->motif; 
         $conge->start = $request->start;
         $conge->finish = $request->finish;
         $conge->justification = $name;
         $conge->save();
        
    }
    

       
    public function display2(Request $request){

        $search_text = $request->id;
        $first = Conge::where('id','=',$search_text)        
        ->get();

        $second = TypeConge::
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
        $conge = Conge::find($id);

        if(Auth::User()->role == 0)
        {
        $conge->etat = $request->etat;
        $conge->modifie='1';
        }
        else{
        
        if($request->modifie == 0){
            $conge->modifie='0';
            $conge->etat = '0';
        }else{
            $conge->modifie='0';
            $conge->etat='2';
                }
        
        }
       
        $conge->type_id = $request->type;
        $conge->motif = $request->motif;
        $conge->start = $request->start;
        $conge->finish = $request->finish;
        $conge->save();
        
    }


        
    public function search(Request $request)
    {
    //     $presences = User::
    //     join('presences', 'users.matricule', '=', 'presences.matricule')
    //     ->whereNotExists(function($query) use ($request)
    //     {
    //         $query->select(DB::raw(1))
    //               ->from('Presences')
    //               ->where('date','=',$request->date)
    //               ->whereRaw('Users.matricule = Presences.matricule');
    //     })
    //     ->get();


    $types = TypeConge::
    all();



    if(Auth::User()->role==0)
    {
        if(isset($request->date))
        {
            if(isset($request->etat))
            {
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
                ->whereDate('conges.created_at','=', $request->date)
                ->where('etat','=',$request->etat)
                ->get();
            }else{
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
                ->whereDate('conges.created_at','=', $request->date)
                ->get();
            }
           
        }else
        {
            if(isset($request->etat))
            {
            $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
            ->where('etat','=',$request->etat)
            ->get();
            }else
            {
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
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
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('conges.created_at','=', $request->date)
                ->where('etat','=',$request->etat)
                ->get();
            }else{
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('conges.created_at','=', $request->date)
                ->get();
            }
           
        }else
        {
            if(isset($request->etat))
            {
            $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->where('etat','=',$request->etat)
            ->get();
            }else
            {
                $conges = User::join('conges', 'users.id', '=', 'conges.user_id')
                ->where('user_id','=',Auth::User()->id)
            ->get();
            }
        }
    }
        return view('admin.conge.index',compact('conges','types'));
    }


}
