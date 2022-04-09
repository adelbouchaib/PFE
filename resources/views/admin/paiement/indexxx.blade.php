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
                        {{-- <input type="month" id="datee" name="datee" value="<?=date('Y-m')?>"/> --}}
                        {{-- <input type="date" id="datee" name="datee" />  --}}

                        <input type="date" id="datee_debut" name="datee_debut" />
                        <input type="date" id="datee_fin" name="datee_fin" />
                        @foreach($users as $user)
                        <tr>
                            <th><img src="{{asset('/assets/uploads/profiles/')}}/{{$user->profile}}" alt="" style="width: 30px;"></th>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{date('d-m-Y', strtotime($user->start_date))}}</td>
                            <td>{{date('d-m-Y', strtotime($user->end_date))}}</td>
                            <td>
                                {{-- @foreach($paiements as $paiement)
                                @if($paiement->user_id != $user->id)  --}}
                                <form method="POST"   action="/paiement/store" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <input type="hidden" id="date_debut" name="date_debut">
                                    <input type="hidden" id="date_fin" name="date_fin">

                                    {{-- <input type="file"   id="actual-btn" name="image" onchange="this.form.submit()" hidden/>
                                    <label class="btn btn-primary" for="actual-btn"><i class="fa-solid fa-upload"></i></label> --}}
                                    <input style="float:left; width:88px; **color:#000000;**" type="file" class="fileimage"  name="image" onchange="this.form.submit()" > 
                                    
                                   
                                </form> 
                                {{-- @endif
                                @endforeach --}}
                                
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
    $('#datee_debut').keyup(function(){
        $('#date_debut').val($('#datee_debut').val());
    });
});

$(document).ready(function(){
    $('#datee_fin').keyup(function(){
        $('#date_fin').val($('#datee_fin').val());
    });
});



    </script>


 

@stop
@stop