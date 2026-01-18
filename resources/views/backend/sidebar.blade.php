<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="#" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" class="logo logo-lg" />
                    <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label></label>
                    </li>

                @if(Auth::user()->name === 'admin')
                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{url('/dashboard')}}" class="nxl-link">
                             <span class="nxl-micon"><i class="feather-airplay"></i> </span> Dashboard
                        </a>                 
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="bi bi-briefcase"></i></span>
                            <span class="nxl-mtext">Api User</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{url('user-list')}}">User List</a></li>
                        </ul>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{url('school-api')}}">School Api</a></li>
                        </ul>
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{url('logout')}}"><span class="nxl-micon"><i class="feather-power"></i> </span><strong>Log Out</strong></a></li>
                    </li> 
                    
                @else
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="bi bi-briefcase"></i></span>
                            <span class="nxl-mtext">Api User</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{url('user-list')}}">User List</a></li>
                        </ul>
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{url('logout')}}"><span class="nxl-micon"><i class="feather-power"></i> </span><strong>Log Out</strong></a></li>
                    </li>

                @endif

                                                
                </ul>
                
            </div>
        </div>
    </nav>

    <style>
        .nxl-micon i {
            color: green; /* bright orange, for example */
            font-size: 2rem;
        }
    </style>

