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
    @can('index', \App\Dashboard::class)
    <div class="ms-auto">
    <a href="#"  class="btn btn-primary btn-add-user"><i class="fa fa-plus-circle me-1"></i> Ajouter un projet</a>
    </div>
    @endcan
    </div>

    

    
            
    @php
    $i = 0;
    $t = 0;   
    $array = array($projetstodo,$projetsinprogress,$projetsdone);  
    @endphp
    
  <div class="row">
      
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
                              
                      {{-- ({{ $project->count() }}) --}}
                    </span>
                      @if($t == 3)
                      <div><a href="{{ route('admin.projet.historique') }}" class="d-flex align-items-center text-decoration-none">View all <i class="fa fa-chevron-right ms-2 text-opacity-50"></i></a></div>
                      @endif
                  </div>
              @foreach ($project as $projet)
              @if($projet->user_id2 == Auth::User()->id)
              <div class="list-group list-group-flush">
              <div class="list-group-item d-flex px-3">
                  <div class="me-3">
                  <i class="fa fa-code-branch text-muted fa-fw fa-lg"></i>
                  </div>
                  <div class="flex-fill">
                      <div class="fw-600">{{  $projet->title  }} 
                        @if($projet->user_id == Auth::User()->id)
                        <a href="#" projet-id="{{ $projet->id }}"  style="float:right" class="text-muted text-decoration-none fs-12px me-3 btn-edit-projet">
                            <i class="fa fa-fw fa-edit"></i></a>
                        @endif
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
                          {{-- si la date de fin du projet est dépassé --}}
                          <td><span class="badge bg-danger bg-opacity-20 text-danger" style="min-width: 60px;"> {{ $projet->finish }}</span></td>
                          @elseif($projet->finish < $todayDate && $projet->finish > $Date)
                          {{-- si la date de fin du projet reste 7 jrs --}}
                          <td><span class="badge bg-success bg-opacity-20 text-success" style="min-width: 60px;">{{ $projet->finish }}</span></td>
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
                                 
                                @if($projet->user_id == Auth::User()->id)

                                      <form method="post" action="{{ url('/projet/task/create') }}" accept-charset="utf-8">
                                          @csrf
                                          <div style="display: flex">
                                      <input type="text" name="title" id="title" style="display:inline" class="form-control">
                                      <span id="errorFirstName" class="text-red"></span>
                                      <input type="hidden" value="{{ $projet->id }}" name="projet_id">
                                      <button type="submit" style="display:inline; margin-left:5px;" class="btn btn-primary btn-sm">Ajouter</button>
                                  </div>
                                      </form>
                                @endif
                                  
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
                              
                              @if($projet->user_id == Auth::User()->id)
                              <input type="checkbox" class="form-check-input" name="status" onclick="this.form.submit()"
                             {{ $task->status ? 'checked' : ''}}>
                             @else

                             <input type="checkbox" class="form-check-input" name="status" onclick="return false;"
                             {{ $task->status ? 'checked' : ''}}>

                             @endif
                              
                              <input type="hidden" name="id" value="{{ $task->id }}">
                              <input type="hidden" name="projet_id" value="{{ $task->projet_id }}">
                          </form>
                          
                          {{ $task->title }}
                             </td>

                            @if($projet->user_id == Auth::User()->id)
                            <td>
                                <form method="post" action="{{ url('/projet/task/delete') }}" accept-charset="utf-8">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $task->id }}">
                                    <input type="hidden" name="projet_id" value="{{ $task->projet_id }}">         
                                    <button type="submit" class="btn btn-link btn-sm float-end">
                                        <i class="fa text-muted fa-fw fa-trash"></i></button>
                                </form>
                            </td>
                            @endif

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
      
              @endif
         @endforeach  
      
      </div>
      </div>

           
      @endforeach
 
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
                <div class="form-group" >
                    <label for="start_date">Type</label> 
                <select name="type" class="form-control"  id="type">
                    <option value="0">Projet</option>
                    <option value="1">Mission</option>
                </select>
                </div>
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

                <div class="row">           

             <div class="form-group col-sm">
                <label for="start_date">Date debut</label>
                <input type="date" name="start" id="start" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>

            <div class="form-group col-sm">
                <label for="start_date">Date fin</label>
                <input type="date" name="finish" id="finish" class="form-control">
                <span id="errorStartDate" class="text-red"></span>
            </div>
                </div>

            <div class="row">           
            <div class="form-group col-sm">
                <label for="start_date">Chef</label>
                <select name="chef" class="form-control"  id="ex-basicc">
                    <option value="" hidden>Full name</option>
                    @foreach ($allusers as $user)
                    <option   value="{{ $user->id }}"> {{ $user->matricule }} - {{ $user->prenom }} {{ $user->nom }} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-sm">
                <label for="start_date">Prime du chef</label>
                <input type="number" name="prime_chef" id="prime_chef" class="form-control">

            </div>
            </div>


            <div class="row">           
             <div class="form-group col-sm" style="width:100%" >
                <label for="start_date">Equipe</label> 
            <select name="data[]" class="form-control"  id="ex-basic" multiple>
                <option value="" hidden>Full name</option>
                @foreach ($allusers as $user)
                <option   value="{{ $user->id }}"> {{ $user->matricule }} - {{ $user->prenom }} {{ $user->nom }} </option>
                @endforeach
            </select>

             </div>

             <div class="form-group col-sm">
                <label for="start_date">Prime de l'équipe</label>
                <input type="number" name="prime_equipe" id="prime_equipe" class="form-control">

            </div>
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
                    <input type="hidden" name="id_update" id="id_update" class="form-control">
                    <div class="form-group">
                        <label for="first_name">Title</label>
                        <input type="text" name="title_update" id="title_update" class="form-control">
                        <span id="errorFirstName" class="text-red"></span>
                    </div>
                    <div class="form-group">
                        <label for="first_name">Description</label>
                        <textarea name="description_update" id="description_update" class="form-control"> </textarea>
                        <span id="errorFirstName" class="text-red"></span>
                    </div>
    
    
                 <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_update" id="start_update" class="form-control">
                    <span id="errorStartDate" class="text-red"></span>
                </div>
    
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="finish_update" id="finish_update" class="form-control">
                    <span id="errorStartDate" class="text-red"></span>
                </div>
    
                
                <div class="row">           
                    <div class="form-group col-sm">
                        <label for="start_date">Chef</label>
                        <select name="chef_update" class="form-control"  id="ex-basicc_update">            
                        </select>
                    </div>
                    <div class="form-group col-sm">
                        <label for="start_date">Prime du chef</label>
                        <input type="number" name="prime_chef_update" id="prime_chef_update" class="form-control">
        
                    </div>
                    </div>
        
        
                    <div class="row">           
                     <div class="form-group col-sm" style="width:100%" >
                        <label for="start_date">Equipe</label> 
                    <select name="data_update[]" class="form-control"  id="ex-basic_update" multiple>
                    </select>
                     </div>
                     <div class="form-group col-sm">
                        <label for="start_date">Prime du chef</label>
                        <input type="number" name="prime_equipe_update" id="prime_equipe_update" class="form-control">
        
                    </div>
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
                            $('#id_update').val(projetID);
                            $('#title_update').val(data.data.title);
                            $('#description_update').val(data.data.description);
                            $('#start_update').val(data.data.start);
                            $('#finish_update').val(data.data.finish);
                            $('#prime_equipe_update').val(data.data.prime_equipe);
                            $('#prime_chef_update').val(data.data.prime_chef);



                        //     $.each(data.equipe,function(key,item){
                                
                        //         $('#ex-basic-update').append(
                        //         '<option value="'+item.id+'">'+item.matricule+' - '+item.prenom+' ' +item.nom+'</option>' );
                            
                        // });

                             $.each(data.allusers,function(key,item){
                                
                                    $('#ex-basic_update').append(
                                            '<option value="'+item.id+'">'+item.matricule+' - '+item.prenom+' ' +item.nom+'</option>' );
                                        
                                    });

                                    $.each(data.allusers,function(key,item){
                                    
                                    $('#ex-basicc_update').append(
                                    '<option value="'+item.id+'">'+item.matricule+' - '+item.prenom+' ' +item.nom+'</option>' );
                                
                            });

                            $('#ex-basic_update').picker({
                            search:true
                        });
                        $('#ex-basicc_update').picker({
                            search:true
                        });

                        },
                        error:function(respone){
                            
                        }
                    });

                $('#form-edit').submit(function(e){
                    e.preventDefault();
                    var formData =  new FormData(this);

                    $.ajax({
                        url:"{{route('admin.projet.update')}}",
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
                            
                        }
                    })
                })
            })


            
        })
    </script>


@stop
@stop