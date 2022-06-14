@extends('admin.master')
@section('title')
Directions
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Directions</h4>
 </div>

 <div class="container">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nouvelle Direction</h4>
                                        </div>

                               

                                    <form method="post" accept-charset="utf-8" action="{{ url('/directions/store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Abréviation (3 lettres)</label><br>
                                                <input type="text" name="abrv" id="abrv" class="form-control">
                                            </div> 
                                        <div class="form-group">
                                            <label for="title">Nom:</label><br>
                                            <input type="text" name="nom_direction" id="nom_direction" class="form-control">
                                        </div> 

                                        <div class="form-group"> 
                                            <label for="title">Sélectionner la branche:</label><br>
                                            <select name="branche_id" class="form-control"  id="ex-basicc">
                                                @foreach ($branches as $branche)
                                                <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        </div>
                                        
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                        </form>

                    </div>
                </div>

            </div>

            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                           

                        <table class="table table-bordered mb-0">
 
                            <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Branche</th>
                            <th scope="col">Abréviation</th>
                            <th scope="col">Nom</th>
                            <th scope="col" style="width:120px">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($directions as $direction)
                                <tr>
                                <td scope="row">{{ $direction->id }}</td>
                                <td> {{ $direction->nom_branche }} </td>
                                <td> {{ $direction->abrv }} </td>
                                <td> {{ $direction->nom_direction }} </td>
                                <td>

                                    <a href="#" direction-id="{{ $direction->id }}" class="btn btn-warning btn-edit-direction">
                                        <i class="fa-solid fa-pencil"></i></a>

                                        <form method="post" action="{{ url('/directions/delete') }}" style="display: inline" accept-charset="utf-8">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $direction->id }}">
                                            <button class="btn btn-danger btn-delete-user"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>    
                                   

                                </td>

                                </tr>
                                @endforeach
    
                            

                            </tbody>
                            </table>

    
    
                    </div>
                </div>
    
            </div>
    
  </div>
</div>


   
<div class="modal fade in" id="modalEditDirection">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <form method="post" accept-charset="utf-8" id="form-edit"> 
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modifier la direction</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

                <div class="modal-body">
    
                <input type="hidden" name="id_update" id="id_update" class="form-control">
                <div class="form-group">
                        <label for="title">Abréviation (3 lettres)</label><br>
                        <input type="text" name="abrv_update" id="abrv_update" class="form-control">
                 </div> 
                <div class="form-group">
                    <label for="title">Nom:</label><br>
                    <input type="text" name="nom_direction_update" id="nom_direction_update" class="form-control">
                </div> 

                <div class="form-group"> 
                    <label for="title">Sélectionner la branche:</label><br>
                    <select name="branche_id_update" class="form-control">
                        @foreach ($branches as $branche)
                        <option   value="{{ $branche->id }}"> {{ $branche->nom_branche }} </option>
                        @endforeach
                    </select>
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
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

    <script>
           $('#ex-basic').picker({search : true});
            $('#ex-basicc').picker({search : true});


            
        $(document).ready(function(){
   

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
            
            $('.btn-edit-direction').click(function(){
                $('#modalEditDirection').modal('show');

                var directionID = $(this).attr('direction-id');
                var id = $('#id').val(directionID);

              console.log(directionID);
                    $.ajax({
                        url:"{{route('admin.direction.edit')}}",
                        type:'POST',
                        data:{
                            id:directionID,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#id_update').val(directionID);
                            $('#nom_direction_update').val(data.data.nom_direction);
                            $('#abrv_update').val(data.data.abrv);
                            $('#branche_id_update').val(data.data.branche_id);

                           
                        }
                    });
                });

                $('#form-edit').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);

                    $.ajax({
                        url:"{{route('admin.direction.update')}}",
                        type:'POST',
                        data:formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',
                        success:function(){
                            window.location = "/directions";

                        },
                        error:function(respone){
                            
                        }
                    })
                })

            });



    </script>

@stop
@stop