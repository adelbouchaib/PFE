<div wire:ignore.self class="modal fade in" id="modalCreateUser">
   
    <div class="modal-dialog">
        <div class="modal-content">

                        <form wire:submit.prevent="createUser">
                            @csrf

                            <div class="modal-header">
                                @if ($success)
                                @if($currentPage === 1)
                                    <div class="text-sm bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                        <span class="block sm:inline">{{ $success }}</span>
                                    </div>
                                    @endif
                                @endif

                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $pages[$currentPage]['heading'] }}</h3>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"></button>

                            </div>

                            <div class="modal-body">

            


                                @if ($currentPage === 1)

                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" wire:model.lazy="email">
                                    @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
    
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" name="password" id="password" class="form-control" wire:model.lazy="password">
                                    @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
                                
                                <div class="row">
                                <div class="form-group col-sm">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="nom" id="nom" class="form-control" wire:model.lazy="nom">
                                    @error('nom') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
                                    <div class="form-group col-sm">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" name="prenom" id="prenom" class="form-control" wire:model.lazy="prenom">
                                        @error('prenom') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
        
                                   
                                 

                                    <div class="form-group">
                                        <label for="password">Sexe</label><br>
                                        <div class="form-check  form-check-inline">
                                            <input class="form-check-input"  type="radio" value="H"   wire:model.lazy="sexe" checked/>
                                            <label class="form-check-label" for="inlineRadio1">Homme</label>
                                            </div>
                                            <div class="form-check  form-check-inline">
                                                <input class="form-check-input"  type="radio" value="F"   wire:model.lazy="sexe"/>
                                            <label class="form-check-label" for="inlineRadio2">Femme</label>
                                            </div>
                                            @error('sexe') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-sm">
                                        <label for="date_naiss">Date de naissance</label>
                                        <input type="date" name="date_naiss" id="date_naiss" class="form-control" wire:model.lazy="date_naiss">
                                        @error('date_naiss') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>

                                    <div class="form-group col-sm">
                                        <label for="lieu_naiss">Lieu de naissance</label>
                                        <input type="text" name="lieu_naiss" id="lieu_naiss" class="form-control" wire:model.lazy="lieu_naiss">
                                        @error('lieu_naiss') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <input type="text" name="adresse" id="adresse" class="form-control" wire:model.lazy="adresse">
                                        @error('adresse') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="num_telephone">Numéro de téléphone</label>
                                        <input type="tel" name="num_telephone" id="num_telephone" class="form-control" wire:model.lazy="num_telephone">
                                        @error('num_telephone') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>


                                    






                                    @elseif ($currentPage === 2)
                           
                    
                            

                         
                                    <div class="form-group">
                                        <label for="password">Role</label>
                                        <select class="form-control" id="role" name="role" wire:model.lazy="role">
                                            <option value="" style="display: none;">Selectionner le role</option>
                                            <option value="0">Admin</option>
                                            <option value="1">Employé</option>
                                            <option value="2">Agent</option>
                                        </select>
                                        @error('role') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>

                            
                                            
                            <div class="form-group"> 
                                <label for="password">Branche</label>
                                <select class="form-control" id="var1" wire:model="branche">
                                    <option value="" hidden>Selectionner la branche</option>
                                    @foreach ($branches as $branche)
                                    <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                                    @endforeach
                                </select>
                                
                            </div>
                    
                    
                            <div class="form-group"> 
                                <label for="direction_id">Direction</label>
                                <select class="form-control" id="var2" wire:model="direction_id">
                                    <option value="" hidden>Selectionner la direction</option>
                                    @foreach ($directions as $direction)
                                    <option   value="{{ $direction->id }}"> {{ $direction->nom_direction }} </option>
                                    @endforeach
                                </select>
                                @error('direction_id') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>



                            <div class="form-group">
                                <label for="fonction">Fonction</label>
                                <input type="text" name="fonction" id="fonction" class="form-control" wire:model.lazy="fonction">
                                @error('fonction') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="row">
                                <div class="form-group col-sm">
                                    <label for="echelle">Echelle</label>
                                    <input type="number" name="echelle" id="echelle" class="form-control" wire:model.lazy="echelle">
                                    @error('echelle') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
    
                                </div>
      
                            
                            <div class="form-group col-sm">
                                <label for="echelon">Echelon</label>
                                <input type="number" name="echelon" id="echelon" class="form-control" wire:model.lazy="echelon">
                                @error('echelon') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
  
                            </div>
                         

                           

                                            @elseif($currentPage === 3)

                                          

                                            
                            <div class="form-group">
                                <label for="type_contrat">Type de contrat</label>
                                <select class="form-control" id="type_contrat" name="type_contrat" wire:model.lazy="type_contrat">
                                    <option value="" style="display: none;">Selectionner le type du contrat</option>
                                    <option value="0">CDI</option>
                                    <option value="1">CDD</option>
                                </select>
                                @error('type_contrat') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <label for="date_recrutement">Date recrutement</label>
                                <input type="date" name="date_recrutement" id="date_recrutement" class="form-control" wire:model.lazy="date_recrutement">
                                @error('date_recrutement') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                    
                            <div class="row">

                             <div class="form-group col-sm">
                                <label for="debut_contrat">Debut contrat</label>
                                <input type="date" name="debut_contrat" id="debut_contrat" class="form-control" wire:model.lazy="debut_contrat">
                                @error('debut_contrat') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                             <div class="form-group col-sm">
                                <label for="fin_contrat">Fin contrat</label>
                                <input type="date" name="fin_contrat" id="fin_contrat" class="form-control" wire:model.lazy="fin_contrat">
                                @error('fin_contrat') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                            </div>

                            <div class="form-group">
                                <label for="num_compte">Numéro de compte bancaire</label>
                                <input type="text" name="num_compte" id="num_compte" class="form-control" wire:model.lazy="num_compte">
                                @error('num_compte') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <label for="num_securite_social">Numéro securite social</label>
                                <input type="text" name="num_securite_social" id="num_securite_social" class="form-control" wire:model.lazy="num_securite_social">
                                @error('num_securite_social') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                    
                          
                            @elseif($currentPage === 4)
                                

                            <div class="form-group">
                                <label for="situation_familiale">Situation familiale</label>
                                <select class="form-control" id="situation_familiale" name="situation_familiale" wire:model.lazy="situation_familiale">
                                    <option value="" style="display: none;">Selectionner la situation familiale</option>
                                    <option value="0">Celibataire</option>
                                    <option value="1">Marié</option>
                                    <option value="2">Divorcé</option>
                                </select>
                                @error('situation_familiale') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                                            <div class="form-group">
                                                <label for="password">Situation de conjoint</label><br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="0" checked  wire:model.lazy="situation_conjoint"/>
                                                    <label class="form-check-label" for="inlineRadio1">Chomage</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input"  type="radio" value="1"   wire:model.lazy="situation_conjoint"/>
                                                    <label class="form-check-label" for="inlineRadio2">Travail</label>
                                                    </div>
                                                    @error('situation_conjoint') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                            </div>
                
                                            <div class="form-group">
                                                <label for="nbr_enfant">Nombre d'enfants</label>
                                                <input type="number" name="nbr_enfant" id="nbr_enfant" class="form-control" wire:model.lazy="nbr_enfant">
                                                @error('nbr_enfant') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                
                                            </div>

                                      
                                            @endif
                                            

                                            <div class="modal-footer">

                                            @if ($currentPage === 1)
                                            <div></div>
                                        @else
                                            <button wire:click="goToPreviousPage" type="button" class="btn btn-secondary">Back</button>
                                        @endif

                                        @if ($currentPage === count($pages))
                                        <button type="submit" class="btn btn-yellow">Save</button>
                                        @else
                                            <button wire:click="goToNextPage" type="button" class="btn btn-primary">
                                                Next
                                            </button>
                                        @endif
                                            </div>

                            </div>

                                            
                        </form>
                    </div>
                </div>
              </div>
                