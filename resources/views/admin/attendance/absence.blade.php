@extends('admin.master')
@section('title')
Présence
@stop
@section('content')


 <div class="title-bar">
    <h4 style="float:left">Absences</h4>
    @can('create', \App\Absence::class)
   <a href="#" title="" style="float:right" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a> 
   @endcan
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

            <div class="form-group">
                <label>Type d'absence</label>
                <select name="type" class="form-control" id="var1" >
                    @foreach($types as $type)
                     <option   value="{{ $type->id }}"> {{ $type->titre }} </option>
                    @endforeach
                </select>
                </div>

            <div class="form-group">
                <label for="first_name">Motif</label>
                <textarea name="motif" id="motif" class="form-control"> </textarea>
                <span id="errorFirstName" class="text-red"></span>
            </div>
            

         <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" name="start" id="start" class="form-control">
            <span id="errorStartDate" class="text-red"></span>
        </div>

        <div class="form-group">
            <label for="start_date">End Date</label>
            <input type="date" name="finish" id="finish" class="form-control">
            <span id="errorStartDate" class="text-red"></span>
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
  

            <div class="contentt-body">
                
            </div>

            
                <label>Type d'absence</label>
                <select name="typee" class="form-control" id="var11" >

                </select>
                    
                

         <div class="modall-body">
                
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




 
<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <form type="get" action="{{ url('/absences/search') }}">
                        <div class="modal-body">
                        <input type="date" style="width:auto; display:inline;" class="form-control"  name="date" id="date" />
                                            
                            <select name="etat" style="width:auto; display:inline;" class="form-control"  id="ex-basic">
                            <option value="" hidden>Selectionner l'etat</option> 
                            <option value="0">En attente</option> 
                            <option value="1">Accepté</option>
                            <option value="2">Refusé</option>
                            </select>

                        <button type="submit" class="btn btn-secondary btn-sm"> Rechercher </button>
                        </div>
                    </form>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Matricule</th>
                            <th>Nom Complet</th>
                            <th>Date Création</th>
                            <th>Debut</th>
                            <th>Fin</th>
                            <th>Etat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($absences as $absence)
                                <tr>
                                    <td>{{ $absence->id }}</td>
                                    <td>{{$absence->matricule}} </td>
                                    <td>{{$absence->first_name}} {{$absence->last_name}}</td>
                                    <td>{{$absence->created_at->format('Y-m-d')}}</td>
                                    <td>{{$absence->start}}</td>
                                    <td>{{$absence->finish}}</td>

                                   
                                    @if( $absence->modifie == 1)                       

                                        <td><span class="badge bg-danger bg-opacity-20 text-danger" style="min-width: 60px;">Modifié</span></td>
 
                                    @else
                                

                                    @switch($absence->etat)
                                        @case(0)
                                        <td><span class="badge bg-warning bg-opacity-20 text-warning" style="min-width: 60px;">En attente</span></td>
                                        @break
                                        @case(1)
                                        <td><span class="badge bg-success bg-opacity-20 text-success" style="min-width: 60px;">Accepté</span></td>
                                        @break
                                        @default
                                       <td><span class="badge bg-danger bg-opacity-20 text-danger" style="min-width: 60px;">Refusé</span></td>
                                     @endswitch
                                    
                                   
                                    
                                    @endif

                                  
                                   

                                    
                                    <td>
                                        <button type="submit" id="{{ $absence->id }}" class="btn btn-warning btn-edit-user"><i class="fa-solid fa-pencil"></i></a>
                                    </td>
                                </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
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
       $('#modalCreateUser').modal('show');
    
       $('#form-signup').submit(function(e){
           e.preventDefault();
           var formData =  new FormData(this);

           $.ajax({
               url:"{{route('admin.absences.create')}}",
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
                $('#var11').html("");

                var userID = $(this).attr('id');

                console.log(userID);
               
                $.ajax({
                    type:"get",
                    url:"/absences/display2",
                    dataType: "json",
                    
                    
                    data:{
                            id:userID,
                    },
                    cache: false,
                    
                    success: function(response){
                     
                        $.each(response.filterusers,function(key,item){


                    $.each(response.types,function(key,itemm){
                        if(itemm.id == item.type_id)
                        {
                            $('#var11').append('<option value="'+itemm.id+'" hidden>'+itemm.titre+'</option>' );
                        }
                        
                    });

                        
                    $.each(response.types,function(key,item){
                        $('#var11').append( '<option value="'+item.id+'">'+item.titre+'</option>' );
                    });

                    $('.modall-body').append(
                    '<label for="first_name"> Motif </label>\
                              <input type="text" value="'+item.motif+'" name="motiff" id="motiff" class="form-control">\
                              <label for="start_date">Start Date</label>\
                                  <input type="date"  value="'+item.start+'"name="startt" id="startt" class="form-control">\
                                  <span id="errorStartDate" class="text-red"></span>\
                                  <label for="start_date">End Date</label>\
                                  <input type="date"  value="'+item.finish+'" name="finishh" id="finishh" class="form-control">\
                                  <span id="errorStartDate" class="text-red"></span>'
                    );

                 

                    $.each(response.users,function(key,itemmm){
                                  
                                    if(itemmm.role == '0')
                                  {
                            
                            $('.modall-body').append(
                                  '<label for="password">Etat</label>\
                                  <select  class="form-select form-select-lg" id="etatt" name="etatt">\
                                      @if('+item.etat+' == 1)\
                                      <option value="'+item.etat+'" style="display: none;">En attente</option>\
                                      @elseif( '+item.etat+' == 1)\
                                      <option value="'+item.etat+'" style="display: none;">Accepté</option>\
                                      @else\
                                      <option value="'+item.etat+'" style="display: none;">Refusé</option>\
                                      <option value="0">En attente</option>\
                                      <option value="1">Accepté</option>\
                                      <option value="2">Refusé</option>\
                                        @endif\
                                  </select>'
                                  )
                                
                            }
                            else{
                                if(item.modifie == '1')
                                {
                                    $('.modall-body').append(
                                  '<label for="password">Etat de modification</label>\
                                  <select  class="form-select form-select-lg" id="modifiee" name="modifiee">\
                                      <option value="0">Accepté</option>\
                                      <option value="1">Refusé</option>\
                                  </select>'
                                  )
                                }

                            }
                        }
                        
                        
                        );

                                  $('.modall-body').append(
                                  '<span id="errorRole" class="text-red"></span>\
                              <img style="width="250px" height="250px"" src="/images/' + item.justification + '">'
                              
                              )
                              
                            
                      });
                      
                    },
                    
                    error:function(respone){
                    }

                })

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