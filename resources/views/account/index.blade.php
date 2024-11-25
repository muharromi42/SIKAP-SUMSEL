@extends('templates.layout')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Account Profile</h3>
                    <p class="text-subtitle text-muted">A page where users can change profile information</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <!-- Profile Picture -->
                <div class="col-12 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                                <div class="avatar avatar-2xl">
                                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : '/template/dist/assets/compiled/jpg/2.jpg' }}"
                                        alt="Avatar" class="rounded-circle"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                                <h3 class="mt-3">{{ $user->nama }}</h3>
                                <p class="text-small">{{ $user->level ?? 'User' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Form -->
                <div class="col-12 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('account.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="Your Name" value="{{ old('nama', $user->nama) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Your Email" value="{{ old('email', $user->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="nip" class="form-label">NIP</label>
                                    <input type="text" name="nip" id="nip" class="form-control"
                                        placeholder="Your nip" value="{{ old('nip', $user->nip) }}">
                                </div>

                                <div class="form-group">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
