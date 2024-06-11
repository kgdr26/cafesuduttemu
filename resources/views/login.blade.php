<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Codescandy" name="author">
        <title>Sign in eCommerce HTML Template - FreshCart </title>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/favicon/favicon.ico')}}">
        <!-- Libs CSS -->
        <link href="{{asset('assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet">
        <link href="{{asset('assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet">
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/theme.min.css')}}">
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-M8S4MT3EYG');
        </script>
          <!-- Javascript-->
        <!-- Libs JS -->
        <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
    </head>

    <body>

        <div class="border-bottom shadow-sm">
            <nav class="navbar navbar-light py-2">
                <div class="container justify-content-center justify-content-lg-between">
                    <a class="navbar-brand" href="">
                        <img src="{{asset('assets/images/logo/freshcart-logo.svg')}}" alt="" class="d-inline-block align-text-top" style="width: 25%">
                    </a>
                </div>
            </nav>
        </div>

        <main>
            <section class="my-lg-14 my-8">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                            <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid">
                        </div>
                        <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                            <div class="mb-lg-9 mb-5">
                                <h1 class="mb-1 h2 fw-bold">Sign in to CafeSudutTemu</h1>
                                <p>Welcome back to SudutTemu! Enter your username and password to get started.</p>
                            </div>
                            <form action="{{route('login_post')}}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label">Username</label>
                                        <input type="text" class="form-control" id="" placeholder="Username" name="username">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" id="fakePassword" placeholder="Enter Password" class="form-control" name="password">
                                            <span><i id="passwordToggler"class="bi bi-eye-slash"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid">
                                        <button type="submit" class="btn btn-primary">Sign In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <script src="{{asset('assets/js/theme.min.js')}}"></script>
        <script src="{{asset('assets/js/vendors/password.js')}}"></script>
    </body>
</html>
