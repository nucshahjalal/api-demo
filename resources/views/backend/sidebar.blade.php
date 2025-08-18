<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="index.html" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->
                    <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" class="logo logo-lg" />
                    <img src="{{asset('backend/assets/images/logo-abbr.png')}}" alt="" class="logo logo-sm" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label></label>
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <a href="{{url('/dashboard')}}" class="nxl-link">
                            <span class="nxl-mtext">Dashboard</span>
                        </a>                 
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-cast"></i></span>
                            <span class="nxl-mtext">Employee</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('employee.list')}}">Employee List</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-cast"></i></span>
                            <span class="nxl-mtext">Product</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{route('product.list')}}">Product List</a></li>
                        </ul>
                    </li>

                    

                    <li class="nxl-item nxl-hasmenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{url('logout')}}"><i class="feather-power"></i> <strong>Logout</strong></a></li>
                    </li>                              
                </ul>
                
            </div>
        </div>
    </nav>