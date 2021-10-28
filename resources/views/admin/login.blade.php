<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | ShareTheBrick</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{url('/')}}/admin_files/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/libs/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/admin_files/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <input type="hidden" id="BASE_URL" value="{{url('/')}}">
        <div class="card ">
            <div class="card-header text-center"><a href="{{url('/')}}"><img class="logo-img" src="{{url('/')}}/img/logo.png" alt="logo" width="200"></a><span class="splash-description">Please enter your login information.</span></div>
            <div class="col-md-12">
                <div class="alert alert-danger login-errors" role="alert" style="display: none;">
                </div>
            </div>
            <div class="card-body">
                <form id="admin-login-form" method="post">
                @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="text" placeholder="Email" autocomplete="off" name="email">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block login-default-btn">Sign in</button>
                </form>
            </div>
       <!--      <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div> -->
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{url('/')}}/admin_files/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="{{url('/')}}/js/jquery.validate.min.js"></script>
    <script src="{{url('/')}}/admin_files/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="{{url('/')}}/admin_files/assets/libs/js/admin-custom.js"></script>
</body>
 
</html>