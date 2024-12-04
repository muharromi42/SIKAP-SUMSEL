<header>
    <nav class="navbar navbar-expand navbar-light navbar-top">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-lg-0">
                    <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"
                            data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4'></i>
                            <span class="badge badge-notification bg-danger" id="notification-badge">0</span>
                        </a>
                        <ul class="dropdown-menu dropdown-center  dropdown-menu-sm-end notification-dropdown"
                            aria-labelledby="dropdownMenuButton" id="notification-list">
                            <li class="dropdown-header">
                                <h6>Notifications</h6>
                            </li>
                            <!-- Notifications will be dynamically inserted here -->
                        </ul>
                    </li>
                </ul>

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600">{{ Auth::user()->nama }}</h6>
                                <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->level }}</p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-md">
                                    <img
                                        src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : '/template/dist/assets/compiled/jpg/2.jpg' }}">

                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello! {{ Auth::user()->nama }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('account') }}"><i
                                    class="icon-mid bi bi-person me-2"></i> My
                                Profile</a></li>
                        <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data notifikasi dari backend
            fetch('/api/notifications') // Pastikan route ini sesuai dengan route yang mengembalikan data notifikasi
                .then(response => response.json())
                .then(data => {
                    const notificationList = document.getElementById('notification-list');
                    const notificationBadge = document.getElementById('notification-badge');

                    if (data.length > 0) {
                        notificationBadge.textContent = data.length; // Update jumlah notifikasi
                        data.forEach(notification => {
                            const li = document.createElement('li');
                            li.classList.add('dropdown-item', 'notification-item');

                            const link = document.createElement('a');
                            link.classList.add('d-flex', 'align-items-center');
                            link.href = notification.url;

                            const icon = document.createElement('div');
                            icon.classList.add('notification-icon', 'bg-warning');
                            icon.innerHTML = '<i class="bi bi-bell"></i>';

                            const text = document.createElement('div');
                            text.classList.add('notification-text', 'ms-4');
                            text.innerHTML = `
                        <p class="notification-title font-bold">${notification.title}</p>
                        <p class="notification-subtitle font-thin text-sm">${notification.subtitle}</p>
                    `;

                            link.appendChild(icon);
                            link.appendChild(text);
                            li.appendChild(link);
                            notificationList.appendChild(li);
                        });
                    } else {
                        notificationBadge.style.display = 'none'; // Sembunyikan badge jika tidak ada notifikasi
                    }
                });
        });
    </script>
@endpush
