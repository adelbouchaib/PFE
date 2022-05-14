

                                    <!-- The Modal -->
            <div wire:ignore.self class="modal fade in" id="modalDeleteUser">

              <div class="modal-dialog">
                <div class="modal-content">
                  <form wire:submit.prevent="deleteUser">
                    @csrf
                      <!-- Modal Header -->
                      <div class="modal-header">
                       
                       <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        
                      </div>

                    <input type="hidden" wire:model="userid2" class="form-control">

                      <!-- Modal body -->
                      <div class="modal-body">

                                            

                                            <div class="modal-footer">

                                        
                                        <button type="submit" class="btn btn-yellow">Save</button>
                                      
                                            </div>

                            </div>

                                            
                        </form>
                      </div>
                    </div>
                  </div>
                    