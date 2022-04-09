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

                        
                        
                        <form type="get" action="{{ url('/paiement/historique/search') }}">
                            <input type="date"  name="date" id="date" />
                            <select name="data" class="form-control"  id="ex-basic">
                                <option value="" hidden>Full name</option>
                                @foreach ($allusers as $user)
                                <option   value="{{ $user->first_name }} {{ $user->last_name }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                                @endforeach
                            </select>
                            <button type="submit"> Search </button>
                        </form>



                        @foreach($filterusers as $user)
                        <tr>
                            <th><img src="{{asset('/assets/uploads/profiles/')}}/{{$user->profile}}" alt="" style="width: 30px;"></th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{date('d-m-Y', strtotime($user->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($user->end_date))}}</td>
                            <td>

                                <button type="submit" user-id="{{ $user->id }}" class="btn btn-primary btn-edit-user">Save</button>
                                        
                            </td>
                        </tr>
                        @endforeach

                       

                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade in" id="modalEditUser">
            <div class="modal-dialog modal-lg	">
              <div class="modal-content">
                    <!-- Modal Header -->
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <div class="modal-body">
                        
                    </div>
              </div>
            </div>
        </div>

    </div>
</div>





@section('script')
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />

<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

    <script>
        $('#ex-basic').picker({
            search:true
        });      

        $(document).ready(function(){ 
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('.btn-edit-user').click(function fetchstudents(){
                // function fetchstudents(e){
                //     e.preventDefault();
              
                $('#modalEditUser').modal('show');
                $('.modal-content').html("");

                var userID = $(this).attr('user-id');
               
                $.ajax({
                    type:"get",
                    url:"/paiement/historique/display2",
                    dataType: "json",
                    
                    
                    data:{
                            id:userID,
                    },
                    cache: false,
                    
                    success: function(response){
                       
                        $.each(response.filterusers,function(key,item){

                            $('.modal-content').append(
                                '<img src="/images/' + item.image + '">'
                                // " width="350px" height="300px"
                              );
                        });
                    },
                    
                    error:function(respone){
                    }

                })
            
            });



        });
    </script>



@stop
@stop