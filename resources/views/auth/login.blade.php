<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIRDO</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=laravel1">
</head>
<body>
<main class="login-page">
    <div class="login-card">
        <section class="login-brand">
            <div class="brand-content">
                <img class="brand-logo" src="{{ asset('assets/images/logo.png') }}" alt="Logo BRI">
                <h1>BRI</h1>
                <p>Unit Pusakaratu</p>
            </div>
            <div class="building" aria-hidden="true">
                <span class="tower tower-one"></span><span class="tower tower-two"></span><span class="tower tower-three"></span>
                <span class="tree tree-one"></span><span class="tree tree-two"></span>
            </div>
        </section>

        <section class="login-form-area">
            <div class="form-content">
                <h2>Sistem Registrasi<br>Dokumen Keluar</h2>
                <p class="form-lead">Silakan masuk untuk melanjutkan</p>

                @if ($errors->any())
                    <div class="alert">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <label class="input-group" for="username">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 8a7 7 0 0 0-14 0h14Z"/></svg>
                        <input id="username" name="username" value="{{ old('username') }}" type="text" placeholder="Username" autocomplete="username" maxlength="50" required autofocus>
                    </label>
                    <label class="input-group" for="password">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 9h-1V7a4 4 0 0 0-8 0v2H7a2 2 0 0 0-2 2v8h14v-8a2 2 0 0 0-2-2Zm-7-2a2 2 0 0 1 4 0v2h-4V7Zm3 8.73V17h-2v-1.27a2 2 0 1 1 2 0Z"/></svg>
                        <input id="password" name="password" type="password" placeholder="Password" autocomplete="current-password" required>
                    </label>
                    <button type="submit">Masuk</button>
                </form>
            </div>
        </section>
    </div>
    <footer><p>&copy; 2026 PT Bank Rakyat Indonesia (Persero) Tbk</p><span>Unit Pusakaratu</span></footer>
</main>
</body>
</html>
