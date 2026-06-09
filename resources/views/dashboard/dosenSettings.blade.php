<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css',
        'resources/js/home.js'
    ])
</head>
<body class="dashboard-body">

    <div class="orb orb-1" style="position:fixed;z-index:0;"></div>
    <div class="orb orb-2" style="position:fixed;z-index:0;"></div>

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="sidebar">

        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>

        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name, 2, '') }}</div>
                <div class="sidebar-user-role">{{ Auth::user()->role }}</div>
            </div>
        </div>

        <span class="sidebar-section-label">Menu</span>

        <a href="{{ route('dashboard.dosen') }}" class="sidebar-item">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="/dosen/{{ $dosen->id }}" class="sidebar-item">
            <i data-lucide="user-circle" class="sidebar-icon"></i> Profil Dosen
        </a>
        <a href="{{ route('dashboard.dosen') }}#ulasan" class="sidebar-item">
            <i data-lucide="message-square" class="sidebar-icon"></i> Ulasan Saya
        </a>
        <a href="{{ route('dashboard.dosen') }}#statistik" class="sidebar-item">
            <i data-lucide="bar-chart-2" class="sidebar-icon"></i> Statistik Saya
        </a>
        <a href="{{ route('dashboard.dosen') }}#matkul" class="sidebar-item">
            <i data-lucide="book-open" class="sidebar-icon"></i> Mata Kuliah
        </a>

        <span class="sidebar-section-label">Lainnya</span>

        <a href="#" class="sidebar-item">
            <i data-lucide="bell" class="sidebar-icon"></i> Notifikasi
        </a>
        <a href="{{ route('dosen.settings') }}" class="sidebar-item active">
            <i data-lucide="settings" class="sidebar-icon"></i> Pengaturan
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item danger" style="width:100%;">
                    <i data-lucide="log-out" class="sidebar-icon"></i> Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main class="dashboard-main">

        {{-- Page Header --}}
        <div class="page-header fade-up">
            <h1>Peng<span>aturan</span></h1>
            <p>Kelola informasi profil dan keamanan akun kamu.</p>
        </div>

        <div style="display:flex;flex-direction:column;gap:1.5rem;max-width:680px;">

            {{-- Flash success profil --}}
            @if(session('success'))
            <div class="flash-success fade-up">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <i data-lucide="check-circle" style="width:16px;height:16px;"></i>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            {{-- Flash success password --}}
            @if(session('success_password'))
            <div class="flash-success fade-up">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <i data-lucide="check-circle" style="width:16px;height:16px;"></i>
                    {{ session('success_password') }}
                </div>
            </div>
            @endif

            {{-- ── FORM PROFIL ── --}}
            <div class="panel fade-up">
                <div class="panel-header">
                    <div class="panel-title">
                        <div style="display:flex;align-items:center;gap:0.6rem;">
                            <i data-lucide="user" style="width:16px;height:16px;color:var(--canary);"></i>
                            Informasi Profil
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    {{-- Avatar preview --}}
                    <div style="display:flex;align-items:center;gap:1.25rem;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid rgba(255,255,255,0.06);">
                        <div style="
                            width:64px;height:64px;border-radius:16px;
                            background:linear-gradient(135deg,var(--deep-navy),var(--navy-mid));
                            border:2px solid rgba(255,246,78,0.25);
                            display:flex;align-items:center;justify-content:center;
                            font-family:'Poppins',sans-serif;font-weight:800;font-size:1.5rem;
                            color:var(--canary);
                        ">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:0.95rem;">{{ Auth::user()->name }}</div>
                            <div style="font-size:0.8rem;color:rgba(255,255,255,0.4);margin-top:0.2rem;">{{ Auth::user()->email }}</div>
                            <span style="
                                display:inline-block;margin-top:0.4rem;
                                padding:0.2rem 0.65rem;
                                background:rgba(255,246,78,0.1);
                                border:1px solid rgba(255,246,78,0.2);
                                border-radius:999px;
                                font-size:0.7rem;color:var(--canary);font-weight:600;
                                text-transform:capitalize;
                            ">{{ Auth::user()->role }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('dosen.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name"
                                value="{{ old('name', Auth::user()->name) }}"
                                placeholder="Nama lengkap">
                            @error('name')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email"
                                value="{{ old('email', Auth::user()->email) }}"
                                placeholder="Email aktif">
                            @error('email')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gelar Akademik</label>
                            <input type="text" name="gelar"
                                value="{{ old('gelar', $dosen->gelar) }}"
                                placeholder="Contoh: S.Kom., M.T.">
                            @error('gelar')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jurusan</label>
                            <select name="jurusan_id">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    @selected(old('jurusan_id', $dosen->jurusan_id) == $jurusan->id)>
                                    {{ $jurusan->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn-login" style="margin-top:0.5rem;">
                            Simpan Perubahan
                        </button>

                    </form>
                </div>
            </div>

            {{-- ── FORM PASSWORD ── --}}
            <div class="panel fade-up">
                <div class="panel-header">
                    <div class="panel-title">
                        <div style="display:flex;align-items:center;gap:0.6rem;">
                            <i data-lucide="lock" style="width:16px;height:16px;color:var(--canary);"></i>
                            Ubah Password
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <form method="POST" action="{{ route('dosen.password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Password Lama</label>
                            <div style="position:relative;">
                                <input type="password" name="current_password"
                                    placeholder="Masukkan password lama"
                                    id="current_password"
                                    style="padding-right:3rem;">
                                <button type="button" onclick="togglePassword('current_password', this)"
                                    style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:transparent;border:none;cursor:pointer;color:rgba(255,255,255,0.4);display:flex;align-items:center;">
                                    <i data-lucide="eye" style="width:16px;height:16px;"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <div style="position:relative;">
                                <input type="password" name="password"
                                    placeholder="Minimal 8 karakter"
                                    id="new_password"
                                    style="padding-right:3rem;">
                                <button type="button" onclick="togglePassword('new_password', this)"
                                    style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:transparent;border:none;cursor:pointer;color:rgba(255,255,255,0.4);display:flex;align-items:center;">
                                    <i data-lucide="eye" style="width:16px;height:16px;"></i>
                                </button>
                            </div>
                            @error('password')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div style="position:relative;">
                                <input type="password" name="password_confirmation"
                                    placeholder="Ulangi password baru"
                                    id="confirm_password"
                                    style="padding-right:3rem;">
                                <button type="button" onclick="togglePassword('confirm_password', this)"
                                    style="position:absolute;right:1rem;top:50%;transform:translateY(-50%);background:transparent;border:none;cursor:pointer;color:rgba(255,255,255,0.4);display:flex;align-items:center;">
                                    <i data-lucide="eye" style="width:16px;height:16px;"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-login" style="margin-top:0.5rem;">
                            Perbarui Password
                        </button>

                    </form>
                </div>
            </div>

        </div>

    </main>

    <script>
        lucide.createIcons();

        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.innerHTML = isPassword
                ? '<i data-lucide="eye-off" style="width:16px;height:16px;"></i>'
                : '<i data-lucide="eye" style="width:16px;height:16px;"></i>';
            lucide.createIcons();
        }

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>

</body>
</html>