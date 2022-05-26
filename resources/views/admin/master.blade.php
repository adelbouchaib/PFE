<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | ENTP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />




    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    {{-- <script src="https://malsup.github.io/jquery.form.js"></script> --}}



    
<link href="{{asset('/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<script src="{{asset('/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

   
    


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

                <a href="{{ route('index') }}">
                    <img src="/assets/img/Logo_entp.png" alt="" width="50" height="50">
                </a>
            </div>


            <div class="menu">
                <div class="menu-search" style="display: flex;">
                </div>
                @can('index', \App\Dashboard::class)
                <form type="get" action="{{ route('test.calculate') }}">
                    <div class="modal-body">
                    <input type="date" style="width:auto; display:inline;" class="form-control"  name="start_date" id="start_date" />
                    <input type="date" style="width:auto; display:inline;" class="form-control"  name="end_date" id="end_date" />
                    <button type="submit" class="btn btn-secondary btn-sm">Exporter</button>
                    </div>
                </form>
                @endcan
               
                <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-img online">
                            <img src="/assets/img/profile_picture_user_icon_153847.png" alt="" class="ms-100 mh-100 rounded-circle" />
                        </div>
                        <div class="menu-text"><span class="__cf_email__">{{Auth::User()->prenom}} {{Auth::User()->nom}}</span></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right me-lg-3">
                        <a class="dropdown-item d-flex align-items-center" href="#">Edit Profile <i class="fa fa-user-circle fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        {{-- <a class="dropdown-item d-flex align-items-center" href="#">Inbox <i class="fa fa-envelope fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <a class="dropdown-item d-flex align-items-center" href="#">Calendar <i class="fa fa-calendar-alt fa-fw ms-auto text-dark text-opacity-50"></i></a>
                        <a class="dropdown-item d-flex align-items-center" href="#">Setting <i class="fa fa-wrench fa-fw ms-auto text-dark text-opacity-50"></i></a> --}}
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
                        <a href="{{route('index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </div>

                    @can('index', \App\Dashboard::class)
                    <div class="menu-item">
                        <a href="{{route('admin.users.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-users"></i></span>
                            <span class="menu-text">Employés</span>
                        </a>
                    </div>
                    @endcan

                    <div class="menu-item">
                        <a href="{{route('admin.presences.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa-solid fa-clock"></i></span>
                            <span class="menu-text">Présence</span>
                        </a>
                    </div>


                    <div class="menu-item">
                        <a href="{{ route('admin.absencesjustifiees.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-clock"></i></span>
                        <span class="menu-text">Absences</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{ route('admin.sanctions.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="fa-solid fa-clock"></i></span>
                        <span class="menu-text">Sanctions</span>
                        </a>
                    </div>
                   
         
                    <div class="menu-item">
                        <a href="{{ route('admin.vacance.index') }}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-calendar"></i></span>
                        <span class="menu-text">Jours fériés</span>
                        </a>
                    </div>
                   
                     
                    <div class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                            <i class="fa-solid fa-calendar-times"></i>
                            </span>
                            <span class="menu-text">Demandes</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu">
                        <div class="menu-item">
                        <a href="{{ route('admin.absences.index') }}" class="menu-link">
                        <span class="menu-text">Demandes d'absence</span>
                        </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.conge.index') }}" class="menu-link">
                            <span class="menu-text">Demandes congé</span>
                            </a>
                        </div>
                        </div>
                    </div>
                    
            

 

                        <div class="menu-item">
                            <a href="{{route('admin.projet.index')}}" class="menu-link">
                                <span class="menu-icon"><i class="fa-solid fa-code-branch"></i></span>
                                <span class="menu-text">Projets</span>
                            </a>
                        </div>
    
                    
                    @can('index', \App\Dashboard::class)
                    <div class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                            <i class="fa fa-building"></i>
                            </span>
                            <span class="menu-text">Structure d'entreprise</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu">
                        <div class="menu-item">
                        <a href="{{ route('admin.structure.branche') }}" class="menu-link">
                        <span class="menu-text">Branches</span>
                        </a>
                        </div>
                        <div class="menu-item">
                        <a href="{{ route('admin.structure.direction') }}" class="menu-link">
                        <span class="menu-text">Directions</span>
                        </a>
                        </div>
                        </div>
                    </div>
                    @endcan






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
