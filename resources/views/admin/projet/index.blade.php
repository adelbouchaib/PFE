@extends('admin.master')
@section('title')
Projets
@stop
@section('content')

    <div class="d-flex align-items-center mb-md-3 mb-2">
    <div class="flex-fill">
    <h1 class="page-header mb-0">
    Projets
    </h1>
    </div>
    <div class="ms-auto">
    <a href="#" data-bs-toggle="modal" class="btn btn-primary btn-add-user"><i class="fa fa-plus-circle me-1"></i> Ajouter un projet</a>
    </div>
    </div>
    

    <div class="modal fade in" id="modalCreateUser">
        <div class="modal-dialog">
          <div class="modal-content">
      
      
          <form method="post" accept-charset="utf-8" id="form-signup">
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Create User</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="first_name">Titre</label>
                    <input type="text" name="title" id="title" class="form-control">
                    <span id="errorFirstName" class="text-red"></span>
                </div>
                <div class="form-group">
                    <label for="first_name">Description</label>
                    <textarea name="description" id="description" class="form-control"> </textarea>
                    <span id="errorFirstName" class="text-red"></span>
                </div>


             <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start" id="start" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="finish" id="finish" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>

            
            <div class="form-group"> 
                <select name="chef" class="form-control"  id="ex-basicc">
                    <option value="" hidden>Full name</option>
                    @foreach ($allusers as $user)
                    <option   value="{{ $user->id }}"> {{ $user->matricule }} - {{ $user->prenom }} {{ $user->nom }} </option>
                    @endforeach
                </select>
                 </div>

             <div class="form-group" style="width:100%" > 
            <select name="data[]" class="form-control"  id="ex-basic" multiple>
                <option value="" hidden>Full name</option>
                @foreach ($allusers as $user)
                <option   value="{{ $user->id }}"> {{ $user->matricule }} - {{ $user->prenom }} {{ $user->nom }} </option>
                @endforeach
            </select>

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



      
    <div class="modal fade in" id="modalEditProjet">
        <div class="modal-dialog">
          <div class="modal-content">
      
      
            <form method="post" accept-charset="utf-8" id="form-edit"> 
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modifier le projet</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="id" id="id" class="form-control">
                <div class="form-group">
                    <label for="first_name">Title</label>
                    <input type="text" name="title" id="title_update" class="form-control">
                    <span id="errorFirstName" class="text-red"></span>
                </div>
                {{-- <div class="form-group">
                    <label for="first_name">Description</label>
                    <textarea name="description" id="description" class="form-control"> </textarea>
                    <span id="errorFirstName" class="text-red"></span>
                </div>


             <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start" id="start" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="finish" id="finish" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>

            
            <div class="form-group"> 
                <select name="chef" class="form-control"  id="ex-basicc">
                    <option value="" hidden>Full name</option>
                    @foreach ($allusers as $user)
                    <option   value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                    @endforeach
                </select>
                 </div>

             <div class="form-group"> 
            <select name="data[]" class="form-control"  id="ex-basic" multiple>
                <option value="" hidden>Full name</option>
                @foreach ($allusers as $user)
                <option   value="{{ $user->id }}"> {{ $user->first_name }} {{ $user->last_name }} </option>
                @endforeach
            </select>

             </div> --}}
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


            
      @php
      $i = 0;
      @endphp
       @php
       $t = 0;   
       @endphp
    
    <div class="row">
        @php
                               
                                $array = array($projetstodo,$projetsinprogress,$projetsdone);  
                               

                        

        @endphp
        
        @foreach ($array as $project)

       

        <div class="col-xl-4 col-lg-6">
            <div class="card mb-3">
            
                <div class="card-header d-flex align-items-center">
                    <span class="flex-grow-1 fw-600">


                       

                       @switch($t)
                       @case(0)
                       À faire
                       @break
                           @case(1)
                           En cours
                           @break
                           @case(2)
                           Fini
                           @break
                       @endswitch
                        
                          @php
                         $t++;   
                         @endphp
                                
                        ({{ $project->count() }})</span>
                        @if($t == 3)
                        <div><a href="{{ route('admin.projet.historique') }}" class="d-flex align-items-center text-decoration-none">View all <i class="fa fa-chevron-right ms-2 text-opacity-50"></i></a></div>
                        @endif
                    </div>
                @foreach ($project as $projet)
                <div class="list-group list-group-flush">
                <div class="list-group-item d-flex px-3">
                    <div class="me-3">
                    <i class="fa fa-code-branch text-muted fa-fw fa-lg"></i>
                    </div>
                    <div class="flex-fill">
                        <div class="fw-600">{{  $projet->title  }} 
        
                            <a href="#" projet-id="{{ $projet->id }}" data-bs-toggle="modal" style="float:right" class="text-muted text-decoration-none fs-12px me-3 btn-edit-projet">
                                <i class="fa fa-fw fa-edit"></i></a>
                        </div>
                        <div class="fs-13px text-muted mb-2">{{ $projet->prenom }} {{ $projet->nom }}</div>
                        <div> 
                            @php
                            $todayDate = \Carbon\Carbon::now()->format('Y-m-d'); 
                            $Date = \Carbon\Carbon::createFromFormat('Y-m-d', $todayDate);
                            $Date->subDays(7);
                            @endphp
                            @if($projet->status == 2)
                            {{ $projet->finish }}
                            @elseif( $projet->finish  > $todayDate )
                            <div style="
                           font-weight: bold;
                            color: white;
                            display: inline;
                            border-radius: 10px;
                            background-color: red;
                            padding: 5px 10px 5px 5px; 
                            ">
                            {{ $projet->finish }}
                            </div>
                            @elseif($projet->finish < $todayDate && $projet->finish > $Date)
                            <div style="
                            font-weight: bold;
                            color: white;
                            display: inline;
                            border-radius: 10px;
                            background-color: green;
                            padding: 5px 10px 5px 5px;
                            ">
                                {{ $projet->finish }}
                            </div>
                            @else
                            {{ $projet->finish }}
                            @endif
                         </div>
                        <hr class="mb-15px mt-15px" />
                        <div class="d-flex align-items-center mb-2">
                            <div class="fw-600 me-2">
                                @php
                                $j=0;
                                @endphp        
                        @foreach ($tasks as $task)
                        @if($task->projet_id == $projet->id)
                        @php
                        $j++;
                        @endphp
                        @endif
                        @endforeach
        
                        @php
                                $k=0;
                                @endphp        
                        @foreach ($tasksselected as $task)
                        @if($task->projet_id == $projet->id)
                        @php
                        $k++;
                        @endphp
                        @endif
                        @endforeach
        
                            Tâches ({{ $k }}/{{ $j }})
                            </div>
                            
                            <div class="flex-1">
                                <a href="#" class="text-muted" data-bs-toggle="collapse" data-bs-target="#todoBoard-{{ $i }}">
                                    <i class="fa fa-plus-circle"></i>
                            </a>
                            
                            </div>
                           
                            </div>
                            <div class="form-group mb-0 pb-1 fs-13px">
                                <div class="collapse hide" id="todoBoard-{{ $i }}">
                                   
                                        <form method="post" action="{{ url('/projet/task/create') }}" accept-charset="utf-8">
                                            @csrf
                                            <div style="display: flex">
                                        <input type="text" name="title" id="title" style="display:inline" class="form-control">
                                        <span id="errorFirstName" class="text-red"></span>
                                        <input type="hidden" value="{{ $projet->id }}" name="projet_id">
                                        <button type="submit" style="display:inline; margin-left:5px;" class="btn btn-primary btn-sm">Ajouter</button>
                                    </div>
                                        </form>
                                    
                                    @php
                $i++;
                @endphp
        
        
                        <div class="form-check mb-2px">
                           
                            @foreach ($tasks as $task)
                            @if($task->projet_id == $projet->id)
                            <table>
                                <tr>
                            <td>
                            <form method="post" action="{{ url('/projet/task') }}" accept-charset="utf-8">
                                @csrf
                                
                                <input type="checkbox" class="form-check-input" name="status" onclick="this.form.submit()"
                               {{ $task->status ? 'checked' : ''}}>
                                
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <input type="hidden" name="projet_id" value="{{ $task->projet_id }}">
                            </form>
                            
                            {{ $task->title }}
                        </td>
                        <td>
                            <form method="post" action="{{ url('/projet/task/delete') }}" accept-charset="utf-8">
                                @csrf
                                <input type="hidden" name="id" value="{{ $task->id }}">
                                <input type="hidden" name="projet_id" value="{{ $task->projet_id }}">
        
                
                                <button type="submit" class="btn btn-link btn-sm float-end">
                                    <i class="fa text-muted fa-fw fa-trash"></i></button>


                              
                            </form>
                        </td>
                        </tr>
                            </table>
                           
                            @endif
                            @endforeach
        
                        </div>
                        </div>
                        </div>
                        </div>
        
                    </div>
                </div>
        
           @endforeach  
        
        </div>
        </div>

             
        @endforeach

{{-- <span>
    {{ $projetsdone->links() }}
    </span> --}}
   
</div>
      



@section('script')

{{-- <script src="{{asset('/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js')}}" ></script> --}}
{{-- <script src="{{asset('/assets/plugins/tag-it/js/tag-it.min.js')}}" ></script> --}}
{{-- <script src="{{asset('/assets/js/demo/page-scrum-board.demo.js')}}" ></script> --}}


<link href="{{asset('/assets/plugins/select-picker/dist/picker.min.css')}}" rel="stylesheet" />

<script src="{{asset('/assets/plugins/select-picker/dist/picker.min.js')}}"></script>

                    

    <script>



        var $elem = $('#ex-basicc').picker({
                        search:true
                    });

//                     $elem.on('sp-change', function(){
//                         var x = $('#ex-basicc').find(":selected").val();
//     // $("#ex-basic option[value="+x+"]").hide();
   
//     $('#ex-basicc option[value="1"]').remove();
//     console.log(x);
// });

$('#ex-basic').picker({
                        search:true
                    });

      

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
                        url:"{{route('admin.projet.create')}}",
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


            
        

            $('.btn-edit-projet').click(function(){
                $('#modalEditProjet').modal('show');

             
                
                var projetID = $(this).attr('projet-id');
                var id = $('#id').val(projetID);
                    $.ajax({
                        url:"{{route('admin.projet.edit')}}",
                        type:'POST',
                        data:{
                            id:projetID,
                        },
                        success:function(data){
                            console.log('success edit');
                            $('#title_update').val(data.data.title);
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

                $('#form-signup').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);

                    $.ajax({
                        url:"{{route('admin.projet.create')}}",
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


            
        })
    </script>


@stop
@stop