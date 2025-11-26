<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <span class="brand-text fw-light">Showcase Product</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">

                @if (Auth::check() && Auth::user()->role == 'admin')

                    {{-- AREA ADMIN --}}
                    <li class="nav-header">DASHBOARD</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">USERS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>
                                Users
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon bi bi-person"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon bi bi-basket"></i>
                                    <p>Request Seller</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- AREA PUBLIC / USER / SELLER --}}

                    <li class="nav-header">HOMES</li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-house-fill"></i>
                            <p>Home Page</p>
                        </a>
                    </li>
                    <li class="nav-header">CATEGORIES</li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon bi bi-tag-fill"></i>
                            <p>All Category</p>
                        </a>
                    </li>
                    <li class="nav-header">PRODUCTS</li>
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="nav-icon bi bi-bag-fill"></i>
                            <p>All Product</p>
                        </a>
                    </li>

                    {{-- Menu Akun Hanya Muncul Jika Login --}}
                    @auth
                        <li class="nav-header">ACCOUNTS</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p>
                                    Accounts
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.edit') }}"
                                        class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-person"></i>
                                        <p>Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                                        <p>Followers</p>
                                    </a>
                                </li>

                                {{-- Logic Role User/Seller aman disini karena sudah di dalam @auth --}}
                                @if (Auth::user()->role == 'user')
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <i class="nav-icon bi bi-shop-window"></i>
                                            <p>Be a Seller</p>
                                        </a>
                                    </li>
                                @elseif (Auth::user()->role == 'seller')
                                    <li class="nav-item">
                                        <a href="{{ route('seller.index', Auth::user()->username) }}"
                                            class="nav-link {{ request()->routeIs('seller.index') ? 'active' : '' }}">
                                            <i class="nav-icon bi bi-shop-window"></i>
                                            <p>My Store</p>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endauth
                @endif


                {{-- MENU ACTIONS (LOGIN/LOGOUT) --}}
                <li class="nav-header">ACTIONS</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>
                            @auth Logout
                            @else
                            Login or Register @endauth
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>

                    @auth
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link bg-transparent border-0 w-100 text-start">
                                        <i class="nav-icon bi bi-box-arrow-right"></i>
                                        <p class="d-inline ms-2">Logout from Account</p>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">
                                    <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                    <p>Login</p>
                                </a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">
                                        <i class="nav-icon bi bi-person-plus"></i>
                                        <p>Register</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endauth
                </li>

            </ul>
        </nav>
    </div>
</aside>
