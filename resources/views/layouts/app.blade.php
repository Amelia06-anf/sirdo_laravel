<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIRDO') - SIRDO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=laravel1">
</head>
<body class="dashboard-page">
<div class="app-shell">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img class="sidebar-logo" src="{{ asset('assets/images/logo.png') }}" alt="Logo BRI">
            <div><strong>BRI</strong><span>UNIT PUSAKARATU</span></div>
        </div>
        <nav class="sidebar-nav" aria-label="Navigasi utama">
            <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><span class="nav-icon">⌂</span> Dashboard</a>
            <a class="{{ request()->routeIs('registrasi.*') ? 'active' : '' }}" href="{{ route('registrasi.index') }}"><span class="nav-icon">＋</span> Registrasi Berkas <span class="nav-arrow">›</span></a>
            <a class="{{ request()->routeIs('dokumen.*') ? 'active' : '' }}" href="{{ route('dokumen.index') }}"><span class="nav-icon">▤</span> Data Dokumen</a>
            <a class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}"><span class="nav-icon">▥</span> Laporan</a>
        </nav>
    </aside>
    <button class="sidebar-backdrop" type="button" aria-label="Tutup menu"></button>

    <div class="app-main">
        <header class="topbar">
            <button class="menu-toggle" type="button" aria-label="Buka menu">☰</button>
            <div class="page-heading">
                <h1>@yield('title')</h1>
                <span>@yield('subtitle')</span>
            </div>
            <div class="profile-menu">
                <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->nama_petugas, 0, 1)) }}</div>
                <div><strong>{{ auth()->user()->nama_petugas }}</strong><span>Staff Arsip</span></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" title="Keluar" style="width:auto;min-height:auto;margin:0;padding:0;background:transparent;color:#7a8599;font-size:20px">↪</button>
                </form>
            </div>
        </header>
        <main class="dashboard-content registration-content">
            @if (session('success'))
                <div class="success-alert">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="dashboard-alert">{{ $errors->first() }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
<script>
    const menuButton = document.querySelector('.menu-toggle');
    const backdrop = document.querySelector('.sidebar-backdrop');
    const toggleMenu = () => document.body.classList.toggle('nav-open');
    menuButton?.addEventListener('click', toggleMenu);
    backdrop?.addEventListener('click', toggleMenu);
</script>
@stack('scripts')
</body>
</html>
