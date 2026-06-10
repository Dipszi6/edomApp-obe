<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <style>
        :root {
            --bg:            #0d1117;
            --bg-card:       #161b22;
            --bg-elevated:   #1c2333;
            --sidebar-w:     240px;
            --topbar-h:      56px;
            --canary:        #fcd34d;
            --canary-dim:    rgba(252,211,77,0.12);
            --canary-border: rgba(252,211,77,0.28);
            --purple:        #a855f7;
            --purple-dim:    rgba(168,85,247,0.12);
            --emerald:       #34d399;
            --emerald-dim:   rgba(52,211,153,0.12);
            --blue:          #60a5fa;
            --blue-dim:      rgba(96,165,250,0.12);
            --red-dim:       rgba(239,68,68,0.12);
            --border:        rgba(255,255,255,0.07);
            --border-hover:  rgba(255,255,255,0.13);
            --text:          #f0f6fc;
            --text-muted:    #7d8590;
            --text-sub:      #8b949e;
            --radius-sm:     8px;
            --radius-md:     12px;
            --radius-lg:     16px;
            --radius-xl:     20px;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        a    { text-decoration: none; color: inherit; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            font-size: 14px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ════ SIDEBAR ════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            padding: 1.25rem 0.75rem;
            z-index: 200; overflow-y: auto;
        }

        .sidebar-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 1.1rem;
            color: var(--text);
            padding: 0 0.5rem; margin-bottom: 1.5rem; display: block;
        }
        .sidebar-logo span { color: var(--canary); }

        .sidebar-user {
            display: flex; align-items: center; gap: 0.65rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 0.6rem 0.75rem; margin-bottom: 1.5rem;
        }

        .sidebar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 0.75rem;
            color: #fff; flex-shrink: 0;
        }

        .sidebar-user-name { font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-user-role { font-size: 0.68rem; color: var(--canary); text-transform: capitalize; }

        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.09em; text-transform: uppercase;
            color: var(--text-muted); padding: 0 0.5rem;
            margin: 0.75rem 0 0.4rem; display: block;
        }

        .sidebar-item {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.55rem 0.75rem; border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 500; color: var(--text-sub);
            transition: background 0.18s, color 0.18s;
            cursor: pointer; border: none; background: none;
            width: 100%; text-align: left; font-family: 'Poppins', sans-serif;
        }
        .sidebar-item:hover { background: var(--bg-elevated); color: var(--text); }
        .sidebar-item.active { background: var(--canary-dim); color: var(--canary); border: 1px solid var(--canary-border); }
        .sidebar-item.danger { color: #ef4444; }
        .sidebar-item.danger:hover { background: var(--red-dim); }
        .sidebar-icon { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-bottom { margin-top: auto; padding-top: 1rem; }

        /* ════ MAIN ════ */
        .dashboard-main {
            margin-left: var(--sidebar-w);
            flex: 1; display: flex; flex-direction: column; min-height: 100vh;
        }

        /* ─ TOPBAR ─ */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            height: var(--topbar-h);
            background: rgba(13,17,23,0.88);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem; gap: 1rem;
        }

        .topbar-search { position: relative; flex: 1; max-width: 340px; }
        .topbar-search input {
            width: 100%; background: var(--bg-card);
            border: 1px solid var(--border); border-radius: var(--radius-md);
            padding: 0.4rem 0.9rem 0.4rem 2.2rem;
            color: var(--text); font-size: 0.8rem;
            font-family: 'Poppins', sans-serif;
            outline: none; transition: border-color 0.2s;
        }
        .topbar-search input::placeholder { color: var(--text-muted); }
        .topbar-search input:focus { border-color: var(--canary-border); }
        .topbar-search .s-icon {
            position: absolute; left: 0.65rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted); pointer-events: none; display: flex;
        }

        .topbar-right { display: flex; align-items: center; gap: 0.75rem; flex-shrink: 0; }
        .topbar-notif {
            width: 36px; height: 36px;
            background: var(--bg-card); border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-sub); transition: border-color 0.2s, color 0.2s;
        }
        .topbar-notif:hover { border-color: var(--border-hover); color: var(--text); }

        /* ─ PAGE BODY ─ */
        .page-body { flex: 1; padding: 1.75rem; display: flex; flex-direction: column; gap: 1.5rem; max-width: 720px; }

        /* ─ PAGE HEADER ─ */
        .page-header h1 {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem; font-weight: 800;
            letter-spacing: -0.02em; line-height: 1.2;
        }
        .page-header h1 span { color: var(--canary); }
        .page-header p { font-size: 0.83rem; color: var(--text-muted); margin-top: 0.25rem; }

        /* ─ PANEL ─ */
        .panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 1.35rem;
        }

        .panel-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 1.25rem; padding-bottom: 0.9rem;
            border-bottom: 1px solid var(--border);
        }

        .panel-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem; font-weight: 700;
            display: flex; align-items: center; gap: 0.5rem;
        }

        .panel-title-icon {
            width: 28px; height: 28px; border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
        }
        .ic-canary  { background: var(--canary-dim);  color: var(--canary); }
        .ic-purple  { background: var(--purple-dim);  color: var(--purple); }

        /* ─ AVATAR PREVIEW ─ */
        .avatar-preview {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem; background: var(--bg-elevated);
            border: 1px solid var(--border); border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
        }
        .avatar-lg {
            width: 52px; height: 52px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.1rem;
            color: #fff; flex-shrink: 0;
        }
        .avatar-info-name  { font-size: 0.9rem; font-weight: 700; }
        .avatar-info-email { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.1rem; }
        .role-badge {
            display: inline-block; margin-top: 0.35rem;
            font-size: 0.63rem; font-weight: 700;
            background: var(--canary-dim); border: 1px solid var(--canary-border);
            color: var(--canary); padding: 0.13rem 0.55rem; border-radius: 50px;
            text-transform: uppercase; letter-spacing: 0.05em;
        }

        /* ─ FORM ─ */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-grid .span-2 { grid-column: span 2; }
        .form-group { display: flex; flex-direction: column; gap: 0.4rem; }
        .form-group label { font-size: 0.75rem; font-weight: 600; color: var(--text-sub); letter-spacing: 0.02em; }

        .form-group input,
        .form-group select {
            width: 100%; background: var(--bg-elevated);
            border: 1px solid var(--border); border-radius: var(--radius-md);
            padding: 0.65rem 0.9rem; color: var(--text); font-size: 0.83rem;
            font-family: 'Poppins', sans-serif; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--canary-border);
            box-shadow: 0 0 0 3px rgba(252,211,77,0.08);
        }
        .form-group input::placeholder { color: var(--text-muted); }
        .form-group select option { background: #1c2333; color: var(--text); }

        .locked-field {
            background: var(--bg-elevated); border: 1px solid var(--border);
            border-radius: var(--radius-md); padding: 0.65rem 0.9rem;
            font-size: 0.83rem; color: var(--text-muted);
            display: flex; align-items: center; justify-content: space-between;
        }
        .locked-label {
            display: flex; align-items: center; gap: 0.3rem;
            font-size: 0.7rem; color: var(--text-muted);
        }

        .input-wrap { position: relative; }
        .input-wrap input { padding-right: 2.5rem; }
        .toggle-pw {
            position: absolute; right: 0.75rem; top: 50%;
            transform: translateY(-50%);
            background: transparent; border: none; cursor: pointer;
            color: var(--text-muted); display: flex; align-items: center;
            transition: color 0.18s;
        }
        .toggle-pw:hover { color: var(--text); }

        .error-text { font-size: 0.72rem; color: #f87171; margin-top: 0.1rem; }

        /* ─ BUTTON ─ */
        .btn-submit {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: var(--canary); color: #0d1117;
            font-weight: 700; font-size: 0.83rem;
            padding: 0.65rem 1.35rem; border-radius: var(--radius-md);
            border: none; cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: opacity 0.18s, transform 0.15s;
            margin-top: 1.25rem;
        }
        .btn-submit:hover { opacity: 0.85; transform: translateY(-1px); }

        /* ─ FLASH ─ */
        .flash-success {
            display: flex; align-items: center; gap: 0.5rem;
            padding: 0.75rem 1rem;
            background: var(--emerald-dim);
            border: 1px solid rgba(52,211,153,0.25);
            border-radius: var(--radius-md);
            color: var(--emerald); font-size: 0.83rem; font-weight: 500;
        }

        /* ─ FOOTER ─ */
        .footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.75rem;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(13,17,23,0.6);
            font-size: 0.75rem; color: var(--text-muted);
        }
        .footer-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 0.9rem; }
        .footer-logo span { color: var(--canary); }

        /* ─ RESPONSIVE ─ */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); transition: transform 0.28s ease; }
            .sidebar.open { transform: translateX(0); }
            .dashboard-main { margin-left: 0; }
            .hamburger {
                display: flex; align-items: center; justify-content: center;
                width: 36px; height: 36px;
                background: var(--bg-card); border: 1px solid var(--border);
                border-radius: var(--radius-sm); color: var(--text); cursor: pointer;
            }
            .sidebar-overlay {
                display: none; position: fixed; inset: 0;
                background: rgba(0,0,0,0.55); z-index: 199;
            }
            .sidebar-overlay.open { display: block; }
            .form-grid { grid-template-columns: 1fr; }
            .form-grid .span-2 { grid-column: span 1; }
            .topbar-search { display: none; }
            .page-body { padding: 1rem; }
        }
        @media (min-width: 769px) {
            .hamburger       { display: none; }
            .sidebar-overlay { display: none !important; }
        }
    </style>
</head>
<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ════ SIDEBAR ════ --}}
    <aside class="sidebar" id="sidebar">

        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>

        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name, 2, '') }}</div>
                <div class="sidebar-user-role">Mahasiswa</div>
            </div>
        </div>

        <span class="sidebar-section-label">Menu</span>

        <a href="{{ route('dashboard.mahasiswa') }}" class="sidebar-item">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="{{ route('dashboard.mahasiswa') }}#ulasan" class="sidebar-item">
            <i data-lucide="message-square" class="sidebar-icon"></i> Ulasan Saya
        </a>
        <a href="{{ route('review.create') }}" class="sidebar-item">
            <i data-lucide="pencil-line" class="sidebar-icon"></i> Tulis Ulasan
        </a>

        <span class="sidebar-section-label">Akun</span>

        <a href="{{ route('mahasiswa.settings') }}" class="sidebar-item active">
            <i data-lucide="settings" class="sidebar-icon"></i> Pengaturan
        </a>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="sidebar-item danger">
                    <i data-lucide="log-out" class="sidebar-icon"></i> Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- ════ MAIN ════ --}}
    <main class="dashboard-main">

        <div class="topbar">
            <button class="hamburger" id="hamburger" aria-label="Buka menu">
                <i data-lucide="menu" style="width:18px;height:18px;"></i>
            </button>
            <div class="topbar-search">
                <span class="s-icon"><i data-lucide="search" style="width:14px;height:14px;"></i></span>
                <input type="text" placeholder="Cari dosen atau mata kuliah...">
            </div>
            <div class="topbar-right">
                <a href="{{ route('dashboard.mahasiswa') }}#ulasan" class="topbar-notif">
                    <i data-lucide="bell" style="width:16px;height:16px;"></i>
                </a>
            </div>
        </div>

        <div class="page-body">

            <div class="page-header">
                <h1>Peng<span>aturan</span></h1>
                <p>Kelola informasi profil dan keamanan akun kamu.</p>
            </div>

            @if(session('success'))
            <div class="flash-success">
                <i data-lucide="check-circle" style="width:16px;height:16px;flex-shrink:0;"></i>
                {{ session('success') }}
            </div>
            @endif

            @if(session('success_password'))
            <div class="flash-success">
                <i data-lucide="check-circle" style="width:16px;height:16px;flex-shrink:0;"></i>
                {{ session('success_password') }}
            </div>
            @endif

            {{-- ── FORM PROFIL ── --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <div class="panel-title-icon ic-canary">
                            <i data-lucide="user" style="width:14px;height:14px;"></i>
                        </div>
                        Informasi Profil
                    </div>
                </div>

                <div class="avatar-preview">
                    <div class="avatar-lg">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div>
                        <div class="avatar-info-name">{{ Auth::user()->name }}</div>
                        <div class="avatar-info-email">{{ Auth::user()->email }}</div>
                        <span class="role-badge">Mahasiswa</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('mahasiswa.profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group span-2">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama lengkap kamu">
                            @error('name') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group span-2">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email aktif kamu">
                            @error('email') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>NIM</label>
                            <div class="locked-field">
                                {{ Auth::user()->nim ?? '—' }}
                                <span class="locked-label">
                                    <i data-lucide="lock" style="width:11px;height:11px;"></i> Terkunci
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Angkatan</label>
                            <div class="locked-field">
                                {{ Auth::user()->angkatan ?? '—' }}
                                <span class="locked-label">
                                    <i data-lucide="lock" style="width:11px;height:11px;"></i> Terkunci
                                </span>
                            </div>
                        </div>

                        <div class="form-group span-2">
                            <label>Jurusan</label>
                            <select name="jurusan_id">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" @selected(old('jurusan_id', Auth::user()->jurusan_id) == $jurusan->id)>
                                    {{ $jurusan->nama }}
                                </option>
                                @endforeach
                            </select>
                            @error('jurusan_id') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn-submit">
                        <i data-lucide="save" style="width:14px;height:14px;"></i>
                        Simpan Perubahan
                    </button>

                </form>
            </div>

            {{-- ── FORM PASSWORD ── --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="panel-title">
                        <div class="panel-title-icon ic-purple">
                            <i data-lucide="lock" style="width:14px;height:14px;"></i>
                        </div>
                        Ubah Password
                    </div>
                </div>

                <form method="POST" action="{{ route('mahasiswa.password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">

                        <div class="form-group span-2">
                            <label>Password Lama</label>
                            <div class="input-wrap">
                                <input type="password" name="current_password" id="current_password" placeholder="Masukkan password lama">
                                <button type="button" class="toggle-pw" onclick="togglePassword('current_password', this)">
                                    <i data-lucide="eye" style="width:15px;height:15px;"></i>
                                </button>
                            </div>
                            @error('current_password') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password Baru</label>
                            <div class="input-wrap">
                                <input type="password" name="password" id="new_password" placeholder="Minimal 8 karakter">
                                <button type="button" class="toggle-pw" onclick="togglePassword('new_password', this)">
                                    <i data-lucide="eye" style="width:15px;height:15px;"></i>
                                </button>
                            </div>
                            @error('password') <span class="error-text">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <div class="input-wrap">
                                <input type="password" name="password_confirmation" id="confirm_password" placeholder="Ulangi password baru">
                                <button type="button" class="toggle-pw" onclick="togglePassword('confirm_password', this)">
                                    <i data-lucide="eye" style="width:15px;height:15px;"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn-submit">
                        <i data-lucide="key-round" style="width:14px;height:14px;"></i>
                        Perbarui Password
                    </button>

                </form>
            </div>

        </div>

        <footer class="footer">
            <div class="footer-logo">EDOM<span> UPS </span>Tegal</div>
            <p>© {{ date('Y') }} EDOM-UPSTEGAL · Mahasiswa Dashboard</p>
        </footer>

    </main>

    <script>
        lucide.createIcons();

        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.innerHTML = isPassword
                ? '<i data-lucide="eye-off" style="width:15px;height:15px;"></i>'
                : '<i data-lucide="eye" style="width:15px;height:15px;"></i>';
            lucide.createIcons();
        }

        const hamburger      = document.getElementById('hamburger');
        const sidebar        = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar()  { sidebar.classList.add('open'); sidebarOverlay.classList.add('open'); }
        function closeSidebar() { sidebar.classList.remove('open'); sidebarOverlay.classList.remove('open'); }

        if (hamburger)      hamburger.addEventListener('click', openSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
    </script>

</body>
</html>