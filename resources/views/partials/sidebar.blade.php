<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{asset('img/logofix-removebg-preview.png')}}" class="ml-auto" width="40" alt="">
            <a href="#" id="name"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="#" id="name-2"></a>
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
        <li class="{{request()->is('settings*') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('settings')}}"><i class="fas fa-cog"></i> <span> Pengaturan</span></a>
        </li>
    </aside>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $.getJSON('/settings/getSekolah', function(data) {
                let result = data[0];
                $("#name").html(result.nm_sekolah);
                let text = result.nm_sekolah;
                $("#name-2").html(ambilHurufAwal(text))
            })
            function ambilHurufAwal(text) {
                var kataKata = text.split(' ');
                var hurufAwal = '';
                for (var i = 0; i < kataKata.length; i++) {
                    hurufAwal += kataKata[i][0];
                }
                return hurufAwal;
            }
        })
    </script>
@endpush
