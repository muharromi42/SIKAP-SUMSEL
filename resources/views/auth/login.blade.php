<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('login-assets/fonts/icomoon/style.css') }}">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/bootstrap.min.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/style.css') }}">

    <title>Login #7</title>

    <style>
        body {
            background: #f0f2f5;
            font-family: 'Roboto', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .content {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 30px;
            margin: 0 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
        }

        .col-md-6 img {
            max-width: 100%;
            border-radius: 10px;
        }

        .col-md-6.contents {
            padding-left: 40px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn {
            font-size: 16px;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        .control--checkbox .caption {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row justify-content-center">
                <h1>SISTEM INFORMASI PENGARSIPAN DOKUMEN TUNJANGAN TPP PEGAWAI PENDIDIKAN PROVINSI SUMATERA SELATAN</h1>
                <div class="col-md-6">
                    <img src="{{ asset('login-assets/images/Disdik.jpeg') }}" alt="Image">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Silahkan Login Menggunakan NIP</p>
                            </div>
                            <form action="#" method="post">
                                <div class="form-group first">
                                    <label for="NIP">NIP</label>
                                    <input type="text" class="form-control" id="NIP" required>
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" required>
                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-primary mb-2">
                                <input type="submit" value="Register" class="btn btn-block btn-secondary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('login-assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('login-assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('login-assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('login-assets/js/main.js') }}"></script>

</body>

</html>
