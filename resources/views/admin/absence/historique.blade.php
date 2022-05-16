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
                    <form type="get" action="{{ url('/absences/historique/search') }}">
                        <div class="modal-body">
                        <input type="date" style="width:auto; display:inline;" class="form-control"  name="date" id="date" />
                        <button type="submit" class="btn btn-secondary btn-sm"> Rechercher </button>
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
                                    <td><span class="badge bg-success bg-opacity-20 text-success" style="min-width: 60px;">Justifiée</span></td>
                                    @if ($presence->etat == 0)
                                    <td><span class="badge bg-warning bg-opacity-20 text-warning" style="min-width: 60px;">En attente</span></td>
                                    @elseif($presence->etat == 1)
                                    <td><span class="badge bg-success bg-opacity-20 text-success" style="min-width: 60px;">Accepté</span></td>
                                    @elseif($presence->etat == 2)
                                    <td><span class="badge bg-danger bg-opacity-20 text-danger" style="min-width: 60px;">Refusé</span></td>
                                    @endif
                                    @else
                                    <td><span class="badge bg-danger bg-opacity-20 text-danger" style="min-width: 60px;">Non justifiée</span></td>
                                    @endif

                                   
                                    @if ($presence->presence_id != $presence->id)
                                    @can('create', \App\Absence::class)
                                        @if ($today->lte($presence->created_at->addDays(3)) )
                                        <td> </td>
                                        <td>
                                        <button type="submit" id="{{ $presence->id }}" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a>
                                        </td>
                                        @else
                                        <td>délai dépassé </td>
                                        @endif
                                    @endcan
                                    @else
                                    @if ($presence->etat == 0)
                                    <td>
                                    <button type="submit" id2="{{ $presence->id }}" class="btn btn-warning btn-edit-user"><i class="fa-solid fa-pencil"></i></a></button>
                                    </td>
                                    @endif
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
            <input type="hidden" name="presence_id_update" id="presence_id_update" class="form-control">

           
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


        var id = $(this).attr('id');
        var presence_id = $('#presence_id').val(id);

        $('#modalCreateUser').modal('show');
     
        $('#form-signup').submit(function(e){
            e.preventDefault();
            var formData =  new FormData(this);


            $.ajax({
                url:"{{route('admin.absencesjustifiees.create')}}",
                type:'POST',
                data:formData,
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
                $('.modall-body').html("");

                var id2 = $(this).attr('id2');
                var presence_id_update = $('#presence_id_update').val(id2);
               
                $.ajax({
                    url:"{{route('admin.absencesjustifiees.edit')}}",
                        type:'POST',
                        data:{
                            presence_id_update:id2,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#motif_update').val(data.data.motif);
                            // $('#image_update').val(data.data.justification);

                            if (data.user == 1){
                                $('.modall-body').append(
                                        '<a href="/images/'+data.data.justification+'" download>Download</a>\
                                        <input type="file" class="fileimage" id="image_update"  name="image_update" />'
                                    )
                            }
                                else{
                                    $('.modall-body').append(
                                    '<a href="/images/'+data.data.justification+'" download>Download</a>\
                                    <label>Type d\'absence</label>\
                                    <select name="etat_update" class="form-control" id="etat_update" >\
                                    <option value="" hidden>Séléctionner l\'etat</option>\
                                    <option value="1">Accepté</option>\
                                    <option value="2">Refusé</option>'
                                      )   
                                }


                        },
                    });


                $('#form-edit').submit(function(e){
                   
                    e.preventDefault();
                    var formData =  new FormData(this);
                    console.log($('#image_update').val());
                    $.ajax({
                        url:"{{route('admin.absencesjustifiees.update')}}",
                        type:'POST',
                        data:formData,
                        // data:{
                        //     presence_id_update:id2,
                        //     motif:$('#motif_update').val(),
                        // },
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
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