

                                    <!-- The Modal -->
            <div wire:ignore.self class="modal fade in" id="modalEditUser">
               
              <div class="modal-dialog">
                

                <div class="modal-content">
                    @if ($success)
                <div class="text-sm bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ $success }}</span>
                </div>
            @endif
                  <form wire:submit.prevent="updateUser">
                    @csrf
                      <!-- Modal Header -->
                      <div class="modal-header">
                        <div class="px-4 sm:px-0">
                          <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $pages[$currentPage_update]['heading'] }}</h3>
                        </div>

                       <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"></button>
                        
                      </div>

                    <input type="hidden" name="id" wire:model="userid" class="form-control">

                      <!-- Modal body -->
                      <div class="modal-body">

                                @if ($currentPage_update === 1)

                                <div class="form-group">
                                    <label for="email_update">Email</label>
                                    <input type="email" wire:model="email_update" class="form-control">
                                    @error('email_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
    
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control" wire:model.lazy="password_update">
                                    @error('password_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
                                
                                <div class="row">
                                <div class="form-group col-sm">
                                    <label for="nom">Nom</label>
                                    <input type="text" wire:model="nom_update" class="form-control">
                                    @error('nom_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                </div>
                                    <div class="form-group col-sm">
                                        <label for="prenom_update">Prénom</label>
                                        <input type="text" wire:model="prenom_update" class="form-control">
                                        @error('prenom_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
        
                                   
                                 
                                <div class="form-group">
                                  <label for="password">Sexe</label>
                                  <select class="form-control" wire:model="sexe_update">
                                      <option value="" style="display: none;">Selectionner le sexe</option>
                                      <option value="H">Homme</option>
                                      <option value="F">Femme</option>
                                  </select>
                                  @error('sexe_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                              </div>


                                    <div class="row">
                                        <div class="form-group col-sm">
                                        <label for="date_naiss_update">Date de naissance</label>
                                        <input type="date" wire:model="date_naiss_update"  class="form-control">
                                        @error('date_naiss_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>

                                    <div class="form-group col-sm">
                                        <label for="lieu_naiss_update">Lieu de naissance</label>
                                        <input type="text" wire:model="lieu_naiss_update" class="form-control">
                                        @error('lieu_naiss_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse_update">Adresse</label>
                                        <input type="text"class="form-control" wire:model.lazy="adresse_update">
                                        @error('adresse_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="num_telephone_update">Numéro de téléphone</label>
                                        <input type="tel"  class="form-control" wire:model.lazy="num_telephone_update">
                                        @error('num_telephone_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>


                                    






                                    @elseif ($currentPage_update === 2)
                           
                    
                            

                         
                                    <div class="form-group">
                                        <label for="password">Role</label>
                                        <select class="form-control" id="role"wire:model.lazy="role_update">
                                            <option value="" style="display: none;">Selectionner le role</option>
                                            <option value="0">Responsable du personnel</option>
                                            <option value="1">Employé</option>
                                            <option value="2">Agent</option>
                                        </select>
                                        @error('role_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>

                            
                                    <div class="row">
                 
                            <div class="form-group col-sm"> 
                                <label for="password">Branche</label>
                                <select class="form-control" id="var1" wire:model="branche_update">
                                    <option value="" hidden>Selectionner la branche</option>
                                    @foreach ($branches as $branche)
                                    <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                                    @endforeach
                                </select>
                                
                            </div>
                    
                    
                            <div class="form-group col-sm"> 
                                <label for="direction_id">Direction</label>
                                <select class="form-control" id="var2" wire:model="direction_id_update">
                                    <option value="" hidden>Selectionner la direction</option>
                                    @foreach ($directions as $direction)
                                    <option   value="{{ $direction->id }}"> {{ $direction->nom_direction }} </option>
                                    @endforeach
                                </select>
                                @error('direction_id_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                      </div>

                      <div class="form-group col-sm"> 
                        <label for="base_update">Base</label>
                        <select class="form-control" wire:model="base_update">
                            <option value="" hidden>Selectionner la base</option>
                            <option value="0"> 20 Août 1955 BP 206 / 207Hassi-Messaoud </option>
                            <option value="1"> 19 December 1960  </option>
                            <option value="2"> Birkhadem -Alger </option>
                            <option value="3"> Logistique Hassi-Messaoud </option>
                            <option value="4"> In Aménas </option>
                            <option value="5"> T32 Hassi-Messaoud </option>
                        </select>
                        @error('base_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                    </div>

                            <div class="row">

                                <div class="form-group col-sm"> 
                                    <label for="position_update">Position</label>
                                    <select class="form-control" id="var3" wire:model="position_update">
                                        <option value="" hidden>Selectionner la position</option>
                                        <option value="0"> Exécutant </option>
                                        <option value="1"> Maître </option>
                                        <option value="2"> Cadre moyen </option>
                                        <option value="3"> Cadre supérieur </option>
                                        <option value="4"> Cadre de régions </option>
                                        <option value="5"> PDG </option>
                                    </select>
                                    @error('position_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
    
                                </div>

                            <div class="form-group col-sm">
                                <label for="fonction">Fonction</label>
                                <input type="text" id="fonction" class="form-control" wire:model.lazy="fonction_update">
                                @error('fonction_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>


                            </div>

                            <div class="form-group">
                                <label for="experience_pro_update">Expérience professionnelle</label><br>
                                <input type="number" class="form-control" style="width:80%; display:inline;" wire:model.lazy="experience_pro_update">
                                <label> % </label>
                                @error('experience_pro_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="row">
                           
                               

                                <div class="form-group col-sm">
                                    <label for="echelle">Echelle</label>
                                    <input type="number" class="form-control" wire:model.lazy="echelle_update">
                                    @error('echelle_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
    
                                </div>

                            <div class="form-group col-sm">
                                <label for="echelon">Echelon</label>
                                <input type="number" class="form-control" wire:model.lazy="echelon_update">
                                @error('echelon_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
  
                            </div>
                         

                           

                                            @elseif($currentPage_update === 3)

                                          

                                            
                            <div class="form-group">
                                <label for="type_contrat">Type de contrat</label>
                                <select class="form-control"  wire:model.lazy="type_contrat_update">
                                    <option value="" style="display: none;">Selectionner le type du contrat</option>
                                    <option value="0">CDI</option>
                                    <option value="1">CDD</option>
                                </select>
                                @error('type_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <label for="date_recrutement">Date recrutement</label>
                                <input type="date" class="form-control" wire:model.lazy="date_recrutement_update">
                                @error('date_recrutement_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                    
                            <div class="row">

                             <div class="form-group col-sm">
                                <label for="debut_contrat">Debut contrat</label>
                                <input type="date"  id="debut_contrat" class="form-control" wire:model.lazy="debut_contrat_update">
                                @error('debut_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                             <div class="form-group col-sm">
                                <label for="fin_contrat">Fin contrat</label>
                                <input type="date" id="fin_contrat" class="form-control" wire:model.lazy="fin_contrat_update">
                                @error('fin_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                            </div>

                            <div class="form-group">
                                <label for="num_compte">Numéro de compte bancaire</label>
                                <input type="text" id="num_compte" class="form-control" wire:model.lazy="num_compte_update">
                                @error('num_compte_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <label for="num_securite_social">Numéro securite social</label>
                                <input type="text"  id="num_securite_social" class="form-control" wire:model.lazy="num_securite_social_update">
                                @error('num_securite_social_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                    
                          
                            @elseif($currentPage_update === 4)
                                

                            <div class="form-group">
                                <label for="situation_familiale">Situation familiale</label>
                                <select class="form-control" id="situation_familiale"  wire:model.lazy="situation_familiale_update">
                                    <option value="" style="display: none;">Selectionner la situation familiale</option>
                                    <option value="0">Celibataire</option>
                                    <option value="1">Marié</option>
                                    <option value="2">Divorcé</option>
                                </select>
                                @error('situation_familiale_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>

                            <div class="form-group">
                                <label for="situation_conjoint">Situation de conjoint</label>
                                <select class="form-control" id="situation_conjoint"  wire:model.lazy="situation_conjoint_update">
                                    <option value="" style="display: none;">Selectionner la situation de conjoint</option>
                                    <option value="0">Chomage</option>
                                    <option value="1">Travail</option>
                                </select>
                                @error('situation_conjoint_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                            </div>
                                            
                
                                            <div class="form-group">
                                                <label for="nbr_enfant">Nombre d'enfants</label>
                                                <input type="number" id="nbr_enfant" class="form-control" wire:model.lazy="nbr_enfant_update">
                                                @error('nbr_enfant_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                
                                            </div>

                                      
                                            @endif
                                            

                                            <div class="modal-footer">

                                            @if ($currentPage_update === 1)
                                            <div></div>
                                        @else
                                            <button wire:click="goToPreviousPage_update" type="button" class="btn btn-secondary">Back</button>
                                        @endif

                                        @if ($currentPage_update === count($pages))
                                        <button type="submit" class="btn btn-yellow">Save</button>
                                        @else
                                            <button wire:click="goToNextPage_update" type="button" class="btn btn-primary">
                                                Next
                                            </button>
                                        @endif
                                            </div>

                            </div>

                                            
                        </form>
                      </div>
                    </div>
                  </div>
                    