<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="" class="brand-link text-white text-decoration-none">
            <!--begin::Brand Image-->
            {{-- <img src="../assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" /> --}}
            <i class="bi bi-shop fs-4"></i>
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light bold">{{ Auth::user()->store_name }}</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-header">CATEGORIES</li>
                <li class="nav-item">
                    <a href="{{ route('seller.categories.index', $username) }}" class="nav-link">
                        <i class="nav-icon bi bi-tag"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-header">PRODUCTS</li>
                <li class="nav-item">
                    <a href="{{ route('seller.products.index', $username) }}" class="nav-link">
                        <i class="nav-icon bi bi-archive"></i>
                        <p>Products</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
