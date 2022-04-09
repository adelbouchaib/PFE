@extends('admin.master')
@section('title')
All Users
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">All Users</h4>
 </div>

 <div class="modal fade in" id="modalEditUser">
    <div class="modal-dialog">
      <div class="modal-content">
      
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

                        <select name="basic" id="ex-basicc">
                            <option value="" disabled hidden>Select value</option>
                            <option value="1">Nice</option>
                            <option value="2">Very nice</option>
                            <option value="3">Awesome</option>
                            <option value="4">Godlike</option>
                        </select>

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

                                <form type="get" action="{{ url('/paiement/historique/display') }}">

                                    <input type="hidden" value="{{ $user->id }}" name="id" id="id" class="form-control">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                        
                                </form>          
                            </td>
                        </tr>
                        @endforeach

                        @foreach($paiements as $paiement)
                        {{$paiement->image}}<img src="{{ asset('images/'. $paiement->image) }}">

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>



<!-- The Modal -->


  
  

<!-- The Modal -->





@section('script')
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />

<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

    <script>
                    $('#ex-basic').picker({
                        search:true
                    });
                    $('#ex-basicc').picker({
                        search:true
                    });


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
              });

               $('#form-edit').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);
                    
                        $.ajax({
                        url:"{{route('admin.paiement.display')}}",
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