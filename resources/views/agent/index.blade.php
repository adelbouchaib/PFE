@extends('admin.master')
@section('title')
	Home
@stop
@section('content')

   <form method="post" accept-charset="utf-8" id="form-signupp">
    <input type="hidden" name="matricule" id="matricule" class="form-control">

    <video id="preview"></video>
    <script type="text/javascript">
    
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
            
          scanner.addListener('scan',function (c){
            document.getElementById('matricule').value = c;
            
            
        });

    </script>
           <br>
  <button type="submit" class="btn btn-primary" style="right:1000px">Save</button>
  </form>
    

    <script>
   
      $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                
            $('#form-signupp').submit(function(e){
              e.preventDefault();
                    var formDataa =  new FormData(this);
                    console.log(formDataa.get('matricule'));
        
                        $.ajax({
                            url:"{{route('admin.presences.start')}}",
                            type:'POST',
                            data:formDataa,
                        processData: false,
                        contentType: false,
                        cache: false,
                        enctype: 'multipart/form-data',

                            success:function(data){
                            
                              alert(data.msg + " " + data.prenom + " " + data.nom); 

                            },
                            error:function(respone){
                             
                            }
                          })

                });//form


            });//scanner


    </script>


   



@stop