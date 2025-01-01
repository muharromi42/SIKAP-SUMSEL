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
                                    <label for="notel" class="form-label">notel</label>
                                    <input type="text" name="notel" id="notel" class="form-control"
                                        placeholder="Your notel" value="{{ old('notel', $user->notel) }}">
                                </div>

                                <div class="form-group">
                                    <label for="jabatan" class="form-label">jabatan</label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control"
                                        placeholder="Your jabatan" value="{{ old('jabatan', $user->jabatan) }}">
                                </div>

                                <!-- Kabupaten -->
                                <div class="form-group mb-3">
                                    <label for="kabupaten" class="form-label">Kabupaten / Kota</label>
                                    <select name="kabupaten" id="kabupaten" class="form-control" required>
                                        @foreach ($kabupatenOptions as $kabupaten)
                                            <option value="{{ $kabupaten }}"
                                                {{ old('kabupaten', $user->kabupaten) == $kabupaten ? 'selected' : '' }}>
                                                {{ $kabupaten }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Nama Instansi -->
                                <div class="form-group mb-3">
                                    <label for="nama_instansi" class="form-label">Nama Instansi</label>
                                    <input type="text" name="nama_instansi" id="nama_instansi" class="form-control"
                                        placeholder="Masukkan Nama Instansi"
                                        value="{{ old('nama_instansi', $user->nama_instansi) }}">
                                </div>

                                <div class="form-group">
                                    <label for="birthday" class="form-label">birthday</label>
                                    <input type="date" name="birthday" id="birthday" class="form-control"
                                        placeholder="Your birthday" value="{{ old('birthday', $user->birthday) }}">
                                </div>

                                <div class="form-group">
                                    <label for="status" class="form-label">status</label>
                                    <input type="text" name="status" id="status" class="form-control"
                                        placeholder="Your status" value="{{ old('status', $user->status) }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture"
                                        class="form-control">
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
