
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="theme_ocean">
    <title>API</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/assets/images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/css/theme.min.css')}}">
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="{{asset('backend/assets/images/logo.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4 text-center">API Project</h2>
                        <form method="POST" action="{{ route('login') }}" class="w-100 mt-4 pt-2">
                            @csrf   

                            <div class="mb-3">
                                <label class="form-label">Email: </label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email"  required>
                                @error('email')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password: </label>
                                <input type="password" name="password" class="form-control" placeholder="Password"  required>
                                @error('password')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="rememberMe">
                                        <label class="custom-control-label c-pointer" for="rememberMe">Remember Me</label>
                                    </div>
                                </div> 
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-lg btn-primary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Theme Customizer !-->
    <!--! ================================================================ !-->
   
    <script src="{{asset('backend/assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/common-init.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/theme-customizer-init.min.js')}}"></script>
</body>

</html>
<style>
    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background: url('data:image/svg+xml;utf8,<svg fill="%23333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 0.75rem center/1rem auto;
        padding-right: 2rem;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<script type="text/javascript"> 

    $(document).ready(function() {
        $('#tractor_type').select2({
            placeholder: 'Select a user',
            width: '100%'
        });
    });
    
</script>
