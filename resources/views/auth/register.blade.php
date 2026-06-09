<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - EDOM UPS Tegal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">

    @vite([
        'resources/css/home.css',
        'resources/js/home.js'
    ])
</head>

<body>

    {{-- Background --}}
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

    <section class="auth-section">

        <div class="auth-card auth-card-lg fade-up">

            <div class="auth-header">

                <span class="section-label">
                    REGISTRASI
                </span>

                <h1 class="auth-title">
                    Bergabung dengan <span>EDOM</span>
                </h1>

                <p class="auth-subtitle">
                    Buat akun mahasiswa untuk memberikan ulasan dosen dan mata kuliah secara anonim.
                </p>

            </div>

            <form method="POST" action="{{ route('register') }}">

                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama lengkap"
                        required
                    >

                    @error('name')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                {{-- NIM --}}
                <div class="form-group">
                    <label>NIM</label>

                    <input
                        type="text"
                        name="nim"
                        value="{{ old('nim') }}"
                        placeholder="Contoh: 230101001"
                        required
                    >

                    @error('nim')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label>Email Kampus</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@student.upstegal.ac.id"
                        required
                    >

                    @error('email')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Angkatan --}}
                <div class="form-group">
                    <label>Angkatan</label>

                    <input
                        type="number"
                        name="angkatan"
                        value="{{ old('angkatan') }}"
                        placeholder="2023"
                        required
                    >

                    @error('angkatan')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Jurusan --}}
                <div class="form-group">
                    <label>Jurusan</label>

                    <select name="jurusan_id" required>

                        <option value="">
                            Pilih Jurusan
                        </option>

                        @foreach($jurusans as $jurusan)

                            <option
                                value="{{ $jurusan->id }}"
                                @selected(old('jurusan_id') == $jurusan->id)
                            >
                                {{ $jurusan->nama }}
                            </option>

                        @endforeach

                    </select>

                    @error('jurusan_id')
                        <small class="error-text">{{ $message }}</small>
                    @enderror

                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Minimal 8 karakter"
                        required
                    >

                    @error('password')
                        <small class="error-text">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        required
                    >
                </div>

                <button type="submit" class="btn-login">
                    Daftar Sekarang →
                </button>

            </form>

            <div class="auth-footer">

                Sudah punya akun?

                <a href="{{ route('login') }}">
                    Masuk
                </a>

            </div>

        </div>

    </section>

</body>
</html>