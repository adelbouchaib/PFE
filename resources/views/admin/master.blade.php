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
    <script src="https://malsup.github.io/jquery.form.js"></script>

    
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

                <a href="{{ route('admin.index') }}">
                    <img src="/assets/img/Logo_entp.png" alt="" width="50" height="50">
                </a>
            </div>


            <div class="menu">
                <div class="menu-search" style="display: flex;">
                </div>
               <!--  <form class="menu-search" method="POST" name="header_search_form">
                    <div class="menu-search-icon"><i class="fa fa-search"></i></div>
                    <div class="menu-search-input">
                        <input type="text" class="form-control" placeholder="Search menu..." />
                    </div>
                </form> -->
                {{-- <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-icon"><i class="fa fa-bell nav-icon"></i></div>
                        <div class="menu-label">3</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-notification">
                        <h6 class="dropdown-header text-dark mb-1">Notifications</h6>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <i class="fa fa-receipt fa-lg fa-fw text-success"></i>
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Your store has a new order for 2 items totaling $1,299.00</div>
                                <div class="time">just now</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <i class="far fa-user-circle fa-lg fa-fw text-muted"></i>
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">3 new customer account is created</div>
                                <div class="time">2 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <img src="assets/img/icon/android.svg" alt="" width="26" />
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Your android application has been approved</div>
                                <div class="time">5 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <a href="#" class="dropdown-notification-item">
                            <div class="dropdown-notification-icon">
                                <img src="assets/img/icon/paypal.svg" alt="" width="26" />
                            </div>
                            <div class="dropdown-notification-info">
                                <div class="title">Paypal payment method has been enabled for your store</div>
                                <div class="time">10 minutes ago</div>
                            </div>
                            <div class="dropdown-notification-arrow">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </a>
                        <div class="p-2 text-center mb-n1">
                            <a href="#" class="text-dark text-opacity-50 text-decoration-none">See all</a>
                        </div>
                    </div>
                </div> --}}
                <div class="menu-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" data-display="static" class="menu-link">
                        <div class="menu-img online">
                            <img src="/assets/img/profile_picture_user_icon_153847.png" alt="" class="ms-100 mh-100 rounded-circle" />
                        </div>
                        <div class="menu-text"><span class="__cf_email__">{{Auth::User()->first_name}} {{Auth::User()->last_name}}</span></div>
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
                        <a href="{{route('admin.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{route('admin.users.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-users"></i></span>
                            <span class="menu-text">Employés</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{route('admin.attendances.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa-solid fa-clock"></i></span>
                            <span class="menu-text">Présence</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="{{route('admin.projet.index')}}" class="menu-link">
                            <span class="menu-icon"><i class="fa-solid fa-code-branch"></i></span>
                            <span class="menu-text">Projets</span>
                        </a>
                    </div>

                    <div class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                            <i class="fa fa-money-bill-alt"></i>
                            </span>
                            <span class="menu-text">Paiement</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu">
                        <div class="menu-item">
                        <a href="{{ route('admin.paiement.index') }}" class="menu-link">
                        <span class="menu-text">Fiche de paie</span>
                        </a>
                        </div>
                        <div class="menu-item">
                        <a href="{{ route('admin.paiement.historique') }}" class="menu-link">
                        <span class="menu-text">Historique</span>
                        </a>
                        </div>
                        </div>
                    </div>

                    <div class="menu-item has-sub">
                        <a href="#" class="menu-link">
                            <span class="menu-icon">
                            <i class="fa fa-calendar"></i>
                            </span>
                            <span class="menu-text">Congé</span>
                            <span class="menu-caret"><b class="caret"></b></span>
                        </a>
                        <div class="menu-submenu">
                        <div class="menu-item">
                        <a href="{{ route('admin.conge.index') }}" class="menu-link">
                        <span class="menu-text">Demandes congé</span>
                        </a>
                        </div>
                        <div class="menu-item">
                        <a href="{{ route('admin.vacance.index') }}" class="menu-link">
                        <span class="menu-text">Vacances</span>
                        </a>
                        </div>
                        </div>
                    </div>
                    

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
