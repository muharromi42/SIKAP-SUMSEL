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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login #7</title>
</head>

<body>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('login-assets/images/Disdik.jpeg') }}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">Silahkan Login Menggunakan NIP</p>
                            </div>
                            <!-- Tampilkan error jika validasi gagal -->
                            @if ($errors->any())
                                <script>
                                    Swal.fire({
                                        title: 'Error!',
                                        html: '<ul>' + @json($errors->all()).map(error => `<li>${error}</li>`).join('') + '</ul>',
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                </script>
                            @endif
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="form-group first">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" name="nip"
                                        value="{{ old('nip') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('nama') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="{{ old('password') }}" required>
                                </div>

                                <button type="submit" class="btn btn-block btn-primary">Register</button>
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
