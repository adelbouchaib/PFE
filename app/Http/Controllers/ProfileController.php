<?php
namespace App\Http\Controllers;
use Carbon\Carbon;


use App\Models\User;
use App\Models\Direction;
use App\Models\Branche;

use App\Helpers\helper;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $directions = Direction::all();
        $branches = Branche::all();
       
        return view('index',compact('branches','directions'));
    }
    public function update(Request $request)
    {

        $this->validate($request,[
     ]);

            $id = $request->id_update;
            $user = User::find(Auth::user()->id);
            $matricule = Helper::matricule($request->direction_id_update);


                $user->email= $request->email_update;
                $user->nom= $request->nom_update;
                $user->prenom= $request->prenom_update;
                $user->lieu_naiss= $request->lieu_naiss_update;
                $user->date_naiss= $request->date_naiss_update;
                $user->matricule= $matricule;
                $user->adresse= $request->adresse_update;  
                $user->num_telephone= $request->num_telephone_update;
                if(isset($request->mot_de_passe_update))
                {
                    $user->mot_de_passe= $request->mot_de_passe_update;
                }

                $user->direction_id= $request->direction_id_update;
                $user->base= $request->base_update;
                $user->position= $request->position_update;
                $user->fonction= $request->fonction_update;
                $user->experience_pro= $request->experience_pro_update;
                $user->echelle= $request->echelle_update;
                $user->echelon= $request->echelon_update;




                $user->situation_conjoint= $request->situation_conjoint_update;
                $user->situation_familiale= $request->situation_familiale_update;
                $user->nbr_enfant= $request->nbr_enfant_update;

                $user->num_compte= $request->num_compte_update;
                $user->num_securite_social= $request->num_securite_social_update;

                $user->type_contrat= $request->type_contrat_update;
                $user->date_recrutement= $request->date_recrutement_update;
                $user->debut_contrat= $request->debut_contrat_update;
                $user->fin_contrat= $request->fin_contrat_update;



                $user->save();

                return redirect()->back()->with('success', 'Profil modifié avec succès!');   

        
    }

    
    public function edit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
       
        $direction = Direction::where('id','=',$user->direction_id)->first();
        $branche = Branche::where('id','=',$direction->branche_id)->first();


        return response()->json(['data' => $user,
        'branche' => $branche,

      ]);
    }

}
