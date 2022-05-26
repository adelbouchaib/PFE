<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Studio | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <link href="{{asset('/assets/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" />
    <style>
        .form-login{
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 2px 2px 2px #ddd;
            border: 1px solid #ddd;
        }
    </style>

<meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body style="height:0 !important">

    <div class="container" style="margin-top:250px !important">

        <div class="col-md-4 offset-md-4 form-login">
           <form action="{{route('action.login')}}" method="post" accept-charset="utf-8">
               @csrf
                <h2 class="text-center">Login System</h2>
                <div class="input-group mb-2">
                  <span class="input-group-text">@</span>
                  <input type="email" name="email" class="form-control" required />
                </div>
                 <div class="input-group">
                  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                  <input type="password" name="password" class="form-control" required />
                </div>

                <button type="submit" class="btn btn-primary mt-2">Login</button>
           </form>
        </div>

    </div>



   
    <script data-cfasync="false" src="{{asset('/assets/js/email-decode.min.js')}}"></script>
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('/assets/js/app.min.js')}}"></script>


    

</body>
</html>
