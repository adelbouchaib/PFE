@extends('admin.master')
@section('title')
Absences
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Absences</h4>
    {{-- @can('index', \App\Dashboard::class)
    <a href="#" title="" style="float:right" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a>
    @endcan    --}}
</div>
<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <form type="get" action="{{ url('/absences/search') }}">
                        <div class="modal-body">
                        {{-- <input type="date" style="width:auto; display:inline;" class="form-control"  name="date" id="date" />
                        <button type="submit" class="btn btn-secondary btn-sm"> Rechercher </button> --}}
                        </div>
                    </form>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Matricule</th>
                            <th>Nom complet</th>
                            <th>Start time</th>
                            <th>Justification</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($presences as $presence)
                                <tr>
                                    <td>{{$presence->date}}</td>
                                    <td>{{$presence->matricule}}</td>
                                    <td>{{$presence->prenom}} {{$presence->nom}}</td>
                                    <td>{{$presence->start_time}}</td>

                                    @if ($presence->presence_id == $presence->id)
                                    <td> Justifiée </td>
                                    @if ($presence->etat == 0)
                                    <td> En attente </td>
                                    @elseif($presence->etat == 1)
                                    <td> Accepté </td>
                                    @elseif($presence->etat == 2)
                                    <td> Refusé </td>
                                    @endif
                                    @else
                                    <td> Non justifiée </td>
                                    
                                    @endif

                                   
                                    @if ($presence->presence_id != $presence->id)
                                    @can('create', \App\Absence::class)
                                        @if ($today->lte($presence->created_at->addDays(3)) )
                                        <td> </td>
                                        <td>
                                        <button type="submit" idd="{{ $presence->id }}"  datee="{{ $presence->date }}" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a>
                                        </td>
                                        @else
                                        <td>délai dépassé </td>
                                        @endif
                                    @endcan
                                    @else
                                    <td>
                                    <button type="submit" idd="{{ $presence->id }}" class="btn btn-warning btn-edit-user"><i class="fa-solid fa-pencil"></i></a></button>
                                    </td>
                                    @endif
                                    
                                    
                              
                                    
                                </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="modal fade in" id="modalCreateUser">
    <div class="modal-dialog">
      <div class="modal-content">
  
  
      <form method="post" accept-charset="utf-8" id="form-signup">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Demande d'absence</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <input type="hidden" name="date" id="date" class="form-control">
            <input type="hidden" name="presence_id" id="presence_id" class="form-control">


            <div class="form-group">
                <label for="first_name">Motif</label>
                <textarea name="motif" id="motif" class="form-control"> </textarea>
                <span id="errorFirstName" class="text-red"></span>
            </div>
            

        <div class="form-group">
                                                
            <input type="file" class="fileimage" id="image"  name="image" /> 
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
            <input type="hidden" name="presence_id" id="presence_id" class="form-control">

           
            <div class="form-group">
                <label for="first_name">Motif</label>
                <textarea name="motif_update" id="motif_update" class="form-control"> </textarea>
                <span id="errorFirstName" class="text-red"></span>
            </div>
            

        <div class="form-group">
            <div class="modall-body">

            </div>
            
        </div>
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


$(document).ready(function(){


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
 
    });
    $('.btn-add-user').click(function(){

        var date_update = $(this).attr('datee');
        var date = $('#date').val(date_update);

        var presence_id_update = $(this).attr('idd');
        var presence_id = $('#presence_id').val(presence_id_update);


        console.log(presence_id_update);

        $('#modalCreateUser').modal('show');
     
        $('#form-signup').submit(function(e){
            e.preventDefault();
            var formData =  new FormData(this);
 
            formData.date = date_update;
            formData.presence_id = presence_id_update;

            $.ajax({
                url:"{{route('admin.absences.create2')}}",
                type:'POST',
                data:formData,
                date:{
                    date:date_update,
                    presence_id:presence_id_update,
                    motif:$('#motif').val(),
                    image:$('#image').val(),
                },
                processData: false,
                contentType: false,
                cache: false,
                enctype: 'multipart/form-data',
                success:function(data){
                    console.log('success create');
                },
                error:function(respone){
                    $('#errorFirstName').text(respone.responseJSON.errors.first_name);
                    $('#errorLastName').text(respone.responseJSON.errors.last_name);
                    $('#errorEmail').text(respone.responseJSON.errors.email);
                    $('#errorPassword').text(respone.responseJSON.errors.password);
                    $('#errorRole').text(respone.responseJSON.errors.role);
                    $('#errorStartDate').text(respone.responseJSON.errors.start_date);
                    $('#errorEndDate').text(respone.responseJSON.errors.end_date);
                }
            })
        })
    })

    
   $('.btn-edit-user').click(function fetchstudents(){
                // function fetchstudents(e){
                //     e.preventDefault();
              
                $('#modalEditUser').modal('show');


                var presence_id_update = $(this).attr('idd');
                var presence_id = $('#presence_id').val(presence_id_update);

                console.log(presence_id_update);

                var image_update =       $('#image_update').val();            


                $('.modall-body').append(
                   ' <a href="/images/' +image_update+'" download>Download</a>'
               );

               
                $.ajax({
                    url:"{{route('admin.absences.edit')}}",
                        type:'POST',
                        data:{
                            presence_id:presence_id_update,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#motif_update').val(data.data.motif);
                            $('#image_update').val(data.data.image);

                        },
                    });


                $('#form-edit').submit(function(e){
                    e.preventDefault();
                    console.log($('#motiff').val());
                    var formData =  new FormData(this);
                    $.ajax({
                        url:"{{route('admin.absences.update')}}",
                        type:'POST',
                        data:formData,
                        data:{
                            id:userID,
                            motif:$('#motiff').val(),
                            type:$('#var11').val(),
                            finish:$('#finishh').val(),
                            start:$('#startt').val(),
                            etat:$('#etatt').val(),
                            modifie:$('#modifiee').val(),
                        },
                        success:function(data){
                            console.log('success updated');
                        },
                        error:function(respone){
                            $('#errorFirstName').text(respone.responseJSON.errors.first_name);
                            $('#errorLastName').text(respone.responseJSON.errors.last_name);
                            $('#errorEmail').text(respone.responseJSON.errors.email);
                            $('#errorPassword').text(respone.responseJSON.errors.password);
                            $('#errorRole').text(respone.responseJSON.errors.role);
                            $('#errorStartDate').text(respone.responseJSON.errors.start_date);
                            $('#errorEndDate').text(respone.responseJSON.errors.end_date);
                        }
                    })
                })
        


            
            });


});
 
   </script>
@stop
@stop