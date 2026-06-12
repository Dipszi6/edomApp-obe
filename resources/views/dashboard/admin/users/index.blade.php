<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css'
    ])
    <style>
        /* Penyelarasan Ikon Lucide */
        .sidebar-icon {
            width: 18px;
            height: 18px;
            stroke-width: 2;
            vertical-align: middle;
            margin-right: 4px;
        }

        .topbar-search-icon,
        .topbar-notif lucide-icon {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        /* Sinkronisasi style custom form select & input dengan tema dashboard */
        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.15s ease;
        }

        .form-control:focus {
            border-color: var(--indigo, #4f46e5);
        }

        .select-control {
            width: 100%;
            background: #1e1b2e;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 0.9rem;
            outline: none;
            appearance: none;
            cursor: pointer;
        }

        .toolbar {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .toolbar form {
            flex: 1;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 12px;

            width: 100%;

            padding: 12px 16px;

            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);

            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;

            transition: all .2s ease;
        }

        .search-box:focus-within {
            border-color: var(--tropical-mint);
            box-shadow: 0 0 0 3px rgba(80, 255, 177, .15);
        }

        .search-box i {
            width: 18px;
            height: 18px;
            color: #d1d5db;
            flex-shrink: 0;
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;

            color: white;
            font-size: 15px;
        }

        .search-box input::placeholder {
            color: #9ca3af;
        }

        .btn-reset {
            padding: 12px 18px;

            background: rgba(255, 255, 255, .08);
            color: white;

            border: 1px solid rgba(255, 255, 255, .15);
            border-radius: 12px;

            text-decoration: none;
            font-weight: 500;

            transition: all .2s ease;
        }

        .btn-reset:hover {
            background: rgba(255, 255, 255, .15);
        }

                /* Styling Navigasi Halaman (Pagination) Dark Theme */
        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 1.5rem;
        }

        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 6px;
            font-size: 0.85rem;
            font-weight: 600;
            font-family: 'Quicksand', sans-serif;
            color: rgba(255, 255, 255, 0.7);
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        /* Ketika tombol nomor disorot mouse */
        .page-link:hover {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.4);
            color: #fbbf24;
        }

        /* Nomor halaman yang sedang aktif */
        .page-link.active {
            background: #fbbf24;
            border-color: #fbbf24;
            color: #1e1b2e;
            /* Teks gelap di atas background kuning emas */
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        }

        /* Ketika tombol next/prev tidak bisa diklik */
        .page-link.disabled {
            opacity: 0.25;
            cursor: not-allowed;
            background: rgba(255, 255, 255, 0.01);
            border-color: rgba(255, 255, 255, 0.04);
            color: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>

<body class="dashboard-body">

    <div class="orb orb-1" style="position:fixed;z-index:0;"></div>
    <div class="orb orb-2" style="position:fixed;z-index:0;"></div>

    {{-- ═══ SIDEBAR ═══ --}}
    <aside class="sidebar">
        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>

        <div class="sidebar-user">
            <div class="sidebar-avatar">A</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name, 2, '') }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>

        <span class="sidebar-section-label">Manajemen</span>
        <a href="{{ route('dashboard.admin') }}" class="sidebar-item">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="{{ route('dashboard.admin') }}#ulasan" class="sidebar-item">
            <i data-lucide="message-square-dashed" class="sidebar-icon"></i> Moderasi Ulasan
        </a>
        <span class="sidebar-section-label">Sistem</span>
        <a href="{{ route('matkul.index') }}" class="sidebar-item">
            <i data-lucide="book-open" class="sidebar-icon"></i> Kelola Matkul
        </a>
        <a href="{{ route('users.index') }}" class="sidebar-item active">
            <i data-lucide="users" class="sidebar-icon"></i> Kelola User
        </a>

        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-item danger"
                    style="width:100%; border:none; cursor:pointer; background:none; text-align:left;">
                    <i data-lucide="log-out" class="sidebar-icon"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- ═══ MAIN CONTENT ═══ --}}
    <main class="dashboard-main">

        {{-- Topbar --}}
        <div class="topbar">
            <div class="topbar-right">
                <a href="#" class="topbar-notif" style="display: flex; align-items: center; position: relative;">
                    <i data-lucide="bell"></i>
                </a>
            </div>
        </div>

        {{-- Flash Messaging Sistem --}}
        @if(session('success'))
            <div class="flash-success fade-up"
                style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem;">
                <i data-lucide="check-circle" style="width:16px; height:16px;"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-success fade-up"
                style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem; background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); color: #fca5a5;">
                <i data-lucide="alert-circle" style="width:16px; height:16px;"></i> {{ session('error') }}
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header fade-up">
            <h1>Kelola <span>Pengguna</span></h1>
            <p>Atur kredensial, buat user baru, hak akses role, serta penyesuaian akun platform EDOM.</p>
        </div>

        {{-- Content Grid Bersama (Kiri: Daftar Tabel & Form Edit | Kanan: Form Tambah) --}}
        <div class="content-grid fade-up">

            {{-- PANEL KIRI: Tabel Utama Pengguna & Ruang Form Edit Terpilih --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">

                @if(request()->routeIs('users.edit'))
                    {{-- Form Modul Edit User (Otomatis Aktif saat Aksi Edit Diklik) --}}
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Edit Data Pengguna: <span>{{ $user->name }}</span></div>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST"
                                style="display: flex; flex-direction: column; gap: 1.25rem;">
                                @csrf
                                @method('PUT')

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                        class="form-control" required>
                                    @error('name') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label
                                        style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Alamat
                                        Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="form-control" required>
                                    @error('email') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Hak
                                        Akses (Role)</label>
                                    <div style="position: relative;">
                                        <select name="role" class="select-control" required>
                                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="dosen" {{ old('role', $user->role) == 'dosen' ? 'selected' : '' }}>
                                                Dosen</option>
                                            <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                        </select>
                                        <div
                                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: rgba(255,255,255,0.4); display: flex;">
                                            <i data-lucide="chevron-down" style="width: 16px; height: 16px;"></i>
                                        </div>
                                    </div>
                                    @error('role') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div
                                    style="background: rgba(252,211,77,0.06); border: 1px solid rgba(252,211,77,0.15); padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.78rem; color: #fef08a; line-height: 1.5;">
                                    <strong>Info Keamanan:</strong> Biarkan password di bawah kosong jika Anda tidak
                                    berencana merubah sandi pengguna.
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Kata
                                        Sandi Baru (Opsional)</label>
                                    <input type="password" name="password" placeholder="Isi hanya jika ingin mereset sandi"
                                        class="form-control">
                                    @error('password') <span
                                    style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                </div>

                                <div
                                    style="display: flex; justify-content: flex-end; gap: 0.75rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.25rem;">
                                    <a href="{{ route('users.index') }}" class="btn-action btn-action-ghost"
                                        style="padding: 0.6rem 1.2rem; text-decoration: none; background: transparent; border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); display: inline-flex; align-items: center;">Batal</a>
                                    <button type="submit" class="btn-action"
                                        style="padding: 0.6rem 1.4rem; background: var(--indigo, #4f46e5); color: #fff; border: none; cursor: pointer; font-weight: 600;">Update
                                        Akun</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Tabel Data Keseluruhan Pengguna --}}
                <div class="toolbar">
                    <form action="{{ route('users.index') }}" method="GET">
                        <div class="search-box">
                            <i data-lucide="search"></i>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari nama atau email...">
                        </div>
                    </form>

                    @if(request('search'))
                        <a href="{{ route('users.index') }}" class="btn-reset">
                            Reset
                        </a>
                    @endif
                </div>
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Seluruh Pengguna Sistem <span>({{ $users->total() }})</span></div>
                    </div>
                    <div class="panel-body" style="padding: 0; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
                            <thead>
                                <tr
                                    style="border-bottom: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02);">
                                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600;">
                                        User</th>
                                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600;">
                                        Email</th>
                                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600;">
                                        Role</th>
                                    <th
                                        style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600; text-align: center;">
                                        Opsi</th>
                                </tr>
                            </thead>
                            <tbody style="color: rgba(255,255,255,0.8);">
                                @forelse ($users as $userItem)
                                    <tr class="review-item {{ (isset($user) && $user->id == $userItem->id) ? 'active-row' : '' }}"
                                        style="border-bottom: 1px solid rgba(255,255,255,0.05); background: transparent; margin:0; border-radius:0; box-shadow:none;">
                                        <td style="padding: 1rem 1.25rem; font-weight: 600;">
                                            <div style="display: flex; align-items: center; gap: 0.6rem;">
                                                <div class="sidebar-avatar"
                                                    style="width:30px; height:30px; font-size:0.75rem; border-radius:6px; margin:0; display:flex; align-items:center; justify-content:center;">
                                                    {{ strtoupper(substr($userItem->name, 0, 1)) }}
                                                </div>
                                                <span
                                                    style="white-space: nowrap;">{{ Str::limit($userItem->name, 18) }}</span>
                                            </div>
                                        </td>
                                        <td
                                            style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.5); font-family: 'Quicksand', sans-serif;">
                                            {{ $userItem->email }}
                                        </td>
                                        <td style="padding: 1rem 1.25rem;">
                                            @if($userItem->role === 'admin')
                                                <span class="badge"
                                                    style="background: rgba(147,51,234,0.15); border: 1px solid rgba(147,51,234,0.3); color: #c084fc;">Admin</span>
                                            @elseif($userItem->role === 'dosen')
                                                <span class="badge badge-blue"
                                                    style="background: rgba(59,130,246,0.15); border: 1px solid rgba(59,130,246,0.3); color: #93c5fd;">Dosen</span>
                                            @else
                                                <span class="badge badge-green">Mhs</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem 1.25rem;">
                                            <div
                                                style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                                <a href="{{ route('users.edit', $userItem->id) }}"
                                                    class="btn-action btn-action-ghost"
                                                    style="padding: 0.35rem 0.65rem; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; gap: 0.2rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">
                                                    <i data-lucide="edit-3" style="width:12px; height:12px;"></i>
                                                </a>

                                                @if($userItem->id !== auth()->id())
                                                    <form action="{{ route('users.destroy', $userItem->id) }}" method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-action"
                                                            style="padding: 0.35rem 0.65rem; font-size: 0.75rem; display: inline-flex; align-items: center; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; cursor: pointer;">
                                                            <i data-lucide="trash-2" style="width:12px; height:12px;"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 3rem 0; opacity: 0.5;">
                                            <i data-lucide="inbox"
                                                style="width: 32px; height: 32px; margin-bottom: 0.5rem; display:block; margin: 0 auto 0.5rem;"></i>
                                            <p style="color:rgba(255,255,255,0.6); font-size:0.85rem;">Tidak ada user
                                                terdaftar.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

               {{-- Pagination Links Custom Dark Theme --}}
                @if($users->hasPages())
                    <div class="pagination-container" style="margin-top: 1.5rem;">
                        
                        {{-- Tombol Previous --}}
                        @if ($users->onFirstPage())
                            <span class="page-link disabled">
                                <i data-lucide="chevron-left" style="width: 16px; height: 16px;"></i>
                            </span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="page-link">
                                <i data-lucide="chevron-left" style="width: 16px; height: 16px;"></i>
                            </a>
                        @endif

                        {{-- Deretan Angka Nomor Halaman --}}
                        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                            @if ($page == $users->currentPage())
                                <span class="page-link active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Tombol Next --}}
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="page-link">
                                <i data-lucide="chevron-right" style="width: 16px; height: 16px;"></i>
                            </a>
                        @else
                            <span class="page-link disabled">
                                <i data-lucide="chevron-right" style="width: 16px; height: 16px;"></i>
                            </span>
                        @endif

                    </div>
                @endif
            </div>

            {{-- PANEL KANAN: Form Tambah Pengguna Baru --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Tambah User Baru</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('users.store') }}" method="POST"
                            style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @csrf

                            {{-- 1. Nama Lengkap --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap" class="form-control" required>
                                @error('name') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 2. Email --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label
                                    style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Alamat
                                    Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    placeholder="contoh@ups.ac.id" class="form-control" required>
                                @error('email') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 3. Hak Akses / Role --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Hak
                                    Akses (Role)</label>
                                <div style="position: relative;">
                                    <select name="role" id="create_role_select" class="select-control" required>
                                        <option value="" disabled selected>-- Pilih Hak Akses --</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen
                                        </option>
                                        <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                            Mahasiswa</option>
                                    </select>
                                    <div
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: rgba(255,255,255,0.4); display: flex;">
                                        <i data-lucide="chevron-down" style="width: 16px; height: 16px;"></i>
                                    </div>
                                </div>
                                @error('role') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- ═══ BLOK MAHASISWA (NIM, Angkatan, Jurusan) - FIX LAYOUT ═══ --}}
                            <div id="create_mahasiswa_fields" class="mahasiswa-fields"
                                style="{{ old('role') == 'mahasiswa' ? 'display:flex;' : 'display:none;' }} flex-direction: column; gap: 1.25rem; width: 100%;">

                                {{-- Baris 1: NIM Full Width --}}
                                <div style="display: flex; flex-direction: column; gap: 0.4rem; width: 100%;">
                                    <label
                                        style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">NIM
                                        (Nomor Induk Mahasiswa)</label>
                                    <input type="text" name="nim" value="{{ old('nim') }}"
                                        placeholder="Masukkan NIM (contoh: 3521500012)" class="form-control"
                                        style="width: 100%; box-sizing: border-box;">
                                    @error('nim') <span
                                    style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                </div>

                                {{-- Baris 2: Angkatan & Jurusan Berdampingan (Grid) --}}
                                <div
                                    style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; width: 100%;">
                                    {{-- Kolom Angkatan --}}
                                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                        <label
                                            style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Angkatan</label>
                                        <input type="number" name="angkatan" value="{{ old('angkatan', date('Y')) }}"
                                            placeholder="2026" class="form-control"
                                            style="width: 100%; box-sizing: border-box;">
                                        @error('angkatan') <span
                                        style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Kolom Jurusan --}}
                                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                        <label
                                            style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Jurusan</label>
                                        <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                                            placeholder="Contoh: Informatika" class="form-control"
                                            style="width: 100%; box-sizing: border-box;">
                                        @error('jurusan') <span
                                        style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- ═══ SUBSIDIARY PANEL: DATA DOSEN (Muncul dinamis jika role = dosen) ═══ --}}
                            <div id="formDosenTambahan"
                                style="display: none; width: 100%; flex-direction: column; gap: 1rem; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 1rem; margin-top: 0.5rem;">
                                <h4 style="margin: 0; color: #fbbf24; font-size: 0.9rem;">Profil Fisik Dosen</h4>

                                <div style="display: flex; gap: 1rem; width: 100%;">
                                    <div style="flex: 1;">
                                        <label
                                            style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">NIDN
                                            (Maks 20 Karakter)</label>
                                        <input type="text" name="nidn" id="nidnInput" maxlength="20"
                                            style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                                    </div>
                                    <div style="flex: 1;">
                                        <label
                                            style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Gelar</label>
                                        <input type="text" name="gelar" maxlength="50"
                                            placeholder="Contoh: S.Kom., M.T."
                                            style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                                    </div>
                                </div>

                                <div style="display: flex; gap: 1rem; width: 100%;">
                                    <div style="flex: 1;">
                                        <label
                                            style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Program
                                            Studi / Jurusan</label>
                                        <select name="jurusan_id" id="jurusanInput"
                                            style="width: 100%; padding: 0.7rem; background: rgba(30,30,30,1); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; cursor: pointer; box-sizing: border-box;">
                                            <option value="">-- Pilih Jurusan --</option>
                                            @foreach(\App\Models\Jurusan::all() as $jurusan)
                                                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="flex: 1;">
                                        <label
                                            style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Foto
                                            Profil (Opsional)</label>
                                        <input type="file" name="foto" accept="image/*"
                                            style="width: 100%; padding: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; font-size: 0.8rem; box-sizing: border-box;">
                                    </div>
                                </div>
                            </div>

                            {{-- 4. Kata Sandi --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Kata
                                    Sandi / Password</label>
                                <input type="password" name="password" placeholder="Minimal 8 karakter"
                                    class="form-control" required>
                                @error('password') <span
                                style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                            </div>

                            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.25rem;">
                                <button type="submit" class="btn-action"
                                    style="width: 100%; justify-content: center; padding: 0.75rem; background: var(--indigo, #4f46e5); color: #fff; border:none; font-weight:600; display:inline-flex; align-items:center; gap:0.5rem;">
                                    <i data-lucide="save" style="width:16px; height:16px;"></i> Simpan Anggota Baru
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // 1. Inisialisasi Lucide Icons
            if (window.lucide) {
                lucide.createIcons();
            }

            // 2. Fade up animation system
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, i) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => entry.target.classList.add('visible'), i * 80);
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.05 });
            document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

            // 3. Sistem Handler Input Dinamis (Mahasiswa & Dosen)
            const createRoleSelect = document.getElementById('create_role_select');
            const createMhsFields = document.getElementById('create_mahasiswa_fields');
            const formDosen = document.getElementById('formDosenTambahan');
            const nidnInput = document.getElementById('nidnInput');
            const jurusanInput = document.getElementById('jurusanInput');

            if (createRoleSelect) {
                createRoleSelect.addEventListener('change', function () {
                    // Kondisi A: Jika memilih Mahasiswa
                    if (this.value === 'mahasiswa') {
                        if (createMhsFields) createMhsFields.style.display = 'flex';
                        if (formDosen) formDosen.style.display = 'none';

                        if (nidnInput) nidnInput.required = false;
                        if (jurusanInput) jurusanInput.required = false;
                    }
                    // Kondisi B: Jika memilih Dosen
                    else if (this.value === 'dosen') {
                        if (createMhsFields) createMhsFields.style.display = 'none';
                        if (formDosen) formDosen.style.display = 'flex';

                        if (nidnInput) nidnInput.required = true;
                        if (jurusanInput) jurusanInput.required = true;
                    }
                    // Kondisi C: Jika memilih Admin / Role Lain
                    else {
                        if (createMhsFields) createMhsFields.style.display = 'none';
                        if (formDosen) formDosen.style.display = 'none';

                        if (nidnInput) nidnInput.required = false;
                        if (jurusanInput) jurusanInput.required = false;
                    }
                });
            }
        });
    </script>
</body>

</html>