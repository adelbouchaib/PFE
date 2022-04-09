<?php

namespace App\Http\Controllers;
use App\Models\Paiement;
use App\Models\Attendance;
use App\Models\User;
 use Carbon\Carbon;
 use Response;
 use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Auth;

class PaiementController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index(){

        $paiements = Paiement::all();
        $allusers = User::all();


        if (empty($_GET)) {
        $allusers =User::all();
        $filterusers = User::all();
        $filterusers2 = User::where('id','LIKE','*');
        }
        return view('admin.paiement.index',compact('filterusers','filterusers2','allusers','paiements'));

    }

    public function historique(){

        $allusers =User::all();
        $filterusers = User::where('id','LIKE','*');
        // $paiements = Paiement::where('user_id','LIKE','*');
        return view('admin.paiement.historique',compact('allusers','filterusers'));

    }


    // public function search(){

    //     $paiements = Paiement::all();
    //     $search_text = $_GET['query'];
    //     $search_text2 = $_GET['data'];
    //     $allusers =User::all();

    //     $filterusers = User::where('first_name','LIKE',$search_text)
    //     ->orwhere('first_name','LIKE',$search_text2)
    //     ->get();
    //     // $users = User::where('first_name','LIKE','%'.$search_text.'%')->get();
    //     return view('admin.paiement.index',compact('filterusers','allusers','paiements'));

    // }
    
    public function search(Request $request){

        
        $search_text = $request->id;
        $search_text2 = $request->date_debut;
        $search_text3 = $request->date_fin;
        $allusers =User::all();
        $paiements = Attendance::where('user_id','LIKE', $search_text)->whereBetween('date', [$search_text2, $search_text3])->count();

        $filterusers2 = User::where('id','LIKE',$search_text)
        ->get();
        // $users = User::where('first_name','LIKE','%'.$search_text.'%')->get();

        return response()->json([
            'allusers' => $allusers,
            'paiements' => $paiements,
            'filterusers2' => $filterusers2,
        ]);
    }

        
    public function search2(Request $request){

        
        $search_text = $request->data;
        $search_text2 = $request->date;
        $allusers =User::all();
        $paiements = Paiement::where('id','LIKE','*');
        // $filterusers = User::where('first_name','LIKE','%'.$search_text.'%')
        // ->orwhere('last_name','LIKE','%'.$search_text.'%')
        // ->orwhereRaw("concat(first_name, ' ', last_name) like '%" .$search_text. "%' ")
        //                ->get();

       
        $first = User::join('paiements', 'users.id', '=', 'paiements.user_id')
            ->whereRaw("concat(first_name, ' ', last_name) like '%" .$search_text. "%' ");

            $filterusers = User::join('paiements', 'users.id', '=', 'paiements.user_id')
            ->where('date','=',$search_text2)
            ->union($first)
            ->get();


        
        return view('admin.paiement.historique',compact('filterusers','allusers','paiements'));
    }

    // public function display(Request $request){

        
    //     $search_text = $request->id;
    //     $allusers =User::all();
    //     $filterusers = User::where('id','=',$search_text)->get();

    //         $paiements = Paiement::where('id','=',$search_text)
    //            ->get();

    //     return view('admin.paiement.historique',compact('paiements','allusers','filterusers'));
    // }

    public function display2(Request $request){

        $search_text = $request->id;
        $first = Paiement::where('id','=',$search_text)
        ->get();
        

        return response()->json([
            'filterusers' => $first,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @param  int  $date_debut
     * @param  int  $date_fin
     * @param  int  $newDate
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){


    //     $id = $request->get('user-id'); 

    //     $date_debut = $request->get('date_debut'); 
    //     $date_fin = $request->get('date_fin'); 
        
    //    $name = $request->file('image')->getClientOriginalName();

       //$request->file('image')->storeAs('public/images',$name);


       $this->validate($request,[
        'image'=>'required',
        'date_debut'=>'required',
        'date_fin'=>'required',
        ]);



       $name = $request->file('image')->getClientOriginalName();
       $request->file('image')->storeAs('public/images',$name);

       $mytime = Carbon::now();

       
       $paiement = new Paiement();
       $paiement->user_id = $request->id;
       $paiement->image = $name;
       $paiement->date = $mytime;
        $paiement->date_debut = $request->date_debut;
        $paiement->date_fin = $request->date_fin;
      


       $paiement->save();

    }

}
