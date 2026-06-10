<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Kuliah - EDOM UPS Tegal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css'
    ])

    <style>
        .sidebar-icon {
            width: 18px;
            height: 18px;
            stroke-width: 2;
            vertical-align: middle;
            margin-right: 4px;
        }

        .stat-card-icon svg {
            width: 28px;
            height: 28px;
            stroke-width: 1.75;
            color: var(--canary, #fcd34d);
        }
    </style>
</head>

<body class="dashboard-body">

    <div class="orb orb-1" style="position:fixed;z-index:0;"></div>
    <div class="orb orb-2" style="position:fixed;z-index:0;"></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <a href="/" class="sidebar-logo">
            EDOM<span> UPS </span>Tegal
        </a>

        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="sidebar-user-info">
                <div class="sidebar-user-name">
                    {{ Str::words(Auth::user()->name, 2, '') }}
                </div>

                <div class="sidebar-user-role">
                    Administrator
                </div>
            </div>
        </div>

        <span class="sidebar-section-label">
            Manajemen
        </span>

        <a href="{{ route('dashboard.admin') }}" class="sidebar-item">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i>
            Dashboard
        </a>

        <a href="{{ route('dashboard.admin') }}#ulasan" class="sidebar-item">
            <i data-lucide="message-square-dashed" class="sidebar-icon"></i>
            Moderasi Ulasan
        </a>

        <a href="{{ route('matkul.index') }}" class="sidebar-item active">
            <i data-lucide="book-open" class="sidebar-icon"></i>
            Kelola Matkul
        </a>

        <a href="{{ route('users.index') }}" class="sidebar-item">
            <i data-lucide="users" class="sidebar-icon"></i>
            Kelola User
        </a>

        <span class="sidebar-section-label">
            Sistem
        </span>

        <a href="#" class="sidebar-item">
            <i data-lucide="settings" class="sidebar-icon"></i>
            Pengaturan
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="sidebar-item danger" style="
                        width:100%;
                        border:none;
                        cursor:pointer;
                        background:none;
                        text-align:left;
                    ">
                    <i data-lucide="log-out" class="sidebar-icon"></i>
                    Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="dashboard-main">

        {{-- TOPBAR --}}
        <div class="topbar">
            <div class="topbar-right">
                <span class="badge badge-yellow">
                    {{ $matkuls->total() }} Mata Kuliah
                </span>
            </div>
        </div>

        {{-- FLASH --}}
        @if(session('success'))
            <div class="flash-success fade-up" style="
                            display:flex;
                            align-items:center;
                            gap:.5rem;
                        ">
                <i data-lucide="check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- HEADER --}}
        <div class="page-header fade-up">
            <h1>Kelola <span>Mata Kuliah</span></h1>
            <p>Manajemen seluruh mata kuliah yang tersedia pada platform EDOM.</p>
        </div>

        {{-- STAT CARD --}}
        <div class="stat-grid fade-up">

            <div class="stat-card">
                <div class="stat-card-icon">
                    <i data-lucide="book-open"></i>
                </div>

                <div class="stat-card-info">
                    <div class="stat-card-label">
                        Total Mata Kuliah
                    </div>

                    <div class="stat-card-value">
                        {{ $matkuls->total() }}
                    </div>

                    <div class="stat-card-sub">
                        Terdaftar di sistem
                    </div>
                </div>
            </div>

        </div>

        {{-- PANEL --}}
        <div class="panel fade-up">

            <div class="panel-header">

                <div>
                    <div class="panel-title">
                        Daftar Mata Kuliah
                    </div>

                    <div class="panel-subtitle">
                        Kelola seluruh data mata kuliah yang tersedia.
                    </div>
                </div>

                <a href="{{ route('matkul.create') }}" style="
            display:flex;
            align-items:center;
            gap:.6rem;
            padding:.8rem 1.1rem;
            border-radius:12px;
            background:var(--canary);
            color:#111;
            font-weight:700;
            text-decoration:none;
            box-shadow:0 4px 12px rgba(252,211,77,.15);
            transition:.25s ease;
        ">

                    <i data-lucide="plus" style="
                width:18px;
                height:18px;
            ">
                    </i>

                    <span>Tambah Mata Kuliah</span>

                </a>

            </div>

            <div class="panel-body">

                @forelse($matkuls as $matkul)

                        <div class="matkul-row">

                            <div style="
                        display:flex;
                        align-items:center;
                        gap:.75rem;
                    ">

                                <div class="sidebar-avatar" style="
                                width:42px;
                                height:42px;
                                border-radius:10px;
                                font-size:.95rem;
                            ">
                                    {{ strtoupper(substr($matkul->nama_matkul ?? $matkul->nama, 0, 1)) }}
                                </div>

                                <div>

                                    <div class="matkul-name">
                                        {{ $matkul->nama_matkul ?? $matkul->nama }}
                                    </div>

                                    <div class="matkul-sub">
                                        {{ $matkul->kode_matkul ?? $matkul->kode }}
                                        • {{ $matkul->sks }} SKS
                                        • Semester {{ $matkul->semester }}
                                    </div>

                                </div>

                            </div>

                            <div style="
                        display:flex;
                        align-items:center;
                        gap:.6rem;
                    ">

                                <a href="{{ route('matkul.edit', $matkul->id) }}" style="
                                display:flex;
                                align-items:center;
                                gap:.45rem;
                                padding:.55rem .9rem;
                                border-radius:10px;
                                background:rgba(59,130,246,.12);
                                border:1px solid rgba(59,130,246,.2);
                                color:#93c5fd;
                                text-decoration:none;
                                font-size:.8rem;
                                font-weight:600;
                                transition:.25s;
                            ">

                                    <i data-lucide="square-pen" style="
                                    width:15px;
                                    height:15px;
                                ">
                                    </i>

                                    Edit

                                </a>

                                <form action="{{ route('matkul.destroy', $matkul->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')"
                                        style="
                                    display:flex;
                                    align-items:center;
                                    gap:.45rem;
                                    padding:.55rem .9rem;
                                    border-radius:10px;
                                    background:rgba(239,68,68,.12);
                                    border:1px solid rgba(239,68,68,.2);
                                    color:#fca5a5;
                                    cursor:pointer;
                                    font-size:.8rem;
                                    font-weight:600;
                                    transition:.25s;
                                ">

                                        <i data-lucide="trash-2" style="
                                        width:15px;
                                        height:15px;
                                    ">
                                        </i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </div>

                @empty

                            <div style="
                        text-align:center;
                        padding:4rem 0;
                        opacity:.55;
                    ">

                                <i data-lucide="book-open" style="
                                width:42px;
                                height:42px;
                                margin-bottom:1rem;
                            ">
                                </i>

                                <p>
                                    Belum ada mata kuliah yang terdaftar.
                                </p>

                            </div>

                @endforelse

                @if($matkuls->hasPages())
                            <div style="
                        margin-top:1.5rem;
                        display:flex;
                        justify-content:center;
                    ">
                                {{ $matkuls->links() }}
                            </div>
                @endif

            </div>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            lucide.createIcons();

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {

                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, i * 80);

                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.08
            });

            document
                .querySelectorAll('.fade-up')
                .forEach(el => observer.observe(el));

        });
    </script>

</body>

</html>