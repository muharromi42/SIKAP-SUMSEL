<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- meta ngrok --}}
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <!-- Icon Fonts -->
    <link rel="stylesheet" href="{{ asset('login-assets/fonts/icomoon/style.css') }}">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/bootstrap.min.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('login-assets/css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <title>Login #7</title>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('login-assets/images/Disdik.jpeg') }}" alt="Image" class="img-fluid">
                </div>
                <!-- SweetAlert -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            title: 'Success!',
                            text: '{{ session('success') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                @endif
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Silahkan Login Menggunakan NIP</p>
                            </div>
                            <form action="{{ route('login.process') }}" method="post">
                                @csrf
                                <div class="form-group first">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        value="{{ old('nip') }}" required>
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                                <a href="{{ route('registration') }}" class="btn btn-block btn-secondary">Register</a>

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
