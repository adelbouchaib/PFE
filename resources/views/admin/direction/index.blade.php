@extends('admin.master')
@section('title')
All Users
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">All Users</h4>
 </div>

 <div class="container">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">New Paye</h4>
                                        </div>

                               

                                    <form method="post" accept-charset="utf-8" action="{{ url('/direction/store') }}">
                                        @csrf
                                        <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title">
                                        </div> 

                                        <div class="form-group"> 
                                            <select name="user_id" class="form-control"  id="ex-basic">
                                                <option value="" hidden>Chef</option>
                                                @foreach ($allusers as $user)
                                                <option   value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                                                @endforeach
                                            </select>
                                             </div>

                                        
                                        </div>
                                        
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
                            <th scope="col">Title</th>
                            <th scope="col">Chef</th>

                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($directions as $direction)
                                <tr>
                                <th scope="row">{{ $direction->id }}</th>
                    
    
                                <td>{{ $direction->title }}</td>
                                <td>{{ $direction->first_name }} {{ $direction->last_name }}</td>

                                </tr>
                                @endforeach
    
                            

                            </tbody>
                            </table>

    
    
                    </div>
                </div>
    
            </div>
    
  </div>
</div>




@section('script')
<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

<link href="{{asset('/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>



    <script>

        $(document).ready(function(){

            $('#ex-basic').picker({search : true});
  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });

            

     
           
    
        
               $('#form-editt').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);
                    console.log(formData.title);
                    console.log(formData.user_id);
                    
                        $.ajax({
                        url:"{{route('admin.direction.store')}}",
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