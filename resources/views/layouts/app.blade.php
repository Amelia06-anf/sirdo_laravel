<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIRDO') - SIRDO</title>
    <script>
        document.documentElement.dataset.theme = localStorage.getItem('sirdo-theme') || 'light';
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=ui-modern-6">
</head>
<body class="dashboard-page">
<div class="app-shell">
    <aside class="sidebar">
        <div class="sidebar-brand">
            <img class="sidebar-logo" src="{{ asset('assets/images/logo.png') }}" alt="Logo BRI">
            <div><strong>BRI</strong><span>UNIT PUSAKARATU</span></div>
        </div>
        <nav class="sidebar-nav" aria-label="Navigasi utama">
            <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span class="nav-icon" aria-hidden="true">
                    <svg class="nav-svg" viewBox="0 0 24 24"><path d="M3 10.8 12 3l9 7.8v9.7a.8.8 0 0 1-.8.8h-5.1v-6.7H8.9v6.7H3.8a.8.8 0 0 1-.8-.8z"/></svg>
                </span>
                Dashboard
            </a>
            <a class="{{ request()->routeIs('registrasi.*') ? 'active' : '' }}" href="{{ route('registrasi.index') }}">
                <span class="nav-icon" aria-hidden="true">
                    <svg class="nav-svg" viewBox="0 0 24 24"><path d="M4 7.4A2.4 2.4 0 0 1 6.4 5h3.2l2 2h6A2.4 2.4 0 0 1 20 9.4v7.2a2.4 2.4 0 0 1-2.4 2.4H6.4A2.4 2.4 0 0 1 4 16.6z"/><path d="M12 10.5v5M9.5 13h5"/></svg>
                </span>
                Registrasi Berkas <span class="nav-arrow">›</span>
            </a>
            <a class="{{ request()->routeIs('dokumen.*') ? 'active' : '' }}" href="{{ route('dokumen.index') }}">
                <span class="nav-icon" aria-hidden="true">
                    <svg class="nav-svg" viewBox="0 0 24 24"><path d="M7 3.8h7.2L19 8.6v11.6H7z"/><path d="M14 3.8v5h5M10 12.2h6M10 15.5h6"/></svg>
                </span>
                Data Dokumen
            </a>
            <a class="{{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
                <span class="nav-icon" aria-hidden="true">
                    <svg class="nav-svg" viewBox="0 0 24 24"><path d="M5 19.5V5M10 19.5v-7.2M15 19.5V8.2M20 19.5v-4.8"/><path d="M3.5 19.5h18"/></svg>
                </span>
                Laporan
            </a>
        </nav>
    </aside>
    <button class="sidebar-backdrop" type="button" aria-label="Tutup menu"></button>

    <div class="app-main">
        <header class="topbar">
            <button class="menu-toggle" type="button" aria-label="Buka menu">
                <svg class="topbar-svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </button>
            <div class="page-heading">
                <h1>@yield('title')</h1>
                <span>@yield('subtitle')</span>
            </div>
            <button class="theme-toggle" type="button" aria-label="Ganti mode tampilan">
                <span class="theme-icon theme-sun" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M12 5.4V3M12 21v-2.4M18.6 5.4l-1.7 1.7M7.1 16.9l-1.7 1.7M21 12h-2.4M5.4 12H3M18.6 18.6l-1.7-1.7M7.1 7.1 5.4 5.4"/><circle cx="12" cy="12" r="4"/></svg>
                </span>
                <span class="theme-icon theme-moon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M19.5 14.3A7.6 7.6 0 0 1 9.7 4.5 8.3 8.3 0 1 0 19.5 14.3z"/></svg>
                </span>
            </button>
            <div class="profile-menu">
                <div class="profile-avatar">{{ strtoupper(substr(auth()->user()->nama_petugas, 0, 1)) }}</div>
                <div><strong>{{ auth()->user()->nama_petugas }}</strong><span>Staff Arsip</span></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-button" type="submit" title="Keluar" aria-label="Keluar">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15.5 7.5 20 12l-4.5 4.5M20 12H9.5"/><path d="M12 19H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h7"/></svg>
                    </button>
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
    const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
    const toggleMenu = () => document.body.classList.toggle('nav-open');
    menuButton?.addEventListener('click', toggleMenu);
    backdrop?.addEventListener('click', toggleMenu);
    sidebarLinks.forEach((link) => {
        link.addEventListener('click', () => document.body.classList.remove('nav-open'));
    });

    const themeButton = document.querySelector('.theme-toggle');
    const setThemeLabel = () => {
        const theme = document.documentElement.dataset.theme || 'light';
        themeButton?.classList.toggle('is-dark', theme === 'dark');
        themeButton?.setAttribute('aria-label', theme === 'dark' ? 'Aktifkan mode terang' : 'Aktifkan mode gelap');
    };
    setThemeLabel();
    themeButton?.addEventListener('click', () => {
        const nextTheme = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
        document.documentElement.dataset.theme = nextTheme;
        localStorage.setItem('sirdo-theme', nextTheme);
        setThemeLabel();
    });
</script>
@stack('scripts')
</body>
</html>
