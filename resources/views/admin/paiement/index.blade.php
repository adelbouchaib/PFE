@extends('admin.master')
@section('title')
Fiche de Paie
@stop
@section('content')
 <div class="title-bar">
    <h4 style="float:left">Fiche de Paie</h4>
 </div>

 <div class="container">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nouvelle Fiche de Paie</h4>
                                        </div>

                               

                                    <form method="post" accept-charset="utf-8" action="index.php?name=a&surname=b" id="form-edit">
                                        <div class="modal-body">
                                            <div class="form-group"> 
                                                <label for="title">Matricule</label><br>
                                                <select name="idd" id="ex-basic" class="form-control">
                                                    @foreach ($allusers as $user)
                                                    <option   value="{{ $user->id }}"> {{ $user->matricule }} </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                
                                                <label for="Date debut">First Name</label>
                                                    <input type="date"  class="form-control"  name="date_debut" id="date_debut" />
                                                    <span id="errorDateDebut" class="text-red"></span>

                                                    <label for="Date fin">First Name</label>
                                                    <input type="date" class="form-control" name="date_fin" id="date_fin" />
                                                    <span id="errorDateFin" class="text-red"></span>

                                            </div> 
                                                <div class="form-group">
                                                
                                                    <input type="file" class="fileimage" id="image"  name="image" /> 
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
                            <th scope="col">Full Name</th>
                            <th scope="col">Salaire Brut</th>
                            <th scope="col">Jours d'Absence</th>
                            <th scope="col">Retenue Sur Salaire</th>

                            </tr>
                            </thead>
                            <tbody>
                                
                                {{-- @foreach ($filterusers2 as $filteruser2)
                                <th scope="row">{{ $filteruser2->id }}</th>
                                <td>{{ $filteruser2->first_name }} {{ $filteruser2->last_name }}</td>
                                <td>{{ $filteruser2->salary }}</td>
    
                                <td>{{ $paiements }}</td>
    
    
                                @php
                                    $salaire =  round($filteruser2->salary /30 * $paiements) ;
                                @endphp
    
                                <td>{{ $salaire }}</td>
                                   
                                </tr>
                                @endforeach --}}
    
                            

                            </tbody>
                            </table>

                             

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-edit-user">Calculer</button>
                                 </div>
    
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


//             $('#idd').keyup(function (){
//     $('#var1').val($(this).val()); // <-- reverse your selectors here
// });



      

      
          

            $('#datepicker').datepicker({
      autoclose: true,
    });
    $('#datepickerr').datepicker({
      autoclose: true,
    });

            $('#ex-basic').picker({search : true});

            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });

            

     
           
    
            
            $('.btn-edit-user').click(function fetchstudents(){

                


                // function fetchstudents(e){
                //     e.preventDefault();
              
                
                $('tbody').html("");
                $.ajax({
                    type:"get",
                    url:"{{ route('admin.paiement.search') }}",
                    dataType: "json",
                    
                    
                    data:{
                        
                            id: $('input[name=idd]').val(),
                            date_debut: $('input[name=date_debut]').val(),
                            date_fin: $('input[name=date_fin]').val(),
                    },
                    cache: false,
                    
                    success: function(response){
                        var x;
                        var y;
                        var yy;

                        $.each(response.filterusers2,function(key,item){
                            x = item.salary / 30;
                            y = x* response.paiements;
                            yy = y.toFixed();
                            $('tbody').append(
                                '<td>'+item.id+'</td>\
                                <td>'+item.first_name+'</td>\
                                <td>'+item.salary+'</td>'
                                
                              
                              );
                             
                        });

                        
                            $('tbody').append(
                                '<td>'+response.paiements+'</td>\
                                <td>'+yy+'</td>'


                                
                                );
                        
                        
                    },
                    
                    error:function(respone){
                        console.log("ERROR");
                    }

                })
            
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