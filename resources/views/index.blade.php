@extends('admin.master')
@section('title')
Profile
@stop
@section('content')

@if (\Session::has('success'))
<div class="alert alert-success">
      {!! \Session::get('success') !!}
</div>
@endif
  
  <div class="profile">
  
  <div class="profile-header">
  <div class="profile-header-cover"></div>
  <div class="profile-header-content">
  <div class="profile-header-img" style="background:none;">
    <img src="/assets/img/profile_picture_user_icon_1538472.png" alt="" class="ms-100 mh-100 rounded-circle" />
  </div>
  <h1>Bienvenue {{ Auth::User()->prenom }} {{ Auth::User()->nom }}</h1>

  </div>
  </div>




  <form method="post" action="{{ route('profile.update') }}" accept-charset="utf-8"">
    @csrf
    <div class="row">

            <div class="col-sm">
              <div class="modal-dialog">
                <div class="modal-content">

              <div class="modal-body">
              
                <div class="form-group">
                  <label for="email_update">Email</label>
                  <input type="email" id="email_update" name="email_update" class="form-control">
                  @error('email_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>

              <div class="form-group">
                  <label for="password">Mot de passe</label>
                  <input type="password" class="form-control" name="password_update">
                  @error('password_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>

              <div class="row">
              <div class="form-group col-sm">
                  <label for="nom">Nom</label>
                  <input type="text" id="nom_update" name="nom_update" class="form-control">
                  @error('nom_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>
                  <div class="form-group col-sm">
                      <label for="prenom_update">Prénom</label>
                      <input type="text" id="prenom_update" name="prenom_update" class="form-control">
                      @error('prenom_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                  </div>
              </div>

                
              
              <div class="form-group">
                <label for="password">Sexe</label>
                <select class="form-control" id="sexe_update" name="sexe_update">
                    <option value="" style="display: none;">Selectionner le sexe</option>
                    <option value="H">Homme</option>
                    <option value="F">Femme</option>
                </select>
                @error('sexe_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

            </div>


                  <div class="row">
                      <div class="form-group col-sm">
                      <label for="date_naiss_update">Date de naissance</label>
                      <input type="date" id="date_naiss_update" name="date_naiss_update"  class="form-control">
                      @error('date_naiss_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                  </div>

                  <div class="form-group col-sm">
                      <label for="lieu_naiss_update">Lieu de naissance</label>
                      <input type="text" id="lieu_naiss_update" name="lieu_naiss_update" class="form-control">
                      @error('lieu_naiss_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                  </div>
                  </div>

                  <div class="form-group">
                      <label for="adresse_update">Adresse</label>
                      <input type="text" class="form-control" id="adresse_update" name="adresse_update">
                      @error('adresse_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                  </div>
                  <div class="form-group">
                      <label for="num_telephone_update">Numéro de téléphone</label>
                      <input type="tel"  class="form-control" id="num_telephone_update" name="num_telephone_update">
                      @error('num_telephone_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                  </div>
                </div>





                </div>
              </div>
              </div>



              <div class="col-sm">
                <div class="modal-dialog">
                  <div class="modal-content">
                    
                <div class="modal-body">

                <div class="row">

                  <div class="form-group col-sm">
                  <label for="password">Branche</label>
                  <select class="form-control" id="branche_update" name="branche_update">
                    <div class="branche">

                    </div>
                    @foreach ($branches as $branche)
                    <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                    @endforeach
                  
                  </select>

                  </div>

                  <div class="form-group col-sm"> 
                  <label for="direction_id">Direction</label>
                  <select class="form-control" id="direction_id_update" name="direction_id_update">
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
                  <select class="form-control" id="base_update" name="base_update">
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
              <select class="form-control " id="position_update" name="position_update">
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
              <input type="text"  class="form-control" id="fonction_update" name="fonction_update">
              @error('fonction_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>
                </div>

              <div class="form-group">
              <label for="experience_pro_update">Expérience professionnelle</label><br>
              <input type="number" class="form-control" style="width:80%; display:inline;" id="experience_pro_update" name="experience_pro_update">
              <label> % </label>
              @error('exp_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>

              <div class="row">

              <div class="form-group col-sm">
                <label for="echelle">Echelle</label>
                <input type="number" class="form-control" id="echelle_update" name="echelle_update">
                @error('echelle_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>

              <div class="form-group col-sm">
              <label for="echelon">Echelon</label>
              <input type="number" class="form-control" id="echelon_update" name="echelon_update">
              @error('echelon_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

              </div>

            </div>

  </div>
</div>

</div>

</div>
</div>




<div class="row">
  <div class="col-sm">
    <div class="modal-dialog">
      <div class="modal-content">
    
        <div class="modal-body">
            
                                            
          <div class="form-group">
            <label for="type_contrat">Type de contrat</label>
            <select class="form-control" id="type_contrat_update" name="type_contrat_update">
                <option value="" style="display: none;">Selectionner le type du contrat</option>
                <option value="0">CDI</option>
                <option value="1">CDD</option>
            </select>
            @error('type_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">
            <label for="date_recrutement">Date recrutement</label>
            <input type="date" class="form-control" id="date_recrutement_update" name="date_recrutement_update">
            @error('date_recrutement_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>

        <div class="row">

         <div class="form-group col-sm">
            <label for="debut_contrat">Debut contrat</label>
            <input type="date"  id="debut_contrat_update" class="form-control" name="debut_contrat_update">
            @error('debut_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>
         <div class="form-group col-sm">
            <label for="fin_contrat">Fin contrat</label>
            <input type="date" id="fin_contrat_update" class="form-control" name="fin_contrat_update">
            @error('fin_contrat_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>
        </div>

        <div class="form-group">
            <label for="num_compte">Numéro de compte bancaire</label>
            <input type="text" id="num_compte_update" class="form-control" name="num_compte_update">
            @error('num_compte_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">
            <label for="num_securite_social">Numéro securite social</label>
            <input type="text"  id="num_securite_social_update" class="form-control" name="num_securite_social_update">
            @error('num_securite_social_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

        </div>

</div>
</div>
</div>
</div>



<div class="col-sm">
<div class="modal-dialog">
  <div class="modal-content">
    
<div class="modal-body">


  <div class="form-group">
    <label for="situation_familiale">Situation familiale</label>
    <select class="form-control" id="situation_familiale_update"  name="situation_familiale_update">
        <option value="" style="display: none;">Selectionner la situation familiale</option>
        <option value="0">Celibataire</option>
        <option value="1">Marié</option>
        <option value="2">Divorcé</option>
    </select>
    @error('situation_familiale_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

</div>

<div class="form-group">
    <label for="situation_conjoint">Situation de conjoint</label>
    <select class="form-control" id="situation_conjoint_update"  name="situation_conjoint_update">
        <option value="" style="display: none;">Selectionner la situation de conjoint</option>
        <option value="0">Chomage</option>
        <option value="1">Travail</option>
    </select>
    @error('situation_conjoint_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

</div>
                

                <div class="form-group">
                    <label for="nbr_enfant">Nombre d'enfants</label>
                    <input type="number" id="nbr_enfant_update" class="form-control" name="nbr_enfant_update">
                    @error('nbr_enfant_update') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror

                </div>


                <button type="submit" style="float:right; margin-top:10px;" class="btn btn-yellow">Save</button>


</div>
</div>
</div>

</div>
</div>
</form>


@section('script')

    <script>
       

     $(document).ready(function(){
        var idUser =  '<?php echo(Auth::user()->id); ?>';
        
     console.log(idUser);

         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
     
         });
     
                 $.ajax({
                     url:"{{route('profile.edit')}}",
                     type:'POST',
                     data:{
                         id:idUser,
                     },
                     success:function(data){
                         console.log('success edit');
                         console.log(data.data.fonction);
                         $('#nom_update').val(data.data.nom);
                         $('#prenom_update').val(data.data.prenom);
                         $('#lieu_naiss_update').val(data.data.lieu_naiss);
                         $('#date_naiss_update').val(data.data.date_naiss);
                         $('#num_telephone_update').val(data.data.num_telephone);
                         $('#email_update').val(data.data.email);
                         $('#adresse_update').val(data.data.adresse);
                         $('#sexe_update').val(data.data.sexe);
                         $('#role_update').val(data.data.role);
                        //  $('#branche_update').val(data.data.branche);
                         $('#direction_id_update').val(data.data.direction_id);
                        //  $('#position_update').val(data.data.position);
                         $('#fonction_update').val(data.data.fonction);
                        //  $('#_update').val(data.data.exp_pro);
                         $('#echelle_update').val(data.data.echelle);
                         $('#echelon_update').val(data.data.echelon);
                         $('#type_contrat_update').val(data.data.type_contrat);
                         $('#date_recrutement_update').val(data.data.date_recrutement);
                         $('#debut_contrat_update').val(data.data.debut_contrat);
                         $('#fin_contrat_update').val(data.data.fin_contrat);
                         $('#num_securite_social_update').val(data.data.num_securite_social);
                         $('#num_compte_update').val(data.data.num_compte);
                         $('#situation_familiale_update').val(data.data.situation_familiale);
                         $('#situation_conjoint_update').val(data.data.situation_conjoint);
                         $('#nbr_enfant_update').val(data.data.nbr_enfant);
                         $('#experience_pro_update').val(data.data.experience_pro);
                         $('#position_update').val(data.data.position);
                         $('#base_update').val(data.data.base);

                  
                                  $('.branche').append(''+
                                '<option value="'+data.branche.id+'" hidden>'+data.branche.nom_branche+'</option>'
                                  );
                             
                            
                            }
                         
                

                    
                        
                     
                 });
     
             $('#form-edit').submit(function(e){
                 e.preventDefault();
                 var formData =  new FormData(this);
     
                 $.ajax({
                     url:"{{route('admin.branche.update')}}",
                     type:'POST',
                     data:formData,
                     processData: false,
                     contentType: false,
                     cache: false,
                     enctype: 'multipart/form-data',
                     success:function(data){
                         window.location = "/branches";
                     },
                     error:function(respone){
                         
                     }
                 })
             })
     
         });
        </script>
  @stop




@stop