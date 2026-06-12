<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Mata Kuliah - EDOM UPS Tegal</title>
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
        <a href="{{ route('matkul.index') }}" class="sidebar-item active">
            <i data-lucide="book-open" class="sidebar-icon"></i> Kelola Matkul
        </a>
        <a href="{{ route('users.index') }}" class="sidebar-item">
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
            <h1>Kelola <span>Mata Kuliah</span></h1>
            <p>Atur daftar mata kuliah, bobot SKS, pembagian semester, alokasi program studi, serta pantau statistik
                ulasannya.</p>
        </div>

        {{-- Content Grid Bersama --}}
        <div class="content-grid fade-up">

            {{-- PANEL KIRI: Tabel Utama Matkul & Form Edit Terpilih --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">

                {{-- Form Modul Edit Matkul (Aktif otomatis saat route mengarah ke edit) --}}
                @if(request()->routeIs('matkul.edit') && isset($matkul))
                    <div class="panel">
                        <div class="panel-header">
                            <div class="panel-title">Edit Mata Kuliah: <span>{{ $matkul->nama }}</span></div>
                        </div>
                        <div class="panel-body">
                            <form action="{{ route('matkul.update', $matkul->id) }}" method="POST"
                                style="display: flex; flex-direction: column; gap: 1.25rem;">
                                @csrf
                                @method('PUT')

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Kode
                                        Matkul</label>
                                    <input type="text" name="kode" value="{{ old('kode', $matkul->kode) }}"
                                        class="form-control" required>
                                    @error('kode') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Nama
                                        Mata Kuliah</label>
                                    <input type="text" name="nama" value="{{ old('nama', $matkul->nama) }}"
                                        class="form-control" required>
                                    @error('nama') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div
                                    style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; width: 100%;">
                                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                        <label
                                            style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Bobot
                                            SKS</label>
                                        <input type="number" name="sks" min="1" value="{{ old('sks', $matkul->sks) }}"
                                            class="form-control" required>
                                        @error('sks') <span
                                        style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                    </div>

                                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                        <label
                                            style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Semester</label>
                                        <input type="number" name="semester" min="1"
                                            value="{{ old('semester', $matkul->semester) }}" class="form-control" required>
                                        @error('semester') <span
                                        style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label
                                        style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Program
                                        Studi / Jurusan</label>
                                    <div style="position: relative;">
                                        <select name="jurusan_id" class="select-control" required>
                                            @foreach($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $matkul->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                                    {{ $jurusan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div
                                            style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: rgba(255,255,255,0.4); display: flex;">
                                            <i data-lucide="chevron-down" style="width: 16px; height: 16px;"></i>
                                        </div>
                                    </div>
                                    @error('jurusan_id') <span
                                    style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                </div>

                                <div
                                    style="display: flex; justify-content: flex-end; gap: 0.75rem; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.25rem;">
                                    <a href="{{ route('matkul.index') }}" class="btn-action btn-action-ghost"
                                        style="padding: 0.6rem 1.2rem; text-decoration: none; background: transparent; border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); display: inline-flex; align-items: center;">Batal</a>
                                    <button type="submit" class="btn-action"
                                        style="padding: 0.6rem 1.4rem; background: var(--indigo, #4f46e5); color: #fff; border: none; cursor: pointer; font-weight: 600;">Update
                                        Matkul</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Toolbar Pencarian --}}
                <div class="toolbar">
                    <form action="{{ route('matkul.index') }}" method="GET">
                        <div class="search-box">
                            <i data-lucide="search"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari kode atau nama mata kuliah...">
                        </div>
                    </form>

                    @if(request('search'))
                        <a href="{{ route('matkul.index') }}" class="btn-reset">
                            Reset
                        </a>
                    @endif
                </div>

                {{-- Tabel Data Keseluruhan Mata Kuliah --}}
<div class="panel">
    <div class="panel-header">
        <div class="panel-title">Daftar Mata Kuliah <span>(Total: {{ $matkuls->total() }})</span></div>
    </div>
    <div class="panel-body" style="padding: 0; overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.08); background: rgba(255,255,255,0.02);">
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600; width: 15%;">Kode</th>
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600;">Nama Matkul</th>
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600; text-align: center;">SKS / Sem</th>
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600;">Jurusan</th>
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600; text-align: center;">Rating & Ulasan</th>
                    <th style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6); font-weight: 600; text-align: center;">Opsi</th>
                </tr>
            </thead>
            <tbody style="color: rgba(255,255,255,0.8);">
                @forelse ($matkuls as $matkulItem)
                    <tr class="review-item {{ (isset($matkul) && $matkul->id == $matkulItem->id) ? 'active-row' : '' }}"
                        style="border-bottom: 1px solid rgba(255,255,255,0.05); background: transparent; margin:0; border-radius:0; box-shadow:none;">
                        
                        {{-- Kode --}}
                        <td style="padding: 1rem 1.25rem; font-weight: 600; font-family: 'Quicksand', sans-serif; color: #fbbf24;">
                            {{ $matkulItem->kode }}
                        </td>
                        
                        {{-- Nama Matkul --}}
                        <td style="padding: 1rem 1.25rem; font-weight: 500;">
                            {{ Str::limit($matkulItem->nama, 35) }}
                        </td>
                        
                        {{-- SKS dan Semester --}}
                        <td style="padding: 1rem 1.25rem; text-align: center;">
                            <span class="badge" style="background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); color: #60a5fa;">
                                {{ $matkulItem->sks }} SKS
                            </span>
                            <span class="badge" style="background: rgba(245,158,11,0.1); border: 1px solid rgba(245,158,11,0.2); color: #fbbf24;">
                                Smstr {{ $matkulItem->semester }}
                            </span>
                        </td>
                        
                        {{-- Jurusan --}}
                        <td style="padding: 1rem 1.25rem; color: rgba(255,255,255,0.6);">
                            {{ $matkulItem->jurusan->nama ?? 'Tidak Diketahui' }}
                        </td>

                        {{-- Rating & Total Review --}}
                        <td style="padding: 1rem 1.25rem; text-align: center;">
                            <div style="display: inline-flex; align-items: center; gap: 0.3rem; color: #f59e0b;">
                                <i data-lucide="star" style="width: 14px; height: 14px; fill: #f59e0b;"></i>
                                <span style="font-weight: 600;">{{ number_format($matkulItem->avg_rating, 1) }}</span>
                                <span style="color: rgba(255,255,255,0.4); font-size: 0.75rem;">({{ $matkulItem->total_review }})</span>
                            </div>
                        </td>
                        
                        {{-- Opsi Aksi --}}
                        <td style="padding: 1rem 1.25rem;">
                            <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ route('matkul.edit', $matkulItem->id) }}"
                                    class="btn-action btn-action-ghost"
                                    style="padding: 0.35rem 0.65rem; font-size: 0.75rem; text-decoration: none; display: inline-flex; align-items: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">
                                    <i data-lucide="edit-3" style="width:12px; height:12px;"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('matkul.destroy', $matkulItem->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action"
                                        style="padding: 0.35rem 0.65rem; font-size: 0.75rem; display: inline-flex; align-items: center; background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.25); color: #fca5a5; cursor: pointer;">
                                        <i data-lucide="trash-2" style="width:12px; height:12px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem 0; opacity: 0.5;">
                            <i data-lucide="inbox" style="width: 32px; height: 32px; margin-bottom: 0.5rem; display:block; margin: 0 auto 0.5rem;"></i>
                            <p style="color:rgba(255,255,255,0.6); font-size:0.85rem;">Tidak ada mata kuliah terdaftar.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Tombol Navigasi Halaman Custom Dark Theme --}}
@if($matkuls->hasPages())
    <div class="pagination-container">
        
        {{-- Tombol Previous --}}
        @if ($matkuls->onFirstPage())
            <span class="page-link disabled">
                <i data-lucide="chevron-left" style="width: 16px; height: 16px;"></i>
            </span>
        @else
            <a href="{{ $matkuls->previousPageUrl() }}" class="page-link">
                <i data-lucide="chevron-left" style="width: 16px; height: 16px;"></i>
            </a>
        @endif

        {{-- Deretan Angka Nomor Halaman --}}
        @foreach ($matkuls->getUrlRange(1, $matkuls->lastPage()) as $page => $url)
            @if ($page == $matkuls->currentPage())
                <span class="page-link active">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($matkuls->hasMorePages())
            <a href="{{ $matkuls->nextPageUrl() }}" class="page-link">
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

            {{-- PANEL KANAN: Form Tambah Mata Kuliah Baru --}}
            <div style="display:flex; flex-direction:column; gap:1.25rem;">
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Tambah Matkul Baru</div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('matkul.store') }}" method="POST"
                            style="display: flex; flex-direction: column; gap: 1.25rem;">
                            @csrf

                            {{-- 1. Kode Matkul --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Kode
                                    Mata Kuliah</label>
                                <input type="text" name="kode" value="{{ old('kode') }}" placeholder="Contoh: INF-201"
                                    class="form-control" required>
                                @error('kode') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 2. Nama Matkul --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Nama
                                    Mata Kuliah</label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama mata kuliah" class="form-control" required>
                                @error('nama') <span style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- 3. Grid SKS & Semester --}}
                            <div
                                style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; width: 100%;">
                                {{-- Bobot SKS --}}
                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label
                                        style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Bobot
                                        SKS</label>
                                    <input type="number" name="sks" min="1" value="{{ old('sks', 3) }}" placeholder="3"
                                        class="form-control" required>
                                    @error('sks') <span
                                    style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                </div>

                                {{-- Semester --}}
                                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                    <label
                                        style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Semester</label>
                                    <input type="number" name="semester" min="1" value="{{ old('semester', 1) }}"
                                        placeholder="1" class="form-control" required>
                                    @error('semester') <span
                                    style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            {{-- 4. Dropdown Jurusan --}}
                            <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                                <label
                                    style="font-size: 0.85rem; font-weight: 600; color: rgba(255,255,255,0.7);">Program
                                    Studi / Jurusan</label>
                                <div style="position: relative;">
                                    <select name="jurusan_id" class="select-control" required>
                                        <option value="" disabled selected>-- Pilih Program Studi --</option>
                                        @foreach($jurusans as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                                {{ $jurusan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div
                                        style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none; color: rgba(255,255,255,0.4); display: flex;">
                                        <i data-lucide="chevron-down" style="width: 16px; height: 16px;"></i>
                                    </div>
                                </div>
                                @error('jurusan_id') <span
                                style="color: #fca5a5; font-size: 0.75rem;">{{ $message }}</span> @enderror
                            </div>

                            {{-- Button Submit --}}
                            <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 1.25rem;">
                                <button type="submit" class="btn-action"
                                    style="width: 100%; justify-content: center; padding: 0.75rem; background: var(--indigo, #4f46e5); color: #fff; border:none; font-weight:600; display:inline-flex; align-items:center; gap:0.5rem;">
                                    <i data-lucide="save" style="width:16px; height:16px;"></i> Simpan Mata Kuliah
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
        });
    </script>
</body>

</html>