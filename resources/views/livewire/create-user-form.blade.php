<div>

   
                        @if ($success)
                        @if($currentPage === 1)
                            <div class="text-sm bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ $success }}</span>
                            </div>
                            @endif
                        @endif

                        <form wire:submit.prevent="submit">
                            
                            <div class="modal-header">

                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $pages[$currentPage]['heading'] }}</h3>
                            </div>
                            </div>

                            <div class="modal-body">

            

                                @if ($currentPage === 1)
                                    <div class="form-group">
                                        <label for="first_name">Prénom</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" wire:model.lazy="first_name">
                                        @error('first_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                    </div>
        
                                    <div class="form-group">
                                        <label for="last_name">Nom</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" wire:model.lazy="last_name">
                                        @error('last_name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                                    </div>
        
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
                            
                                    @elseif ($currentPage === 2)
                           
                    
                            <div class="form-group">
                                <label for="password">Role</label>
                                <select class="form-control" id="role" name="role" wire:model.lazy="role">
                                    <option value="" style="display: none;">Selectionner le role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Employé</option>
                                    <option value="2">Agent</option>
                                </select>
                            </div>
                    
                             <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" wire:model.lazy="start_date">
                            </div>
                             <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" wire:model.lazy="end_date">
                            </div>
                    

                                            <div class="form-group"> 
                                                <select class="form-control" id="var1" wire:model="branche">
                                                    <option value="" hidden>Selectionner la branche</option>
                                                    @foreach ($branches as $branche)
                                                    <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    
                                    
                                            <div class="form-group"> 
                                                <select class="form-control" id="var2" wire:model="departement">
                                                    <option value="" hidden>Selectionner la direction</option>
                                                    @foreach ($directions as $direction)
                                                    <option   value="{{ $direction->id }}"> {{ $direction->nom_direction }} </option>
                                                    @endforeach
                                                </select>
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
                    