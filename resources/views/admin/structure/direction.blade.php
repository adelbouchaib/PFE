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

                                        <div class="form-group"> 
                                            <label for="title">Sélectionner le chef:</label><br>
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
                            <th scope="col">Title</th>
                            <th scope="col">Chef</th>

                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($directions as $direction)
                                <tr>
                                <th scope="row">{{ $direction->id }}</th>
                                <td>{{ $direction->nom_branche }}</td>
                                <td>{{ $direction->nom_direction }}</td>
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

    <script>
           $('#ex-basic').picker({search : true});
            $('#ex-basicc').picker({search : true});
    </script>

@stop
@stop