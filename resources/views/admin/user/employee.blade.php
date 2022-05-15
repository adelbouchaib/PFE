@extends('admin.master')
@section('title')
User
@stop
@section('content')
<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>{{$users2->first_name}}</td>
                            <td>{{$users2->last_name}}</td>
                            <td>{{$users2->email}}</td>
                            <td>{{date('d-m-Y', strtotime($users2->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($users2->end_date))}}</td>
                        </tr>
                     
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div id="responsiveTables" class="mb-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($presences as $presence)
                                <tr>
                                    <td>{{date('d-m-Y', strtotime($presence->date))}}</td>
                                    <td>{{$presence->first_name}} {{$presence->last_name}}</td>
                                    <td>{{$presence->start_time}}</td>
                                    <td>{{$presence->end_time}}</td>
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
                        url:"{{route('admin.users.create')}}",
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


              $('.btn-edit-user').click(function(){
                $('#modalEditUser').modal('show');
                var userID = $(this).attr('user-id');
                var id = $('#id').val(userID);
                    $.ajax({
                        url:"{{route('admin.users.edit')}}",
                        type:'POST',
                        data:{
                            id:userID,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#first_name_update').val(data.data.first_name);
                            $('#last_name_update').val(data.data.last_name);
                            $('#email_update').val(data.data.email);
                            $('#role_update').val(data.data.role);
                            $('#start_date_update').val(data.data.start_date);
                            $('#end_date_update').val(data.data.end_date);
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
                        url:"{{route('admin.users.update')}}",
                        type:'POST',
                        data:formData,
                        data:{
                            id:userID,
                            first_name:$('#first_name_update').val(),
                            last_name:$('#last_name_update').val(),
                            email:$('#email_update').val(),
                            role:$('#role_update').val(),
                            start_date:$('#start_date_update').val(),
                            end_date:$('#end_date_update').val(),
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