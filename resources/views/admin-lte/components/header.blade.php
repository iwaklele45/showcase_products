<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">

            <!--begin::Navbar Search-->
            {{-- @if (auth()->check() && optional(auth()->user())->role !== 'admin')
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="bi bi-search"></i>
                    </a>
                </li>
            @endif --}}
            <li class="nav-item">
                <div class="navbar-search-block">
                    <form class="d-flex" action="{{ route('products.search') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control form-control-navbar" type="search" name="q"
                                placeholder="Search products" aria-label="Search" value="{{ request('q') }}">
                            <button class="btn btn-navbar" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </li>
            <!--end::Navbar Search-->

            @auth
                <!-- Messages -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-chat-text"></i>
                        <span class="navbar-badge badge text-bg-danger">1</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <img src="./assets/img/user1-128x128.jpg" class="img-size-50 rounded-circle me-3" />
                                </div>
                                <div class="flex-grow-1">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-end fs-7 text-danger">
                                            {{-- <i class="bi bi-star-fill"></i> --}}
                                        </span>
                                    </h3>
                                    <p class="fs-7">Call me whenever you can...</p>
                                    <p class="fs-7 text-secondary"><i class="bi bi-clock-fill me-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </li>

                <!-- Notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-bs-toggle="dropdown" href="#">
                        <i class="bi bi-bell-fill"></i>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <span
                                class="navbar-badge badge text-bg-warning">{{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                        <span class="dropdown-header">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                {{ auth()->user()->unreadNotifications->count() }} Notifikasi
                            @else
                                Tidak ada notifikasi baru
                            @endif
                        </span>
                        <div class="dropdown-divider"></div>
                        @forelse (auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="dropdown-item">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        @if ($notification->type === 'App\Notifications\SellerVerificationNotification')
                                            <h3 class="dropdown-item-title fs-7">
                                                @if ($notification->data['status'] === 'verified')
                                                    <i class="bi bi-check-circle text-success"></i> Permintaan Diterima
                                                @else
                                                    <i class="bi bi-x-circle text-danger"></i> Permintaan Ditolak
                                                @endif
                                            </h3>
                                            <p class="fs-8">{{ $notification->data['message'] }}</p>
                                            <p class="fs-8 text-secondary">
                                                <i class="bi bi-clock-fill me-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        @else
                                            <h3 class="dropdown-item-title fs-7">
                                                {{ $notification->data['message'] ?? 'Notifikasi' }}
                                            </h3>
                                            <p class="fs-8 text-secondary">
                                                <i class="bi bi-clock-fill me-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @empty
                        @endforelse
                        @if (auth()->user()->unreadNotifications->count() > 0)
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('notifications.markAsRead') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-center fs-8">
                                    Tandai semua sebagai telah dibaca
                                </button>
                            </form>
                        @endif
                    </div>
                </li>
            @endauth

            <!-- Fullscreen Toggle -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display:none"></i>
                </a>
            </li>

            <!-- User Menu -->
            @auth
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                        <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm">
                        <li class="user-header text-bg-primary">
                            <i class="bi bi-person-circle" style="font-size: 50px"></i>
                            <p>
                                {{ auth()->user()->name }}
                                <small>{{ auth()->user()->email }}</small>
                            </p>
                        </li>
                    </ul>
                </li>
            @endauth

        </ul>
    </div>
</nav>
<!--end::Header-->
