<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{asset('img/logofix-removebg-preview.png')}}" class="ml-auto" width="40" alt="">
            <a href="#">BKK SMKN TANJUNG SARI</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">TJSR</a>
        </div>
        <ul class="sidebar-menu">
        <li class="menu-header">Admin</li>
        <li class="{{request()->is('dashboard') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('dashboard')}}"><i class="fas fa-fire"></i> <span> Dashboard</span></a>
        </li>
        <li class="{{request()->is('data-alumni*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('alumni')}}"><i class="fas fa-users"></i> <span> Data Alumni</span></a>
        </li>
        <li class="{{request()->is('data-lokers*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.lokers')}}"><i class="fas fa-newspaper"></i> <span> Data Loker</span></a>
        </li>
    </aside>
</div>
