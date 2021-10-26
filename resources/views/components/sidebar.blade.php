<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-text mx-3">E-Kantin MHS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Admin</div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->path() == 'home' ? 'active' : '' }}">
      <a class="nav-link " href="{{ route('home') }}">
        <i class="fas fa-fw fa-home"></i>
        <span>Home</span></a>
    </li>
    <li class="nav-item {{ request()->path() == 'dashboard' ? 'active' : '' }}">
      <a class="nav-link " href="{{ route('dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>
    <li class="nav-item {{ request()->path() == 'orders' ? 'active' : '' }}">
      <a class="nav-link " href="{{ route('orders') }}">
        <i class="fas fa-fw fa-clipboard-list"></i>
        <span>Pesanan</span></a>
    </li>
    <li class="nav-item {{ request()->path() == 'users' ? 'active' : '' }}">
      <a class="nav-link " href="{{ route('users') }}">
        <i class="fas fa-fw fa-users-cog"></i>
        <span>Admin</span></a>
    </li>
    <li class="nav-item {{ request()->path() == 'payments' ? 'active' : '' }}">
      <a class="nav-link " href="{{ route('payment') }}">
        <i class="fas fa-fw fa-money-bill-wave"></i>
        <span>Metode Pembayaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>