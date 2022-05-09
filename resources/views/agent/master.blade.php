<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | HRMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />




    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   



    <link href="{{asset('/assets/css/vendor.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>




    

    <div id="app" class="app">

        <div id="header" class="app-header">

            <div class="mobile-toggler">
                <button type="button" class="menu-toggler" data-toggle="sidebar-mobile">
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="brand">
                <div class="desktop-toggler">
                    <button type="button" class="menu-toggler" data-toggle="sidebar-minify">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
                <a href="#" class="brand-logo">
                    HRMS
                </a>
            </div>


            <div class="menu">
                <div class="menu-search" style="display: flex;">
                    
                </div>
            
                
                <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-img online">
                            <img src="{{asset('/assets/uploads/profiles/')}}/{{Auth::User()->profile}}" alt="" class="ms-100 mh-100 rounded-circle" />
                        </div>
                        <div class="menu-text"><span class="__cf_email__">{{Auth::User()->first_name}} {{Auth::User()->last_name}}</span></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right me-lg-3">
                        <a class="dropdown-item d-flex align-items-center" href="#">Edit Profile <i class="fa fa-user-circle fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">Log Out <i class="fa fa-toggle-off fa-fw ms-auto text-dark text-opacity-50"></i></a>
                    </div>
                </div>
            </div>

        </div>


        <div id="sidebar" class="app-sidebar">

            <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

                <div class="menu">
                    <div class="menu-header">Navigation</div>
                    <div class="menu-item active">
                        <a href="{{route('admin.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </div>




                    <div class="menu-item">
                        <a href="{{route('admin.attendances.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa-solid fa-briefcase"></i></span>
                            <span class="menu-text">Attendances</span>
                        </a>
                    </div>
                </div>

            </div>


            <button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>

        </div>


        


        <div id="content" class="app-content">


            @yield('content')

        </div>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{asset('/assets/js/email-decode.min.js')}}"></script>
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>
    <script src="{{asset('/assets/js/app.min.js')}}"></script>
    @yield('script')
</body>
</html>
