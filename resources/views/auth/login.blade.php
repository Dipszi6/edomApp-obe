<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - EDOM UPS Tegal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;700&display=swap"
          rel="stylesheet">

    @vite([
        'resources/css/home.css',
        'resources/js/home.js'
    ])
</head>

<body>

    {{-- Background Orbs --}}
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    {{-- Navbar --}}
    <nav>
        <a href="/" class="nav-logo">
            EDOM<span> UPS </span>Tegal
        </a>

        <div class="nav-cta">
            <a href="/" class="btn-ghost">
                Beranda
            </a>
        </div>
    </nav>

    {{-- Login Section --}}
    <section class="auth-section">

        <div class="auth-card fade-up">

            <div class="auth-header">

                <span class="section-label">
                    SELAMAT DATANG
                </span>

                <h1 class="auth-title">
                    Masuk ke <span>EDOM</span>
                </h1>

                <p class="auth-subtitle">
                    Login untuk memberikan ulasan dan membantu mahasiswa lainnya.
                </p>

            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="auth-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                {{-- Email --}}
                <div class="form-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="email@kampus.ac.id"
                        required
                        autofocus
                    >

                    @error('email')
                        <small class="error-text">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- Password --}}
                <div class="form-group">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="••••••••"
                        required
                    >

                    @error('password')
                        <small class="error-text">
                            {{ $message }}
                        </small>
                    @enderror

                </div>

                {{-- Remember --}}
                <div class="remember-row">

                    <label class="remember-label">

                        <input
                            type="checkbox"
                            name="remember"
                        >

                        <span>
                            Ingat Saya
                        </span>

                    </label>

                    @if(Route::has('password.request'))

                        <a href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>

                    @endif

                </div>

                <button type="submit" class="btn-login">

                    Masuk →

                </button>

            </form>

            <div class="auth-footer">

                Belum punya akun?

                <a href="{{ route('register') }}">
                    Daftar Sekarang
                </a>

            </div>

        </div>

    </section>

</body>
</html>