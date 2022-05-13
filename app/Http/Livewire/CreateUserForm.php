<?php

namespace App\Http\Livewire;

use App\Helpers\helper;

use App\Models\User;
use App\Models\Direction;
use App\Models\Branche;
use Livewire\Component;

class CreateUserForm extends Component
{
   
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $start_date;
    public $end_date;
    public $branche;
    public $departement;
    public $role;



    public $currentPage = 1;
    public $success;

    
    public $pages = [
        1 => [
            'heading' => 'Informations personnelles',
            'subheading' => 'Enter your name and email to get started.',
        ],
        2 => [
            'heading' => 'Password',
            'subheading' => 'Create a password for the new account.',
        ],
    ];

    
    private $validationRules = [
        1 => [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['required', 'string', 'min:8'],
            'email' => ['required', 'email', 'unique:users,email'],
        ],
        2 => [
            'role' => ['required'],
        ],
    ];

    protected $messages = [
        'required'  => 'Ce champ ne peut pas être vide.',
        'email.email' => 'Le format de l\'adresse e-mail n\'est pas valide.',
        'email.unique' => 'L\'adresse e-mail doit être unique.',
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->validationRules[$this->currentPage]);
    }

    public function goToNextPage()
    {
        $this->validate($this->validationRules[$this->currentPage]);
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


    public function submit()
    {

        $rules = collect($this->validationRules)->collapse()->toArray();

        $this->validate($rules);

        
        $matricule = Helper::matricule($this->departement, $this->start_date, "F");

        $values = array(
            'matricule' => $matricule,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'departement' => $this->departement,
            'role' => $this->role,
        );
        User::insert($values);

        $this->reset();
        $this->resetValidation();

        $this->success = 'Utilisateur créé avec succès!';

    }

    

    public function render()
    {
        $directions;
        if(!empty($this->branche)) {
            $directions = Direction::where('branche_id', $this->branche)->get();
        }
        else{
            $directions = Direction::where('branche_id', '*')->get();
        }


        $branches = Branche::all();
        return view('livewire.create-user-form',compact('directions','branches'));
    }
}