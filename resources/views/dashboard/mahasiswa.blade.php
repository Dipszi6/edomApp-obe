<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - EDOM UPS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css', 
    ])

    <style>
        /* ─── BASE STYLING (SINKRON DENGAN UI SEBELUMNYA) ─── */
        :root {
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --canary: #fcd34d;
            --accent-neon: #a855f7;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.08);
            --emerald: #10b981;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: #f8fafc;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .accent-title {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
        }

        .dashboard-container {
            max-width: 1100px;
            width: 100%;
            margin: 3rem auto 5rem auto;
            padding: 0 1.5rem;
            box-sizing: border-box;
        }

        /* ─── WELCOME BANNER ─── */
        .welcome-card {
            background: linear-gradient(135deg, rgba(30, 41, 59, 0.8), rgba(15, 23, 42, 0.9));
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .welcome-card::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: var(--accent-neon);
            filter: blur(100px);
            opacity: 0.15;
            pointer-events: none;
        }

        .user-meta h1 {
            font-size: 2rem;
            margin: 0 0 0.5rem 0;
        }

        .user-badge {
            background: rgba(252, 211, 77, 0.1);
            border: 1px solid var(--canary);
            color: var(--canary);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }

        /* ─── STATS GRID ─── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .stat-icon-box {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-ulasan { background: rgba(168, 85, 247, 0.15); color: var(--accent-neon); }
        .icon-upvote { background: rgba(252, 211, 77, 0.15); color: var(--canary); }
        .icon-status { background: rgba(160, 185, 16, 0.15); color: var(--emerald); }

        .stat-info .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1.2;
        }

        .stat-info .stat-label {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        /* ─── MAIN CONTENT SPLIT ─── */
        .content-layout {
            display: grid;
            grid-template-columns: 7fr 5fr;
            gap: 2rem;
        }

        .section-header-inline {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title-sub {
            font-size: 1.25rem;
            margin: 0;
        }

        /* ─── REVIEW LIST (TABLE/LIST STYLING) ─── */
        .review-list-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .my-review-card {
            background: rgba(30, 41, 59, 0.4);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.25rem;
            transition: border-color 0.3s;
        }

        .my-review-card:hover {
            border-color: rgba(255, 255, 255, 0.15);
        }

        .review-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .target-name {
            font-weight: 600;
            font-size: 1rem;
        }

        .target-type-badge {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
        }

        .review-stars {
            color: var(--canary);
            font-size: 0.9rem;
        }

        .review-text {
            color: #cbd5e1;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0 0 1rem 0;
        }

        .review-card-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--text-muted);
            border-top: 1px solid rgba(255, 255, 255, 0.04);
            padding-top: 0.75rem;
        }

        .upvote-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            color: var(--canary);
            background: rgba(252, 211, 77, 0.05);
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
        }

        /* ─── SIDEBAR / SECURITY NOTICE ─── */
        .sidebar-panel {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.5rem;
            height: fit-content;
        }

        .info-row {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
            align-items: flex-start;
        }

        .info-row svg {
            color: var(--canary);
            flex-shrink: 0;
            margin-top: 0.2rem;
        }

        .info-text h4 {
            margin: 0 0 0.25rem 0;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .info-text p {
            margin: 0;
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--text-muted);
            background: rgba(255,255,255,0.02);
            border-radius: 16px;
            border: 1px dashed var(--border-color);
        }

        .orb {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(140px);
            opacity: 0.1;
            z-index: -1;
        }
        .o-1 { top: 20%; left: -150px; background: var(--accent-neon); }
    </style>
</head>

<body>

    <!-- NAVBAR (Sama seperti halaman Beranda & Create) -->
    <nav style="padding: 1.5rem 4rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-color);">
        <a href="/" class="nav-logo" style="text-decoration:none; color:white; font-size:1.3rem; font-weight:700; font-family:'Syne'">EDOM<span style="color:var(--canary)"> UPS </span>Tegal</a>
        <div class="nav-cta" style="display: flex; align-items: center; gap: 1rem;">
            <a href="/search" class="btn-ghost" style="text-decoration:none; color:white; font-size:0.9rem;">Cari Dosen</a>
            
            <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: inline;">
                @csrf
                <button type="submit" style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; border: none; background: none; padding: 0.5rem 1rem;">
                    <i data-lucide="log-out" style="width: 16px; height: 16px; color: #ef4444;"></i> 
                    <span style="color: #ef4444; font-weight:500;">Keluar</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="orb o-1"></div>

    <!-- MAIN DASHBOARD CONTAINER -->
    <div class="dashboard-container">
        
        <!-- WELCOME BANNER -->
        <div class="welcome-card">
            <div class="user-meta">
                <span class="user-badge">Akun Mahasiswa Aktif</span>
                <!-- Mengambil nama asli untuk internal dashboard -->
                <h1 class="accent-title">Halo, {{ Auth::user()->name }}</h1>
                <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;">Selamat datang di panel kontribusi akademik kamu.</p>
            </div>
            <div>
                <a href="{{ route('review.create') }}" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                    <i data-lucide="plus-circle" style="width: 18px; height: 18px;"></i> Tulis Ulasan Baru
                </a>
            </div>
        </div>

        <!-- STATS COUNTER GRID -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon-box icon-ulasan">
                    <i data-lucide="message-square"></i>
                </div>
                <div class="stat-info">
                    <!-- Sesuai variabel total review user, default 0 jika belum ada data dari controller -->
                    <div class="stat-value">{{ $myReviewsCount ?? 0 }}</div>
                    <div class="stat-label">Total Ulasan Kamu</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box icon-upvote">
                    <i data-lucide="thumbs-up"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value">{{ $totalUpvotesReceived ?? 0 }}</div>
                    <div class="stat-label">Upvote Didapatkan</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon-box icon-status">
                    <i data-lucide="shield"></i>
                </div>
                <div class="stat-info">
                    <div class="stat-value" style="font-size:1.2rem; color:var(--emerald);">Terverifikasi</div>
                    <div class="stat-label">Status Anonimitas</div>
                </div>
            </div>
        </div>

        <!-- MAIN LAYOUT CONTENT -->
        <div class="content-layout">
            
            <!-- LEFT COLUMN: HISTORY OF REVIEWS -->
            <div>
                <div class="section-header-inline">
                    <h3 class="section-title-sub accent-title">Riwayat Ulasan Kamu</h3>
                    <span style="font-size: 0.85rem; color: var(--text-muted);">Hanya bisa dilihat olehmu</span>
                </div>

                <div class="review-list-wrapper">
                    <!-- Jika ada data ulasan dari backend -->
                    @if(isset($myReviews) && $myReviews->count() > 0)
                        @foreach($myReviews as $review)
                            <div class="my-review-card">
                                <div class="review-card-top">
                                    <div>
                                        <span class="target-type-badge">{{ $review->target_type }}</span>
                                        <div class="target-name">
                                            {{ $review->target_type === 'dosen' ? ($review->dosen->nama ?? 'Dosen Terhapus') : ($review->matkul->nama ?? 'Matkul Terhapus') }}
                                        </div>
                                    </div>
                                    <div class="review-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>
                                </div>
                                <p class="review-text">{{ $review->komentar }}</p>
                                <div class="review-card-bottom">
                                    <span>Dikirim pada {{ $review->created_at->format('d M Y') }}</span>
                                    <div class="upvote-indicator">
                                        <i data-lucide="thumbs-up" style="width:12px; height:12px;"></i> 
                                        <span>{{ $review->upvote_count ?? 0 }} Upvote</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Tampilan default jika mahasiswa belum pernah mengulas -->
                        <div class="empty-state">
                            <i data-lucide="folder-open" style="width: 40px; height: 40px; margin-bottom: 1rem; color: rgba(255,255,255,0.1);"></i>
                            <p style="margin: 0 0 1rem 0;">Kamu belum pernah memberikan ulasan sama sekali.</p>
                            <a href="{{ route('review.create') }}" class="btn-ghost" style="font-size: 0.85rem; padding: 0.5rem 1rem; text-decoration:none; color:var(--canary); border: 1px solid rgba(252,211,77,0.2);">Mulai ulasan pertama</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- RIGHT COLUMN: PRIVACY & SYSTEM INFO -->
            <div class="sidebar-panel">
                <h3 class="accent-title" style="font-size: 1.1rem; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 0.75rem;">Pedoman Enkripsi & Privasi</h3>
                
                <div class="info-row">
                    <i data-lucide="eye-off" style="width:20px; height:20px;"></i>
                    <div class="info-text">
                        <h4>Identitas Tersembunyi</h4>
                        <p>Nama asli dan email kamu yang tertera di banner atas tidak akan pernah dikaitkan dengan database ulasan publik. Sistem memisahkan entitas akun dengan data ulasan menggunakan token acak.</p>
                    </div>
                </div>

                <div class="info-row">
                    <i data-lucide="heart-handshake" style="width:20px; height:20px;"></i>
                    <div class="info-text">
                        <h4>Gunakan Bahasa Sopan</h4>
                        <p>Meskipun data bersifat anonim, hindari ujaran kebencian berupa SARA, ancaman, atau kata-kata kasar. Berikan kritik yang objektif mengenai metode pengajaran dan pemberian nilai.</p>
                    </div>
                </div>

                <div class="info-row">
                    <i data-lucide="award" style="width:20px; height:20px;"></i>
                    <div class="info-text">
                        <h4>Sistem Upvote</h4>
                        <p>Ulasan yang informatif cenderung akan mendapatkan banyak upvote dari mahasiswa lain, dan ulasan ber-upvote tinggi akan ditempatkan di posisi paling atas pada menu pencarian utama.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer style="margin-top:auto; padding: 2rem 4rem; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; background: rgba(15,23,42,0.5);">
        <div class="footer-logo" style="font-family:'Syne'; font-weight:700;">EDOM<span style="color:var(--canary)"> UPS </span>Tegal</div>
        <p class="footer-copy" style="margin:0; font-size:0.85rem; color:var(--text-muted);">© {{ date('Y') }} EDOM-UPSTEGAL · Mahasiswa Dashboard</p>
    </footer>

    <script>
        // Inisialisasi ikon Lucide
        lucide.createIcons();
    </script>
</body>
</html>