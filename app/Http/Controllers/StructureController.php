<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Direction;
use App\Models\Branche;

use Illuminate\Http\Request;

class StructureController extends Controller
{

      


    public function direction()
    {
        $allusers= User::all();
        $branches= Branche::all();
        $directions = Direction::
        join('branches', 'directions.branche_id', '=', 'branches.id')
        ->select('directions.*','branches.nom_branche')
        ->get();

        return view('admin.structure.direction',compact('allusers','directions','branches'));
    }

    public function branche()
    {
        $allusers= User::all();
        $branches = Branche::all();

        return view('admin.structure.branche',compact('allusers','branches'));
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
    
           $direction = new Direction();
           $direction->nom_direction = $request->nom_direction;
           $direction->branche_id = $request->branche_id;
           $direction->abrv = $request->abrv;
           $direction->save();
           return redirect(route('admin.structure.direction'));

    
        }
        public function save(Request $request){
    
            $branche = new Branche();
            $branche->nom_branche = $request->nom_branche;
            $branche->save();
            return redirect(route('admin.structure.branche'));
 
     
         }

         
    public function editd(Request $request)
    {
        $id = $request->id;
        $direction = Direction::find($id);

        return response()->json(['data' => $direction
      ]);
    }
    
  public function updated(Request $request)
  {

      //  $this->validate($request,[
      // ]);

      $id = $request->id_update;
      $direction = Direction::find($id);

      $direction->nom_direction = $request->nom_direction_update;
      $direction->abrv = $request->abrv_update;
      $direction->branche_id = $request->branche_id_update;
      $direction->save();

      return redirect()->back();



  }
     

  public function editb(Request $request)
  {
      $id = $request->id;
      $branche = Branche::find($id);

      return response()->json(['data' => $branche
    ]);
  }
  
public function updateb(Request $request)
{

    //  $this->validate($request,[
    // ]);

    $id = $request->id_update;
    $branche = Branche::find($id);
    $branche->nom_branche = $request->nom_branche_update;
    $branche->save();

    return redirect()->back();

}

  public function destroyd(Request $request)
  {

    $id = $request->id;

      $direction = Direction::find($id);
      $direction->delete();

      return redirect()->back();

    }
       
  public function destroyb(Request $request)
  {

    $id = $request->id;

    $directions = Direction::where('branche_id','=',$id)
    ->delete();

      $branche = Branche::find($id);
      $branche->delete();

      return redirect()->back();


    }
    
}
