<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css'
    ])
    <style>
        /* Tambahan style untuk ulasan tersembunyi agar tidak tabrakan dengan JavaScript */
        .review-item.status-hidden {
            opacity: 0.5;
        }

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

        .stat-card-icon lucide-icon,
        .stat-card-icon svg {
            width: 28px;
            height: 28px;
            stroke-width: 1.75;
            color: var(--canary, #fcd34d);
        }

        .course-icon {
            width: 14px;
            height: 14px;
            stroke-width: 2;
            vertical-align: middle;
            margin-right: 2px;
            opacity: 0.7;
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
        <a href="{{ route('dashboard.admin') }}" class="sidebar-item active">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="#ulasan" class="sidebar-item">
            <i data-lucide="message-square-dashed" class="sidebar-icon"></i> Moderasi Ulasan
        </a>
        
        <span class="sidebar-section-label">Sistem</span>
        
        <a href="{{ route('matkul.index') }}" class="sidebar-item">
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
                    <span class="notif-badge">{{ $stats['total_review'] }}</span>
                </a>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="flash-success fade-up" style="display: flex; align-items: center; gap: 0.5rem;">
                <i data-lucide="check-circle" style="width:16px; height:16px;"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Page Header --}}
        <div class="page-header fade-up">
            <h1>Panel <span>Moderasi</span></h1>
            <p>Kelola ulasan, dosen, dan mata kuliah platform EDOM.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="stat-grid fade-up">
            <div class="stat-card">
                <div class="stat-card-icon"><i data-lucide="user-check"></i></div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total User</div>
                    <div class="stat-card-value">{{ $stats['total_user'] }}</div>
                    <div class="stat-card-sub">Terdaftar</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon"><i data-lucide="graduation-cap"></i></div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total Dosen</div>
                    <div class="stat-card-value">{{ $stats['total_dosen'] }}</div>
                    <div class="stat-card-sub">Terdata</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon"><i data-lucide="book-open"></i></div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total Matkul</div>
                    <div class="stat-card-value">{{ $stats['total_matkul'] }}</div>
                    <div class="stat-card-sub">Terdaftar</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon"><i data-lucide="message-square"></i></div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total Ulasan</div>
                    <div class="stat-card-value">{{ $stats['total_review'] }}</div>
                    <div class="stat-card-sub">Keseluruhan</div>
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="content-grid fade-up">

            {{-- LEFT: Moderasi Ulasan --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">
                <div class="panel" id="ulasan">
                    <div class="panel-header">
                        <div class="panel-title">
                            Moderasi Ulasan <span>({{ $reviews->count() }})</span>
                        </div>
                    </div>
                    <div class="panel-body">

                        {{-- Filter --}}
                        <div class="filter-row">
                            <button class="filter-btn active" onclick="filterReviews('all', this)">Semua</button>
                            <button class="filter-btn" onclick="filterReviews('visible', this)">Tampil</button>
                            <button class="filter-btn" onclick="filterReviews('hidden', this)">Disembunyikan</button>
                        </div>

                        {{-- Review List --}}
                        @forelse($reviews as $review)
                            <div class="review-item {{ $review->is_visible ? '' : 'status-hidden' }}"
                                data-visible="{{ $review->is_visible ? 'visible' : 'hidden' }}">
                                <div class="review-item-header">
                                    <div style="display:flex;align-items:center;gap:0.6rem;">
                                        <div class="sidebar-avatar"
                                            style="width:34px;height:34px;font-size:0.8rem;border-radius:8px;">
                                            {{ $review->is_anonim ? '?' : strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="review-item-name">
                                                {{ $review->is_anonim ? 'Anonim' : ($review->user->name ?? '—') }}
                                            </div>
                                            <div class="review-item-course"
                                                style="display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                                                @if($review->dosen)
                                                    <span style="display: inline-flex; align-items: center;"><i
                                                            data-lucide="graduation-cap" class="course-icon"></i>
                                                        {{ Str::limit($review->dosen->nama, 22) }}</span>
                                                @endif
                                                @if($review->matkul)
                                                    <span style="display: inline-flex; align-items: center;"><i
                                                            data-lucide="book-open" class="course-icon"></i>
                                                        {{ Str::limit($review->matkul->nama, 22) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div style="display:flex;align-items:center;gap:0.6rem;flex-wrap:wrap;">
                                        <span class="badge {{ $review->is_visible ? 'badge-green' : 'badge-red' }}">
                                            {{ $review->is_visible ? 'Tampil' : 'Hidden' }}
                                        </span>
                                        <div class="review-item-rating">
                                            <span class="stars">
                                                @for($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                                            </span>
                                            <span class="stars-num">{{ $review->rating }}</span>
                                        </div>
                                        <span class="review-item-time">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <p class="review-item-text">{{ $review->ulasan }}</p>

                                @if($review->tags)
                                    <div class="review-item-tags">
                                        @foreach($review->tags as $tag)
                                            <span class="mock-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div
                                    style="display:flex;align-items:center;justify-content:space-between;margin-top:0.75rem;padding-top:0.6rem;border-top:1px solid rgba(255,255,255,0.05);">
                                    <span
                                        style="font-size:0.72rem;color:rgba(255,255,255,0.3); display: inline-flex; align-items: center; gap: 0.25rem;">
                                        <i data-lucide="thumbs-up" style="width: 12px; height: 12px;"></i>
                                        {{ $review->upvotes }} upvote
                                    </span>
                                    <form method="POST" action="{{ route('admin.review.toggle', $review->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn-action {{ $review->is_visible ? '' : 'btn-action-ghost' }}" style="
                                                display: inline-flex;
                                                align-items: center;
                                                gap: 0.35rem;
                                                padding:0.35rem 0.9rem;
                                                font-size:0.75rem;
                                                border-radius:8px;
                                                background:{{ $review->is_visible ? 'rgba(239,68,68,0.1)' : 'rgba(34,197,94,0.1)' }};
                                                border:1px solid {{ $review->is_visible ? 'rgba(239,68,68,0.25)' : 'rgba(34,197,94,0.25)' }};
                                                color:{{ $review->is_visible ? '#fca5a5' : '#86efac' }};
                                                cursor:pointer;
                                                font-family:'DM Sans',sans-serif;
                                                font-weight:600;
                                            ">
                                            <i data-lucide="{{ $review->is_visible ? 'eye-off' : 'eye' }}"
                                                style="width: 14px; height: 14px;"></i>
                                            {{ $review->is_visible ? 'Sembunyikan' : 'Tampilkan' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center;padding:3rem 0; opacity: 0.5;">
                                <i data-lucide="inbox" style="width: 36px; height: 36px; margin-bottom: 0.5rem;"></i>
                                <p style="color:rgba(255,255,255,0.6);font-size:0.875rem;">Belum ada ulasan masuk.</p>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            {{-- RIGHT: Summary --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">

                {{-- Ringkasan Platform --}}
                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Ringkasan Platform</div>
                    </div>
                    <div class="panel-body">
                        <div class="matkul-row">
                            <div>
                                <div class="matkul-name">Ulasan Tampil</div>
                                <div class="matkul-sub">Aktif & terlihat mahasiswa</div>
                            </div>
                            <span class="badge badge-green">{{ $reviews->where('is_visible', true)->count() }}</span>
                        </div>
                        <div class="matkul-row">
                            <div>
                                <div class="matkul-name">Ulasan Disembunyikan</div>
                                <div class="matkul-sub">Dinonaktifkan admin</div>
                            </div>
                            <span class="badge badge-red">{{ $reviews->where('is_visible', false)->count() }}</span>
                        </div>
                        <div class="matkul-row">
                            <div>
                                <div class="matkul-name">Ulasan Anonim</div>
                                <div class="matkul-sub">Identitas disembunyikan</div>
                            </div>
                            <span class="badge badge-yellow">{{ $reviews->where('is_anonim', true)->count() }}</span>
                        </div>
                        <div class="matkul-row">
                            <div>
                                <div class="matkul-name">Rata-rata Rating</div>
                                <div class="matkul-sub">Seluruh platform</div>
                            </div>
                            <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--canary);">
                                {{ $reviews->count() > 0 ? number_format($reviews->avg('rating'), 1) : '—' }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Top Dosen --}}
                <div class="panel" id="dosen">
                    <div class="panel-header">
                        <div class="panel-title">Top Dosen</div>
                        <a href="/search" class="panel-link">Lihat Semua</a>
                    </div>
                    <div class="panel-body">
                        @foreach(\App\Models\Dosen::orderBy('avg_rating', 'desc')->take(5)->get() as $dosen)
                            <div class="matkul-row">
                                <div style="display:flex;align-items:center;gap:0.6rem;">
                                    <div class="sidebar-avatar"
                                        style="width:32px;height:32px;font-size:0.8rem;border-radius:8px;">
                                        {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="matkul-name">{{ Str::limit($dosen->nama, 22) }}</div>
                                        <div class="matkul-sub">{{ $dosen->total_review }} ulasan</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:0.3rem;">
                                    <span style="color:var(--canary);font-size:0.7rem;">★</span>
                                    <span
                                        style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.875rem;color:var(--canary);">
                                        {{ number_format($dosen->avg_rating, 1) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Top Matkul --}}
                <div class="panel" id="matkul">
                    <div class="panel-header">
                        <div class="panel-title">Top Mata Kuliah</div>
                        <a href="/search" class="panel-link">Lihat Semua</a>
                    </div>
                    <div class="panel-body">
                        @foreach(\App\Models\Matkul::orderBy('avg_rating', 'desc')->take(5)->get() as $matkul)
                            <div class="matkul-row">
                                <div>
                                    <div class="matkul-name">{{ Str::limit($matkul->nama, 24) }}</div>
                                    <div class="matkul-sub">{{ $matkul->sks }} SKS · Sem {{ $matkul->semester }}</div>
                                </div>
                                <div style="display:flex;align-items:center;gap:0.3rem;">
                                    <span style="color:var(--canary);font-size:0.7rem;">★</span>
                                    <span
                                        style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.875rem;color:var(--canary);">
                                        {{ number_format($matkul->avg_rating, 1) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
    // DOMContentLoaded untuk inisialisasi (bukan filterReviews)
    document.addEventListener('DOMContentLoaded', function () {
        lucide.createIcons();
 
        // Fade up animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    });
 
    // filterReviews HARUS global (di luar wrapper apapun)
    // karena dipanggil via onclick="..." di HTML
    function filterReviews(type, btn) {
        // Toggle active state pada tombol filter
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
 
        // Show/hide review items berdasarkan data-visible
        document.querySelectorAll('.review-item').forEach(item => {
            if (type === 'all') {
                item.style.setProperty('display', '', 'important');
            } else {
                item.style.setProperty(
                    'display',
                    item.dataset.visible === type ? '' : 'none',
                    'important'
                );
            }
        });
 
        // Re-render lucide icons setelah DOM dimanipulasi
        lucide.createIcons();
    }
</script>
</body>

</html>