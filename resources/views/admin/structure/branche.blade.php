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

                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($branches as $branche)
                                <tr>
                                <th scope="row">{{ $branche->id }}</th>
                                <th>{{ $branche->nom_branche }}</th>

                    
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



@stop
@stop