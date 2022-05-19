<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Models\Presence;
use App\Models\Sanction;
use App\Models\User;
use App\Models\TypeSanction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
class SanctionController extends Controller
{
    

    public function index()
    {
        if(Auth::User()->role==0)
        {
            $sanctions = User::join('sanctions', 'users.id', '=', 'sanctions.user_id')
            ->get();

        }
        else{
            $sanctions = User::join('sanctions', 'users.id', '=', 'sanctions.user_id')
            ->where('user_id','=',Auth::User()->id)
            ->get();

            
        }
        $types = TypeSanction::
        all();
        
        $users = User::all();

        return view('admin.sanctions.index',compact('sanctions','types','users'));
    }

   
    
    public function  create(Request $request){

        // $this->authorize('create',Sanction::class);

        
       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       $sanction = new Sanction();
       $sanction->user_id = Auth::user()->id;
       $sanction->motif = $request->motif; 
       $sanction->justification = $name;
        $sanction->start = $request->start;
        $sanction->finish = $request->finish;
        $sanction->type_id = $request->type;

        $sanction->save();
        
    }
    

 
    
    
    public function display(Request $request){

        $search_text = $request->id;
        $first = Sanction::where('id','=',$search_text)        
        ->first();

        $second = TypeSanction::
            all();

            $third = User::where('id','=',Auth::id())->first()->role;
        

        return response()->json([
            'sanction' => $first,
            'types' => $second,
            'users' => $third,


        ]);
    }

    


    
    public function update(Request $request)
    {

        //  $this->validate($request,[
        // ]);

        $id = $request->id;
        $sanction = Sanction::find($id);

                $sanction->type_id = $request->type_update;
                $sanction->motif = $request->motif_update;
                $sanction->start = $request->start_update;
                $sanction->finish = $request->finish_update;
        
        $sanction->save();
        
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


    $types = TypeSanction::
    all();

    $users = User::all();



    if(Auth::User()->role==0)
    {
       
                $sanctions = User::join('sanctions', 'users.id', '=', 'sanctions.user_id')
                ->whereDate('sanctions.created_at','=', $request->date)
                ->orWhere('users.id','=',$request->user)
                ->get();
           
     
    }
    else
    {
        $sanctions = User::join('sanctions', 'users.id', '=', 'sanctions.user_id')
                ->where('user_id','=',Auth::User()->id)
                ->whereDate('sanctions.created_at','=', $request->date)
                ->get();



    }

        return view('admin.sanctions.index',compact('sanctions','types','users'));
    }

}
