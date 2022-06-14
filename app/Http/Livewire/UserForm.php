<?php

namespace App\Http\Livewire;

use App\Helpers\helper;

use App\Models\User;
use App\Models\Direction;
use App\Models\Branche;
use Livewire\Component;

class UserForm extends Component
{

    public $userid, $userid2, $data;

    public $prenom_update, $nom_update, $password_update,  $email_update, $debut_contrat_update, $sexe_update, $lieu_naiss_update, $date_naiss_update, $adresse_update, $num_telephone_update, $situation_familiale_update;

    public $situation_conjoint_update, $nbr_enfant_update,  $type_contrat_update, $date_recrutement_update, $fin_contrat_update, $fonction_update;

    public $echelle_update, $position_update, $base_update, $experience_pro_update, $echelon_update, $num_securite_social_update, $num_compte_update, $branche_update, $direction_id_update, $role_update;

    
    public $currentPage_update = 1;
    public $success_update;

    

    public $prenom, $nom,  $email, $password, $debut_contrat, $sexe, $lieu_naiss,$date_naiss,$adresse,$num_telephone,$situation_familiale;

    public $situation_conjoint, $nbr_enfant,  $type_contrat, $date_recrutement, $fin_contrat, $fonction;

    public $echelle,  $echelon, $num_securite_social, $num_compte, $branche, $position, $base, $experience_pro, $direction_id, $role;


    public $currentPage = 1;
    public $success;

    
    public $pages = [
        1 => [
            'heading' => 'Informations personnelles',
        ],
        2 => [
            'heading' => 'Carrière',
        ],
        3 => [
            'heading' => 'Contrat',
        ],
        4 => [
            'heading' => 'Situation familiale',
        ],
    ];

    private $validationRules2 = [
        1 => [
            'password_update' => ['string', 'min:8'],
        ],
        ];

    private $validationRules = [
        1 => [
            'prenom_update' => ['required'],
            'nom_update' => ['required'],
            'email_update' => ['required', 'email'],
            'sexe_update' => ['required'],
            'date_naiss_update' => ['required'],
            'lieu_naiss_update' => ['required'],
            'adresse_update' => ['required'],
            'num_telephone_update' => ['required'],
        ],
        2 => [
            'role_update' => ['required'],
            'direction_id_update' => ['required'],
            'fonction_update' => ['required'],
            'echelle_update' => ['required'],
            'echelon_update' => ['required'],
            'position_update' => ['required'],
            'base_update' => ['required'],
            'experience_pro_update' => ['required'],



        ],
        3 => [
            'type_contrat_update' => ['required'],
            'date_recrutement_update' => ['required'],
            'debut_contrat_update' => ['required'],
            'num_securite_social_update' => ['required'],
            'num_compte_update' => ['required'],

            


        ],
        4 =>[
            'situation_familiale_update' => ['required'],
            'situation_conjoint_update' => ['required'],
            'nbr_enfant_update' => ['required'],
        ]
    ];
    
    private $validationRules0 = [
        1 => [
            'prenom' => ['required'],
            'nom' => ['required'],
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'email', 'unique:users,email'],
            'sexe' => ['required'],
            'date_naiss' => ['required'],
            'lieu_naiss' => ['required'],
            'adresse' => ['required'],
            'num_telephone' => ['required'],
        ],
        2 => [
            'role' => ['required'],
            'direction_id' => ['required'],
            'fonction' => ['required'],
            'echelle' => ['required'],
            'base' => ['required'],
            'experience_pro' => ['required'],
            'position' => ['required'],
            'echelon' => ['required'],


        ],
        3 => [
            'type_contrat' => ['required'],
            'date_recrutement' => ['required'],
            'debut_contrat' => ['required'],
            'num_securite_social' => ['required'],
            'num_compte' => ['required'],

            


        ],
        4 =>[
            'situation_familiale' => ['required'],
            'situation_conjoint' => ['required'],
            'nbr_enfant' => ['required'],
        ]
    ];


    
    protected $messages = [
        'required'  => 'Ce champ ne peut pas être vide.',
        'email_update.email' => 'Le format de l\'adresse e-mail n\'est pas valide.',
        'email_update.unique' => 'L\'adresse e-mail doit être unique.',
    ];
    

    
    public function closeModal()
    {
        $this->currentPage_update = 1;
        $this->currentPage = 1;
        $this->resetInput();
        $this->resetValidation();

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->validationRules0[$this->currentPage]);
    }

    public function goToNextPage()
    {
        $this->validate($this->validationRules0[$this->currentPage]);
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    public function resetSuccess()
    {
        $this->reset('success');
    }


    public function updated_update($propertyName)
    {
        if($this->password_update != ""){
        $this->validateOnly($propertyName, $this->validationRules2[$this->currentPage_update]);
        }
        $this->validateOnly($propertyName, $this->validationRules[$this->currentPage_update]);
    }

    public function goToNextPage_update()
    {
        if($this->password_update != ""){
        $this->validate($this->validationRules2[$this->currentPage_update]);
        }
        $this->validate($this->validationRules[$this->currentPage_update]);
        $this->currentPage_update++;
    }

    public function goToPreviousPage_update()
    {
        $this->currentPage_update--;
    }

    public function resetSuccess_update()
    {
        $this->reset('success_update');
    }


    public function resetInput()
    {
        $this->prenom = '';
        $this->nom = '';
        $this->password = '';
        $this->email = '';
        $this->role = '';
        $this->direction_id = '';
        $this->branche = '';
        $this->sexe = '';
        $this->lieu_naiss = '';
        $this->date_naiss = '';
        $this->adresse = '';
        $this->situation_familiale ='';
        $this->situation_conjoint = '';
        $this->nbr_enfant = '';
        $this->type_contrat = '';
        $this->date_recrutement = '';
        $this->debut_contrat = '';
        $this->fin_contrat = '';
        $this->fonction ='';
        $this->echelle = '';
        $this->base = '';
        $this->experience_pro = '';
        $this->position = '';
        $this->echelon = '';
        $this->num_telephone ='';
        $this->num_securite_social = '';
        $this->num_compte ='';

    }

    public function deleteUser()
    {
        
        $user = User::find($this->userid2);
        $user->delete();
        return $user;
    }


    public function fetchUser(int $id){


        $user = User::find($id);
        $this->userid2 = $user->id;

    }


    public function editUser(int $id){


        $user = User::find($id);
            $this->userid = $user->id;
            $this->prenom_update = $user->prenom;
            $this->nom_update = $user->nom;
            $this->email_update = $user->email;
            $this->role_update = $user->role;
            $this->direction_id_update = $user->direction_id;

            $direction = Direction::find($user->direction_id);
            $this->branche_update = $direction->branche_id;

            $this->sexe_update = $user->sexe;
            $this->lieu_naiss_update = $user->lieu_naiss;
            $this->date_naiss_update = $user->date_naiss;
            $this->adresse_update = $user->adresse;
            $this->situation_familiale_update = $user->situation_familiale;
            $this->situation_conjoint_update = $user->situation_conjoint;
            $this->nbr_enfant_update = $user->nbr_enfant;
            $this->type_contrat_update = $user->type_contrat;
            $this->date_recrutement_update = $user->date_recrutement;
            $this->debut_contrat_update = $user->debut_contrat;
            $this->fin_contrat_update = $user->fin_contrat;
            $this->fonction_update = $user->fonction;
            $this->echelon_update = $user->echelon;
            $this->base_update = $user->base;
            $this->experience_pro_update = $user->experience_pro;
            $this->position_update = $user->position;
            $this->echelle_update = $user->echelle;
            $this->num_telephone_update = $user->num_telephone;
            $this->num_securite_social_update = $user->num_securite_social;
            $this->num_compte_update = $user->num_compte;



    }

    
    public function updateUser(){

        $rules = collect($this->validationRules)->collapse()->toArray();
        $rules2 = collect($this->validationRules2)->collapse()->toArray();


        if($this->password_update != ""){
            $this->validate($rules2);
         }
         $this->validate($rules);

        $matricule = Helper::matricule($this->direction_id_update);

        if($this->password_update == "")
        {
            $password = User::find($this->userid)->password;   
        }else{
            
            $password = bcrypt($this->password_update);
        }

        $update = User::find($this->userid)->update([

            'matricule' => $matricule,
            'prenom' => $this->prenom_update,
            'nom' => $this->nom_update,
            'email' => $this->email_update,
            'password' => $password,
            'direction_id' => $this->direction_id_update,
            'sexe' => $this->sexe_update,
            'lieu_naiss' => $this->lieu_naiss_update,
            'date_naiss' => $this->date_naiss_update,
            'adresse' => $this->adresse_update,
            'situation_familiale' => $this->situation_familiale_update,
            'situation_conjoint' => $this->situation_conjoint_update,
            'nbr_enfant' => $this->nbr_enfant_update,
            'role' => $this->role_update,
            'type_contrat' => $this->type_contrat_update,
            'date_recrutement' => $this->date_recrutement_update,
            'debut_contrat' => $this->debut_contrat_update,
            'fin_contrat' => $this->fin_contrat_update,
            'fonction' => $this->fonction_update,
            'echelle' => $this->echelle_update,
            'echelon' => $this->echelon_update,
            'position' => $this->position_update,
            'base' => $this->base_update,
            'experience_pro' => $this->experience_pro_update,
            'num_telephone' => $this->num_telephone_update,
            'num_securite_social' => $this->num_securite_social_update,
            'num_compte' => $this->num_compte_update,


        ]);

        $this->success = 'Utilisateur modifié avec succès!';

    }


    


    

    public function createUser()
    {

        $rules = collect($this->validationRules0)->collapse()->toArray();

        $this->validate($rules);

        
        $matricule = Helper::matricule($this->direction_id);

        $values = array(
            'matricule' => $matricule,
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'direction_id' => $this->direction_id,
            'sexe' => $this->sexe,
            'lieu_naiss' => $this->lieu_naiss,
            'date_naiss' => $this->date_naiss,
            'adresse' => $this->adresse,
            'situation_familiale' => $this->situation_familiale,
            'situation_conjoint' => $this->situation_conjoint,
            'nbr_enfant' => $this->nbr_enfant,
            'role' => $this->role,
            'type_contrat' => $this->type_contrat,
            'date_recrutement' => $this->date_recrutement,
            'debut_contrat' => $this->debut_contrat,
            'fin_contrat' => $this->fin_contrat,
            'fonction' => $this->fonction,
            'echelle' => $this->echelle,
            'echelon' => $this->echelon,
            'experience_pro' => $this->experience_pro,
            'base' => $this->base,
            'position' => $this->position,
            'num_telephone' => $this->num_telephone,
            'num_securite_social' => $this->num_securite_social,
            'num_compte' => $this->num_compte,



        );
        User::insert($values);

        $this->reset();
        $this->resetValidation();

        $this->success = 'Utilisateur créé avec succès!';

    }


    
    public function searchUser(){


        $directions = Direction::all();
        $branches = Branche::all();

        return view('livewire.user-form',compact('users','directions','branches'));
    }



    public function render()
    {
        $directions;
        if(!empty($this->branche_update)) {
            $directions = Direction::where('branche_id', $this->branche_update)->get();
        }
        elseif(empty($this->branche)) {
            $directions = Direction::where('id', $this->direction_id_update)->get();
        }

        if(!empty($this->branche)) {
            $directions = Direction::where('branche_id', $this->branche)->get();
        }
        elseif(empty($this->branche_update)) {
            $directions = Direction::where('branche_id', '*')->get();
        }


        if(isset($this->data))
        {
        $users =  User::where('prenom','LIKE','%'.$this->data.'%')
        ->orWhere('nom','LIKE','%'.$this->data.'%')
        ->orWhere('fonction','LIKE','%'.$this->data.'%')
        ->orWhere('matricule','LIKE','%'.$this->data.'%')
        ->orWhere('email','LIKE','%'.$this->data.'%')
        ->orWhere('num_telephone','LIKE','%'.$this->data.'%')
        ->get();
        }
        else{
            $users = User::all();
        }
        

        $branches = Branche::all();
       
        return view('livewire.user-form',compact('directions','branches','users'));
    }
}