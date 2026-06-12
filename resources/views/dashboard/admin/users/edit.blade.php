<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Quicksand:wght@400;600;700&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
    ])

    <style>
        .dashboard-body {
            display: flex !important;
            min-height: 100vh;
            overflow-x: hidden;
            background-color: #0f1115;
            color: #ffffff;
        }
        .dashboard-main {
            flex: 1 !important;
            min-width: 0 !important;
            width: 100% !important;
            display: block !important;
            box-sizing: border-box;
            padding: 2rem;
        }
        .fade-up {
            opacity: 1 !important;
            transform: none !important;
            visibility: visible !important;
        }
    </style>
</head>

<body class="dashboard-body">

    <div class="orb orb-1" style="position:fixed;z-index:0;"></div>
    <div class="orb orb-2" style="position:fixed;z-index:0;"></div>

    {{-- ═══ SIDEBAR ADMIN ═══ --}}
    <aside class="sidebar">
        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>

        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name ?? 'Admin', 2, '') }}</div>
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

    {{-- ═══ MAIN CONTENT AREA ═══ --}}
    <main class="dashboard-main">

        <div class="page-header fade-up">
            <h1>Edit Data <span>Pengguna</span></h1>
            <p>Perbarui informasi akun login mahasiswa, administrator, atau ubah profil fisik dosen.</p>
        </div>

        @if(session('error'))
            <div style="background: rgba(239,68,68,0.15); border: 1px solid rgba(239,68,68,0.3); color: #fca5a5; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="panel fade-up" style="max-width: 800px; margin: 0 auto;">
            <div class="panel-header" style="display:flex; justify-content:space-between; align-items:center;">
                <div class="panel-title">Form Perbarui Data: {{ $user->name }}</div>
                <a href="{{ route('users.index') }}" style="color:rgba(255,255,255,0.5); font-size:0.85rem; display:flex; align-items:center; gap:0.3rem; text-decoration:none;">
                    <i data-lucide="arrow-left" style="width:14px; height:14px;"></i> Kembali
                </a>
            </div>
            
            <div class="panel-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1.25rem;">
                    @csrf
                    @method('PUT')

                    {{-- Row 1: Nama & Email --}}
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex: 1;">
                            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.4rem;">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                        </div>
                        <div style="flex: 1;">
                            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.4rem;">Email Login</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                        </div>
                    </div>

                    {{-- Row 2: Password & Role --}}
                    <div style="display: flex; gap: 1rem;">
                        <div style="flex: 1;">
                            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.4rem;">Password Baru (Kosongkan jika tidak diganti)</label>
                            <input type="password" name="password" placeholder="••••••••" style="width: 100%; padding: 0.75rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                        </div>
                        <div style="flex: 1;">
                            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.4rem;">Role Hak Akses</label>
                            <select name="role" id="edit_role_select" required style="width: 100%; padding: 0.75rem; background: rgba(30,30,30,1); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; cursor: pointer; box-sizing: border-box;">
                                <option value="mahasiswa" {{ $user->role === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="dosen" {{ $user->role === 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                            </select>
                        </div>
                    </div>

                    {{-- ═══ WADAH MAHASISWA (AKTIF & BISA DIEDIT) ═══ --}}
<div id="edit_mahasiswa_fields" class="role-conditional-fields" data-role="mahasiswa" style="display: {{ $user->role === 'mahasiswa' ? 'block' : 'none' }}; width: 100%; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 1rem; margin-top: 0.5rem;">
    <h4 style="margin: 0 0 1rem 0; color: #34d399; font-size: 0.95rem; font-family:'Syne', sans-serif;">Profil Akademik Mahasiswa</h4>
    
    {{-- Row 1: NIM & Angkatan (Panggil langsung dari $user) --}}
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <div style="flex: 1;">
            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">NIM</label>
            <input type="text" name="nim" value="{{ old('nim', $user->nim ?? '') }}" style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
        </div>
        <div style="flex: 1;">
            <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Angkatan</label>
            <input type="number" name="angkatan" value="{{ old('angkatan', $user->angkatan ?? '') }}" style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
        </div>
    </div>

    {{-- Row 2: Program Studi --}}
    <div style="width: 100%;">
        <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Program Studi / Jurusan</label>
        <select name="jurusan_id" style="width: 100%; padding: 0.7rem; background: rgba(30,30,30,1); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; cursor: pointer; box-sizing: border-box;">
            <option value="">-- Pilih Jurusan Mahasiswa --</option>
            @foreach(\App\Models\Jurusan::all() as $jurusan)
                <option value="{{ $jurusan->id }}" {{ (old('jurusan_id', $user->jurusan_id) == $jurusan->id) ? 'selected' : '' }}>
                    {{ $jurusan->nama }}
                </option>
            @endforeach
        </select>
    </div>
</div>

                    {{-- ═══ BLOK TAMBAHAN DOSEN (Hanya muncul jika Role = Dosen) ═══ --}}
                    <div id="editFormDosenTambahan" style="display: {{ $user->role === 'dosen' ? 'block' : 'none' }}; width: 100%; flex-direction: column; gap: 1rem; border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 1rem; margin-top: 0.5rem;">
                        <h4 style="margin: 0 0 0.5rem 0; color: #fbbf24; font-size: 0.95rem; font-family:'Syne', sans-serif;">Profil Fisik Dosen</h4>
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                            <div style="flex: 1;">
                                <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">NIDN (Maks 20 Karakter)</label>
                                <input type="text" name="nidn" id="editNidnInput" maxlength="20" value="{{ old('nidn', $user->dosen->nidn ?? '') }}" style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                            </div>
                            <div style="flex: 1;">
                                <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Gelar</label>
                                <input type="text" name="gelar" maxlength="50" placeholder="Contoh: S.Kom., M.T." value="{{ old('gelar', $user->dosen->gelar ?? '') }}" style="width: 100%; padding: 0.7rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; box-sizing: border-box;">
                            </div>
                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <div style="flex: 1;">
                                <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Program Studi / Jurusan</label>
                                <select name="jurusan_id" id="editJurusanInput" style="width: 100%; padding: 0.7rem; background: rgba(30,30,30,1); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; cursor: pointer; box-sizing: border-box;">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach(\App\Models\Jurusan::all() as $jurusan)
                                        <option value="{{ $jurusan->id }}" {{ (old('jurusan_id', $user->dosen->jurusan_id ?? '') == $jurusan->id) ? 'selected' : '' }}>
                                            {{ $jurusan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div style="flex: 1;">
                                <label style="color: rgba(255,255,255,0.6); font-size: 0.85rem; display: block; margin-bottom: 0.3rem;">Foto Profil Baru (Opsional)</label>
                                <input type="file" name="foto" accept="image/*" style="width: 100%; padding: 0.5rem; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; color: white; font-size: 0.8rem; box-sizing: border-box;">
                                @if(isset($user->dosen->foto))
                                    <span style="font-size: 0.75rem; color: #34d399; display:block; margin-top:0.3rem;"><i data-lucide="check-circle" style="width:12px;height:12px;display:inline-block;vertical-align:middle;"></i> Sudah ada foto profil terpasang</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button type="submit" style="margin-top: 1rem; padding: 0.85rem; background: var(--canary, #fbbf24); border: none; border-radius: 8px; color: black; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; width: 100%;">
                        <i data-lucide="save" style="width:16px; height:16px;"></i> Simpan Perubahan Pengguna
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.lucide) {
            lucide.createIcons();
        }

        const editRoleSelect = document.getElementById('edit_role_select');
        const editMhsFields = document.getElementById('edit_mahasiswa_fields');
        const editFormDosen = document.getElementById('editFormDosenTambahan');
        const editNidnInput = document.getElementById('editNidnInput');
        const editJurusanInput = document.getElementById('editJurusanInput');

        // ════ PENGKONDISIAN OTOMATIS SAAT HALAMAN PERTAMA KALI DIMUAT ════
        if (editRoleSelect) {
            if (editRoleSelect.value === 'dosen') {
                if (editFormDosen) editFormDosen.style.display = 'block';
                if (editMhsFields) editMhsFields.style.display = 'none';
                if (editNidnInput) editNidnInput.required = true;
                if (editJurusanInput) editJurusanInput.required = true;
            } 
            else if (editRoleSelect.value === 'mahasiswa') {
                if (editMhsFields) editMhsFields.style.display = 'block'; // <= INI YANG MEMBUATNYA LANGSUNG MUNCUL
                if (editFormDosen) editFormDosen.style.display = 'none';
                if (editNidnInput) editNidnInput.required = false;
                if (editJurusanInput) editJurusanInput.required = false;
            } 
            else {
                if (editMhsFields) editMhsFields.style.display = 'none';
                if (editFormDosen) editFormDosen.style.display = 'none';
            }
        }

        // ════ HANDLER INTERAKTIF SAAT ADMIN MENGGANTI PILIHAN ROLE ════
        if (editRoleSelect) {
            editRoleSelect.addEventListener('change', function () {
                if (this.value === 'mahasiswa') {
                    if (editMhsFields) editMhsFields.style.display = 'block';
                    if (editFormDosen) editFormDosen.style.display = 'none';
                    
                    if (editNidnInput) editNidnInput.required = false;
                    if (editJurusanInput) editJurusanInput.required = false;
                } 
                else if (this.value === 'dosen') {
                    if (editMhsFields) editMhsFields.style.display = 'none';
                    if (editFormDosen) editFormDosen.style.display = 'block';
                    
                    if (editNidnInput) editNidnInput.required = true;
                    if (editJurusanInput) editJurusanInput.required = true;
                } 
                else {
                    if (editMhsFields) editMhsFields.style.display = 'none';
                    if (editFormDosen) editFormDosen.style.display = 'none';
                    
                    if (editNidnInput) editNidnInput.required = false;
                    if (editJurusanInput) editJurusanInput.required = false;
                }
            });
        }
    });
</script>
</body>

</html>