<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite([
        'resources/css/home.css',
        'resources/css/dashboard.css',
        'resources/js/dashboard.js'
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

        <a href="{{ route('dashboard.dosen') }}" class="sidebar-item active">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="/dosen/{{ auth()->user()->dosen->id ?? $dosen->id }}" class="sidebar-item">
            <i data-lucide="user-circle" class="sidebar-icon"></i> Profil Anda
        </a>
        <a href="#ulasan" class="sidebar-item">
            <i data-lucide="message-square" class="sidebar-icon"></i> Ulasan Anda
        </a>
        <a href="#statistik" class="sidebar-item">
            <i data-lucide="bar-chart-2" class="sidebar-icon"></i> Statistik Anda
        </a>

        <span class="sidebar-section-label">Lainnya</span>

        <a href="{{ route('dosen.settings') }}" class="sidebar-item">
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

        {{-- Topbar --}}
        <div class="topbar">
            <div class="topbar-right">
                <a href="#ulasan" class="topbar-notif">
                    <i data-lucide="bell" style="width:18px;height:18px;"></i>
                    @if($notifCount > 0)
                        <span class="notif-badge">{{ $notifCount }}</span>
                    @endif
                </a>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="page-header fade-up" id="statistik">
            <h1>Halo, <span>{{ $dosen->nama }}</span></h1>
            <p>Terima kasih sudah menjadi bagian dari komunitas yang membantu meningkatkan kualitas pendidikan.</p>
        </div>

        {{-- Stat Cards --}}
        <div class="stat-grid fade-up">
            <div class="stat-card">
                <div class="stat-card-icon">
                    <i data-lucide="graduation-cap" style="width:22px;height:22px;color:var(--canary);"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Jumlah Mata Kuliah</div>
                    <div class="stat-card-value">
                        {{ $dosen->total_review > 0 ? $reviews->pluck('matkul_id')->filter()->unique()->count() : 0 }}
                    </div>
                    <div class="stat-card-sub">Mata kuliah diampu</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <i data-lucide="clipboard-list" style="width:22px;height:22px;color:var(--canary);"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total Ulasan</div>
                    <div class="stat-card-value">{{ $dosen->total_review }}</div>
                    <div class="stat-card-sub">Ulasan diterima</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <i data-lucide="star" style="width:22px;height:22px;color:var(--canary);"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Rata-rata Rating</div>
                    <div class="stat-card-value">
                        {{ number_format($dosen->avg_rating, 1) }}
                        <span style="font-size:1rem;color:rgba(255,255,255,0.3);">/ 5</span>
                    </div>
                    <div class="stat-card-sub">Dari mahasiswa</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-card-icon">
                    <i data-lucide="message-circle" style="width:22px;height:22px;color:var(--canary);"></i>
                </div>
                <div class="stat-card-info">
                    <div class="stat-card-label">Total Ulasan Diterima</div>
                    <div class="stat-card-value">{{ $dosen->total_review }}</div>
                    <div class="stat-card-sub">Keseluruhan</div>
                </div>
            </div>
        </div>

        <h2 style="font-family:'Syne',sans-serif;font-weight:700;font-size:1.3rem;margin-bottom:1.25rem;"
            class="fade-up">
            Dosen Dashboard
        </h2>

        {{-- Content Grid --}}
        <div class="content-grid fade-up">

            {{-- LEFT COLUMN --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">
                {{-- Review Terbaru --}}
                <div class="panel" id="ulasan">
                    <div class="panel-header">
                        <div class="panel-title">
                            Review Terbaru Tentang Anda
                            <span>({{ $reviews->count() }})</span>
                        </div>
                        <a href="/dosen/{{ $dosen->id }}#ulasan" class="panel-link">Lihat Semua</a>
                    </div>
                    <div class="panel-body">
                        @forelse($reviews->take(5) as $review)
                            <div class="review-item">
                                <div class="review-item-header">
                                    <div>
                                        <div style="display:flex;align-items:center;gap:0.4rem;margin-bottom:0.2rem;">
                                            <span class="stars" style="display:inline-flex;gap:1px;align-items:center;">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <i data-lucide="star"
                                                            style="width:14px;height:14px;fill:var(--canary);color:var(--canary);"></i>
                                                    @else
                                                        <i data-lucide="star"
                                                            style="width:14px;height:14px;color:rgba(255,255,255,0.2);"></i>
                                                    @endif
                                                @endfor
                                            </span>
                                            <span class="stars-num">{{ $review->rating }}.0</span>
                                        </div>
                                        <div class="review-item-name">
                                            {{ $review->matkul ? $review->matkul->nama : 'Profil Dosen' }}
                                        </div>
                                        <div class="review-item-course">Mata Kuliah</div>
                                    </div>
                                    <div class="review-item-time">{{ $review->created_at->diffForHumans() }}</div>
                                </div>
                                <p class="review-item-text">{{ $review->ulasan }}</p>
                                @if($review->tags)
                                    <div class="review-item-tags">
                                        @foreach($review->tags as $tag)
                                            <span class="mock-tag">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div style="text-align:center;padding:2rem 0;">
                                <i data-lucide="inbox"
                                    style="width:32px;height:32px;color:rgba(255,255,255,0.2);margin-bottom:0.75rem;"></i>
                                <p style="color:rgba(255,255,255,0.35);font-size:0.85rem;">Belum ada ulasan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN --}}
            <div style="display:flex;flex-direction:column;gap:1.25rem;">

                {{-- Profil Dosen --}}
                <div class="profile-card">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1rem;">
                        <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:0.95rem;">Profil
                            Dosen</span>
                        <a href="/dosen/{{ $dosen->id }}" class="panel-link">Lihat Profil</a>
                    </div>
                    <div class="profile-avatar-lg">
                        {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                    </div>
                    <div class="profile-name">{{ $dosen->nama }}</div>
                    <div class="profile-role">{{ $dosen->gelar ?? 'Dosen' }}</div>
                    <div class="profile-detail-row">
                        <i data-lucide="id-card"
                            style="width:14px;height:14px;color:rgba(255,255,255,0.3);flex-shrink:0;"></i>
                        <span>{{ $dosen->nidn }}</span>
                    </div>
                    <div class="profile-detail-row">
                        <i data-lucide="landmark"
                            style="width:14px;height:14px;color:rgba(255,255,255,0.3);flex-shrink:0;"></i>
                        <span>{{ $dosen->jurusan->nama ?? '—' }}</span>
                    </div>
                    <div class="profile-detail-row">
                        <i data-lucide="calendar"
                            style="width:14px;height:14px;color:rgba(255,255,255,0.3);flex-shrink:0;"></i>
                        <span>Bergabung {{ $dosen->created_at->format('Y') }}</span>
                    </div>
                    @if($dosen->user)
                        <div class="profile-detail-row">
                            <i data-lucide="mail"
                                style="width:14px;height:14px;color:rgba(255,255,255,0.3);flex-shrink:0;"></i>
                            <span>{{ $dosen->user->email }}</span>
                        </div>
                    @endif
                </div>

                {{-- Statistik & Matkul --}}
                <div class="panel" id="statistik">
                    <div class="panel-header">
                        <div class="panel-title">Mata Kuliah Diampu</div>
                    </div>
                    <div class="panel-body">
                        <div class="rating-bar-group" style="margin-bottom:1.5rem;">
                            @for($star = 5; $star >= 1; $star--)
                                @php
                                    $count = $reviews->where('rating', $star)->count();
                                    $pct = $reviews->count() > 0 ? round(($count / $reviews->count()) * 100) : 0;
                                @endphp
                                <div class="rating-bar-row">
                                    <span class="rating-bar-num">{{ $star }}</span>
                                    <div class="rating-bar-track">
                                        <div class="rating-bar-fill" style="width:{{ $pct }}%;"></div>
                                    </div>
                                    <span class="rating-bar-count">{{ $count }}</span>
                                </div>
                            @endfor
                        </div>

                        @foreach(\App\Models\Matkul::where('jurusan_id', $dosen->jurusan_id)->take(4)->get() as $matkul)
                            <div class="matkul-row" id="matkul">
                                <div>
                                    <div class="matkul-name">{{ $matkul->nama }}</div>
                                    <div class="matkul-sub">Mata Kuliah Diampu</div>
                                </div>
                                <span class="stars" style="display:inline-flex;gap:1px;align-items:center;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($matkul->avg_rating))
                                            <i data-lucide="star"
                                                style="width:11px;height:11px;fill:var(--canary);color:var(--canary);"></i>
                                        @else
                                            <i data-lucide="star" style="width:11px;height:11px;color:rgba(255,255,255,0.2);"></i>
                                        @endif
                                    @endfor
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </main>
</body>

</html>