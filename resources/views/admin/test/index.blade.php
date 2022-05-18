@extends('admin.master')
@section('title')
All Users
@stop
@section('content')




<div class="container  bg-white  mb-5">
  
    <div class="row">
        <div class="col-md-3 border-right">
        <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span></span>
                
              </div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>

            </div>        
          </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" class="form-control" placeholder="first name" value="{{Auth::User()->nom}}"></div>
                    <div class="col-md-6"><label class="labels">Prenom</label><input type="text" class="form-control" value="{{Auth::User()->prenom}}" placeholder="surname"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Date De Naissance</label><input type="text" class="form-control" placeholder="first name" value="{{Auth::User()->date_naiss}}"></div>
                    <div class="col-md-6"><label class="labels">Lieu De Naissance</label><input type="text" class="form-control" value="{{Auth::User()->lieu_naiss}}" placeholder="surname"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Numéro de Téléphone</label><input type="text" class="form-control" placeholder="enter phone number" value="{{Auth::User()->num_telephone}}"></div>
                    <div class="col-md-12"><label class="labels">Addresse</label><input type="text" class="form-control" placeholder="enter address line 1" value="{{Auth::User()->adresse}}"></div>
                    <div class="col-md-12"><label class="labels">Numero De Compte</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{Auth::User()->num_compte}}"></div>
                    <div class="col-md-12"><label class="labels">Etat</label><input type="text" class="form-control" placeholder="enter address line 2" value="{{Auth::User()->adresse}}"></div>
                    <div class="col-md-12"><label class="labels">wilaya</label>
                    <input type="text" class="form-control" placeholder="enter address line 2" value=""></div>
                    <div class="col-md-12"><label class="labels">Email </label>
                    <input type="text" class="form-control" placeholder="enter email id" value="{{Auth::User()->email}}">
                    
                  </div>
                    <div class="col-md-12"><label class="labels">La situation familiale</label><input type="text" class="form-control" placeholder="education" value="{{Auth::User()->situation_familiale}}"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value=""></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state"></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="button">Save Profile</button></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span>
                
                <button type="submit" datee="" class="btn btn-primary btn-add-user"><i class="">Edit Profile</i></a>

                
                </div><br>
                <div class="col-md-12"><label class="labels">Fonction</label><input type="text" class="form-control" placeholder="experience" value="{{Auth::User()->fonction}}"></div> <br>
                <div class="col-md-12"><label class="labels">Type De Contrat</label><input type="text" class="form-control" placeholder="additional details" value="{{Auth::User()->type_contrat}}"></div>
                <div class="col-md-12"><label class="labels">Date De Recrutement</label><input type="text" class="form-control" placeholder="additional details" value="{{Auth::User()->date_recrutement}}"></div>
                <div class="col-md-12"><label class="labels">Debut De Contrat</label><input type="text" class="form-control" placeholder="additional details" value="{{Auth::User()->debut_contrat}}"></div>
                <div class="col-md-12"><label class="labels">Fin De Contrat</label><input type="text" class="form-control" placeholder="additional details" value="{{Auth::User()->fin_contrat}}"></div>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<div class="modal fade in" id="modalEditUser">
    <div class="modal-dialog">
      <div class="modal-content">
  
  
        <form method="post" accept-charset="utf-8" id="form-edit"> 
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modifier l'absence</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <div class="modall-body">
                                    <label class="labels">Email </label>
                                 <input type="text" class="form-control" value=""></div>    

            </div>

        </div>

      

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @section('script')
   <script>
      
@stop
@stop