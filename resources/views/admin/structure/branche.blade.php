@extends('admin.master')
@section('title')
Branches
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Branches</h4>
 </div>

 <div class="container">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nouvelle Branche</h4>
                                        </div>

                               

                                    <form method="post" accept-charset="utf-8" action="{{ url('/branches/save') }}">
                                        @csrf
                                        <div class="modal-body">

                                        <label for="title">Nom de la branche:</label>
                                        <div class="form-group">
                                            <input type="text" name="nom_branche" id="nom_branche" class="form-control">
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
                            {{-- <form type="get" action="{{ route('admin.paiement.search') }}">
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="form-group test">
                                    <select name="id" class="form-control" id="ex-basic">
                                        @foreach ($allusers as $user)
                                        <option   value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                                        @endforeach
                                    </select>
                                    </div> 

                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                     </div>

        
                                </div>
                        
                                </form> --}}


                                
                                
                            <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col" style="width:200px">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($branches as $branche)
                                <tr>
                                <td scope="row">{{ $branche->id }}</td>
                                <td>{{ $branche->nom_branche }}</td>
                                    <td>
                                        <a href="#" branche-id="{{ $branche->id }}" class="btn btn-warning btn-edit-branche">
                                            <i class="fa-solid fa-pencil"></i></a>
                                            <form method="post" action="{{ url('/branches/delete') }}" style="display: inline" accept-charset="utf-8">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $branche->id }}">
                                            <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
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


 
<div class="modal fade in" id="modalEditBranche">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <form method="post" accept-charset="utf-8" id="form-edit"> 
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modifier la branche</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

                <div class="modal-body">
    
                <input type="hidden" name="id_update" id="id_update" class="form-control">

                <div class="form-group">
                    <label for="title">Nom:</label><br>
                    <input type="text" name="nom_branche_update" id="nom_branche_update" class="form-control">
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
    
    $('.btn-edit-branche').click(function(){
        $('#modalEditBranche').modal('show');

        var brancheID = $(this).attr('branche-id');
        var id = $('#id').val(brancheID);

      console.log(brancheID);
            $.ajax({
                url:"{{route('admin.branche.edit')}}",
                type:'POST',
                data:{
                    id:brancheID,
                },
                success:function(data){
                    console.log('success edit');
                    $('#id_update').val(brancheID);
                    $('#nom_branche_update').val(data.data.nom_branche);


                   
                }
            });
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