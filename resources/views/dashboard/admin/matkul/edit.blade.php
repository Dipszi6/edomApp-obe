<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah - EDOM UPS Tegal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css'
    ])

    <style>
        .sidebar-icon { width: 18px; height: 18px; stroke-width: 2; vertical-align: middle; margin-right: 4px; }
        .form-label { display: block; margin-bottom: .5rem; font-size: .85rem; font-weight: 600; color: rgba(255, 255, 255, .8); }
        .form-control { width: 100%; padding: .9rem 1rem; border-radius: 12px; border: 1px solid rgba(255, 255, 255, .08); background: rgba(255, 255, 255, .03); color: white; outline: none; transition: .25s; }
        .form-control:focus { border-color: var(--canary); box-shadow: 0 0 0 3px rgba(252, 211, 77, .15); }
        .form-control::placeholder { color: rgba(255, 255, 255, .35); }
    </style>
</head>

<body class="dashboard-body">

    <div class="orb orb-1" style="position:fixed;z-index:0;"></div>
    <div class="orb orb-2" style="position:fixed;z-index:0;"></div>

    <aside class="sidebar">
        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name, 2, '') }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>

        <span class="sidebar-section-label">Manajemen</span>
        <a href="{{ route('dashboard.admin') }}" class="sidebar-item"><i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard</a>
        <a href="{{ route('matkul.index') }}" class="sidebar-item active"><i data-lucide="book-open" class="sidebar-icon"></i> Kelola Matkul</a>
        <a href="{{ route('users.index') }}" class="sidebar-item"><i data-lucide="users" class="sidebar-icon"></i> Kelola User</a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item danger" style="width:100%;border:none;background:none;text-align:left;cursor:pointer;">
                    <i data-lucide="log-out" class="sidebar-icon"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    <main class="dashboard-main">
        <div class="page-header fade-up">
            <h1>Edit <span>Mata Kuliah</span></h1>
            <p>Perbarui informasi mata kuliah yang terdaftar pada platform EDOM.</p>
        </div>

        @if ($errors->any())
            <div class="flash-success fade-up" style="background:rgba(239,68,68,.12); border:1px solid rgba(239,68,68,.2); color:#fca5a5; margin-bottom:1rem;">
                <ul style="margin:0;padding-left:1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="panel fade-up">
            <div class="panel-header">
                <div>
                    <div class="panel-title">Form Edit Mata Kuliah</div>
                    <div class="panel-subtitle">Silakan perbarui data mata kuliah di bawah ini.</div>
                </div>
            </div>

            <div class="panel-body">
                <form action="{{ route('matkul.update', $matkul->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:1rem;">
                        {{-- Input disesuaikan dengan Model (kode, nama, sks, semester) --}}
                        <div>
                            <label class="form-label">Kode Mata Kuliah</label>
                            <input type="text" name="kode" value="{{ old('kode', $matkul->kode) }}" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Nama Mata Kuliah</label>
                            <input type="text" name="nama" value="{{ old('nama', $matkul->nama) }}" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Jumlah SKS</label>
                            <input type="number" name="sks" value="{{ old('sks', $matkul->sks) }}" class="form-control" required>
                        </div>
                        <div>
                            <label class="form-label">Semester</label>
                            <input type="number" name="semester" value="{{ old('semester', $matkul->semester) }}" class="form-control" required>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:.75rem; margin-top:2rem;">
                        <a href="{{ route('matkul.index') }}" style="display:flex; align-items:center; gap:.5rem; padding:.8rem 1.2rem; border-radius:12px; border:1px solid rgba(255,255,255,.08); color:rgba(255,255,255,.7); text-decoration:none; font-weight:600;">
                            <i data-lucide="arrow-left" style="width:16px;height:16px;"></i> Kembali
                        </a>
                        <button type="submit" style="display:flex; align-items:center; gap:.5rem; padding:.8rem 1.2rem; border:none; border-radius:12px; background:var(--canary); color:#111; font-weight:700; cursor:pointer;">
                            <i data-lucide="save" style="width:16px;height:16px;"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => { entry.target.classList.add('visible'); }, i * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.08 });
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>