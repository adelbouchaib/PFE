@extends('admin.master')
@section('title')
All Users
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">All Users</h4>
    <a href="#" title="" style="float:right" class="btn btn-primary btn-add-user"><i class="fa-solid fa-plus"></i></a>
 </div>

 <form type="get" action="{{ url('/conge/recherche') }}">
    <select name="data" class="form-control"  id="ex-basic">
        <option value="" hidden>Etat</option>
        <option value="1">Accepté</option>
        <option value="2">Refusé</option>
    </select>
    <button type="submit"> Search </button>
</form>

<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($conges as $conge)
                        <tr>
                            <td>{{$conge->first_name}}</td>
                            <td>{{$conge->last_name}}</td>
                            <td>{{$conge->duree}}</td>
                            <td>{{$conge->etat}}</td>
                            <td>{{date('d-m-Y', strtotime($conge->date_sortie))}}</td>
                            <td>{{date('d-m-Y', strtotime($conge->date_entree))}}</td>
                            <td>
                                <a href="#" user-id="{{$conge->id}}" title="Edit" class="btn btn-primary btn-edit-user"><i class="fa-solid fa-pencil"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<!-- The Modal -->
<div class="modal fade in" id="modalEditUser">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post" accept-charset="utf-8" id="form-edit">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
      <input type="hidden" name="id" id="id" class="form-control">
        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
              <label for="date_sortie">Date Sortie</label>
              <input type="date" name="date_sortie" id="date_sortie_update" class="form-control">
              <span id="errorFirstName" class="text-red"></span>
          </div>
          <div class="form-group">
            <label for="date_entree">Date Sortie</label>
            <input type="date" name="date_entree" id="date_entree_update" class="form-control">
            <span id="errorFirstName" class="text-red"></span>
        </div>
        <div class="form-group">
            <label for="duree">Date Sortie</label>
            <input type="number" name="duree" id="duree_update" class="form-control">
            <span id="errorFirstName" class="text-red"></span>
        </div>
          <div class="form-group">
              <label for="password">Etat</label>
              <select class="form-control" id="etat_update" name="etat">
                  <option value="" style="display: none;">Select Etat</option>
                  <option value="0">En attente</option>
                  <option value="1">Accepté</option>
                  <option value="2">Refusé</option>
              </select>
              <span id="errorRole" class="text-red"></span>
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
           

              $('.btn-edit-user').click(function(){
                $('#modalEditUser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);
                    $.ajax({
                        url:"{{route('admin.conge.edit')}}",
                        type:'POST',
                        data:{
                            id:userID,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#date_sortie_update').val(data.data.date_sortie);
                            $('#date_entree_update').val(data.data.date_entree);
                            $('#duree_update').val(data.data.duree);
                            $('#etat_update').val(data.data.etat);
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
                    });

               $('#form-edit').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);
                    $.ajax({
                        url:"{{route('admin.conge.update')}}",
                        type:'POST',
                        data:formData,
                        data:{
                            id:userID,
                            date_sortie:$('#date_sortie_update').val(),
                            date_entree:$('#date_entree_update').val(),
                            duree:$('#duree_update').val(),
                            etat:$('#etat_update').val(),
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
            })


            $('.btn-delete-user').click(function(){
                $('#modalDeleteUser').modal('show');
                var usreID = $(this).attr('user-id');
                var id = $('#id_delete').val(usreID);
                $('#form-delete').submit(function(e){
                    e.preventDefault();
                    // var formData =  new FormData(this);
                    $.ajax({
                        url:"{{route('admin.users.delete')}}",
                        type:"POST",
                        data:{
                            id:usreID,
                        },
                        dataType:"JSON",
                        success:function(data){
                            location.reload();
                        },
                        error:function(respone){
                           console.log('success Fail');
                        }
                    })
                })
            })
        })
    </script>
@stop
@stop