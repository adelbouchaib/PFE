@extends('admin.master')
@section('title')
All Users
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">All Users</h4>
 </div>
<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table mb-0">
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

                        
                        <form type="get" action="{{ url('/search') }}">
                            <input name="data" type="search"> 
                            <select name="query">
                                <option value="" style="display: none;">First Name</option>
                                @foreach ($allusers as $user)
                                <option   value="{{ $user->first_name }}"> {{ $user->first_name }} </option>
                                @endforeach
                            </select>
                            <button type="submit"> Search </button>
                        </form>

                        {{-- <select class="form-control" id="ex-basic">
                                
                                @foreach ($allusers as $user)
                                <option   value="{{ $user->role }}"> {{ $user->role }} </option>
                                @endforeach
                            
                        </select> --}}



                        @foreach($filterusers as $user)
                        <tr>
                            <th><img src="{{asset('/assets/uploads/profiles/')}}/{{$user->profile}}" alt="" style="width: 30px;"></th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{date('d-m-Y', strtotime($user->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($user->end_date))}}</td>
                            <td>

                                <a href="#" user-id="{{$user->id}}" title="Edit" class="btn btn-primary btn-edit-user"><i class="fa-solid fa-upload"></i></a>
          
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
                <input type="date" id="date_debut" name="date_debut" />
                <span id="errorDateDebut" class="text-red"></span>
                <input type="date" id="date_fin" name="date_fin" />
                <span id="errorDateFin" class="text-red"></span>
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
  

<!-- The Modal -->





@section('script')
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />

<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#ex-basic').picker({search : true});
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });

          
              $('.btn-edit-user').click(function(){
                $('#modalEditUser').modal('show');

                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);
              });

               $('#form-edit').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);
                    
                        $.ajax({
                        url:"{{route('admin.paiement.store')}}",
                        type:'POST',
                        data:formData,
                        contentType: false,
                        processData: false,
                        enctype: 'multipart/form-data',
                        success:function(data){
                            console.log('success updated');
                        },
                        error:function(respone){
                            $('#errorDateFin').text(respone.responseJSON.errors.date_fin);
                            $('#errorDateDebut').text(respone.responseJSON.errors.date_debut);
                        }
                    });
                    
                   
                });
            
            


           
        });
    </script>



@stop
@stop