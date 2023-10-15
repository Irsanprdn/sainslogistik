<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel PSBI Bangun Daya 1</title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets') }}/compro/img/favicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets') }}/login/css/bootstrap.min.css">
    <!-- Icon Icomoon -->
    <link rel="stylesheet" href="{{ asset('assets') }}/login/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/login/css/style.css?v=1.1">
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-4 text-center">
                    <img src="{{ asset('assets') }}/compro/img/Logo-Sains-Potrait.png" width="150" class="img-fluid" alt="Logo">
                    <h3 class="text-center">Admin Panel</h3>
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <form action="{{route('proc.login')}}" method="post">
                        @csrf
                        <!-- Username input -->
                        <div class="form-outline mb-4">
                            <label class="form-label font-weight-bold" for="form3Example3">Username</label>
                            <div class="form-group has-icon">
                                <span class="icon-user form-control-feedback"></span>
                                <input type="text" name="email" id="form3Example3" class="form-control form-control-lg" placeholder="Masukan Username" />
                                @if($errors->has('email'))
                                <span id="inputEmail-error" class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label font-weight-bold" for="form3Example4">Password</label>
                            <div class="form-group has-icon">
                                <span class="icon-lock form-control-feedback"></span>
                                <span class="icon-eye toggle-password"></span>
                                <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Masukan Password" />
                            </div>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100" style="padding-left: 2.5rem; padding-right: 2.5rem; background: #0A215A;">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('assets') }}/login/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('assets') }}/login/js/popper.min.js"></script>
    <script src="{{ asset('assets') }}/login/js/bootstrap.min.js"></script>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("icon-eye icon-eye-slash");

            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>