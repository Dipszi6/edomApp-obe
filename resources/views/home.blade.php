<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDOM - UPS TEGAL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap"
        rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css',
        'resources/js/home.js'
    ])
    <style>
        /* CSS Tambahan Penyelarasan Ikon & Tombol Navbar */
        .bento-icon lucide-icon,
        .bento-icon svg {
            width: 32px;
            height: 32px;
            stroke-width: 1.75;
            color: var(--canary, #fcd34d);
        }

        .btn-icon {
            width: 16px;
            height: 16px;
            stroke-width: 2;
            vertical-align: middle;
            margin-left: 4px;
        }

        nav,
        .nav-cta {
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <nav>
        <a href="/" class="nav-logo">EDOM<span> UPS </span>Tegal</a>
        <ul class="nav-links">
            <li><a href="/search">Cari Dosen</a></li>
            <li><a href="/search?type=matkul">Mata Kuliah</a></li>
            <li><a href="#cara-kerja">Cara Kerja</a></li>
        </ul>
        <div class="nav-cta" style="gap: 1rem; display: flex; align-items: center;">
            @guest
                <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                <a href="/register" class="btn-primary">Daftar</a>
            @endguest

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}" class="btn-primary"
                        style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i> Panel Admin
                    </a>
                @elseif(Auth::user()->role === 'dosen')
                    <a href="{{ route('dashboard.dosen') }}" class="btn-primary"
                        style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="layout-dashboard" style="width: 16px; height: 16px;"></i> Dashboard Dosen
                    </a>
                @else
                    <a href="/search" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i> Tulis Ulasan
                    </a>
                @endif

                <form action="{{ route('logout') }}" method="POST" style="margin: 0; display: inline;">
                    @csrf
                    <button type="submit" class="btn-primary"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; cursor: pointer; border: none; background: none; padding: 0.5rem 1rem;">
                        <i data-lucide="log-out" style="width: 16px; height: 16px; color: #ef4444;"></i>
                        <span style="color: #ef4444;">Keluar</span>
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <section class="hero">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>

        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            Platform ulasan kampus, anonim & jujur
        </div>

        <h1 class="hero-title">
            Suara Mahasiswa,<br>
            <span class="accent">Nyata Adanya.</span>
        </h1>

        <p class="hero-sub">
            Beri rating dosen dan mata kuliah secara anonim.
            Bantu sesama mahasiswa memilih lebih bijak.
        </p>

        <div class="hero-actions">
            <a href="/search" class="btn-hero-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                Cari Dosen <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
            </a>

            @guest
                <a href="/register" class="btn-hero-ghost">Mulai Beri Ulasan</a>
            @endguest
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}" class="btn-hero-ghost">Kelola Ulasan</a>
                @elseif (Auth::user()->role === 'dosen')
                    <a href="{{ route('dashboard.dosen') }}" class="btn-hero-ghost">Lihat Statistik</a>
                @else
                    <a href="/search" class="btn-hero-ghost">Mulai Beri Ulasan</a>
                @endif
            @endauth
        </div>

        <div class="hero-stats">
            <div class="stat">
                <div class="stat-num">{{ $topDosens->count() }}+</div>
                <div class="stat-label">Dosen Terdata</div>
            </div>
            <div class="stat">
                <div class="stat-num">{{ $topMatkuls->count() }}+</div>
                <div class="stat-label">Mata Kuliah</div>
            </div>
            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Anonim</div>
            </div>
        </div>

        <div class="scroll-hint">
            <span>Scroll</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <div class="search-section">
        <form action="/search" method="GET" style="width:100%;max-width:640px;">
            <div class="search-box">
                <input type="text" name="q" placeholder="Cari nama dosen atau mata kuliah...">
                <button type="submit">Cari</button>
            </div>
        </form>
    </div>

    <section class="bento-section">
        <div class="bento-header">
            <span class="section-label">Fitur Platform</span>
            <h2 class="section-title" style="margin:0 auto;text-align:center;">
                Semua yang kamu butuhkan,<br>dalam satu tempat.
            </h2>
        </div>

        <div class="bento-grid">

            <div class="bento-card span-7 fade-up">
                <div class="bento-icon"><i data-lucide="star"></i></div>
                <h3>Rating Dosen & Mata Kuliah</h3>
                <p>Beri penilaian dari 1–5 bintang. Rata-rata rating diperbarui otomatis setiap ada ulasan baru.</p>
                <div class="mock-rating">
                    @foreach ($topDosens->take(3) as $dosen)
                        <div class="mock-row">
                            <span class="mock-name">{{ Str::limit($dosen->nama, 20) }}</span>
                            <span class="mock-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    {{ $i <= round($dosen->avg_rating) ? '★' : '☆' }}
                                @endfor
                            </span>
                            <span class="mock-score">{{ number_format($dosen->avg_rating, 1) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bento-card span-5 fade-up">
                <div class="bento-icon"><i data-lucide="shield-check"></i></div>
                <h3>100% Anonim</h3>
                <p>Identitasmu tidak akan pernah ditampilkan. Berikan pendapat jujur tanpa rasa khawatir.</p>
                <div class="mock-tags" style="margin-top:2rem;">
                    <span class="mock-tag">komunikatif</span>
                    <span class="mock-tag">nilai_adil</span>
                    <span class="mock-tag">materi_jelas</span>
                    <span class="mock-tag">tugas_wajar</span>
                    <span class="mock-tag">asik_orangnya</span>
                    <span class="mock-tag">recommended</span>
                </div>
            </div>

            <div class="bento-card span-4 fade-up">
                <div class="bento-icon"><i data-lucide="bar-chart-3"></i></div>
                <h3>Distribusi Rating</h3>
                <p>Lihat sebaran bintang secara visual untuk setiap dosen.</p>
                <div class="mock-bar-group">
                    <div class="mock-bar-row">
                        <span class="mock-bar-label">5</span>
                        <div class="mock-bar-track">
                            <div class="mock-bar-fill" style="width:75%"></div>
                        </div>
                        <span>75%</span>
                    </div>
                    <div class="mock-bar-row">
                        <span class="mock-bar-label">4</span>
                        <div class="mock-bar-track">
                            <div class="mock-bar-fill" style="width:15%"></div>
                        </div>
                        <span>15%</span>
                    </div>
                    <div class="mock-bar-row">
                        <span class="mock-bar-label">3</span>
                        <div class="mock-bar-track">
                            <div class="mock-bar-fill" style="width:7%"></div>
                        </div>
                        <span>7%</span>
                    </div>
                    <div class="mock-bar-row">
                        <span class="mock-bar-label">2</span>
                        <div class="mock-bar-track">
                            <div class="mock-bar-fill" style="width:2%"></div>
                        </div>
                        <span>2%</span>
                    </div>
                    <div class="mock-bar-row">
                        <span class="mock-bar-label">1</span>
                        <div class="mock-bar-track">
                            <div class="mock-bar-fill" style="width:1%"></div>
                        </div>
                        <span>1%</span>
                    </div>
                </div>
            </div>

            <div class="bento-card span-4 fade-up">
                <div class="bento-icon"><i data-lucide="thumbs-up"></i></div>
                <h3>Upvote Ulasan</h3>
                <p>Ulasan yang paling membantu naik ke atas. Satu vote per pengguna untuk menjaga integritas.</p>
            </div>

            <div class="bento-card span-4 fade-up">
                <div class="bento-icon"><i data-lucide="search"></i></div>
                <h3>Cari & Filter</h3>
                <p>Filter berdasarkan nama dosen, mata kuliah, atau jurusan. Temukan yang kamu cari dalam hitungan
                    detik.</p>
            </div>

        </div>
    </section>

    <div class="divider"></div>

    @if($topDosens->count())
        <div class="cards-section">
            <div class="cards-header">
                <div>
                    <span class="section-label">Top Rating</span>
                    <h2 class="section-title">Dosen Terbaik<br>Bulan Ini</h2>
                </div>
                <a href="/search" style="display: inline-flex; align-items: center; gap: 0.25rem;">Lihat semua <i
                        data-lucide="arrow-right" style="width:14px; height:14px;"></i></a>
            </div>

            <div class="cards-grid">
                @foreach($topDosens as $dosen)
                    <a href="/dosen/{{ $dosen->id }}" class="dosen-card fade-up">
                        <div class="dosen-avatar">
                            {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                        </div>
                        <h4>{{ $dosen->nama }}</h4>
                        <p class="dosen-jurusan">{{ $dosen->jurusan->nama ?? '—' }}</p>
                        <div class="dosen-rating">
                            <span class="rating-num">{{ number_format($dosen->avg_rating, 1) }}</span>
                            <span class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= round($dosen->avg_rating) ? '★' : '☆' }}
                                @endfor
                            </span>
                            <span class="rating-count">{{ $dosen->total_review }} ulasan</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    <div class="divider"></div>

    <section class="steps-section" id="cara-kerja">
        <div>
            <span class="section-label">Cara Kerja</span>
            <h2 class="section-title">Tiga langkah,<br>langsung berdampak.</h2>
        </div>

        <div class="steps-grid">
            <div class="step-card fade-up">
                <div class="step-number">01</div>
                <h3>Daftar dengan Email Kampus</h3>
                <p>Verifikasi dengan email institusi untuk memastikan hanya civitas akademika yang bisa memberi ulasan.
                </p>
            </div>
            <div class="step-card fade-up">
                <div class="step-number">02</div>
                <h3>Cari Dosen atau Matkul</h3>
                <p>Gunakan fitur pencarian untuk menemukan dosen atau mata kuliah yang ingin kamu ulas.</p>
            </div>
            <div class="step-card fade-up">
                <div class="step-number">03</div>
                <h3>Beri Rating & Ulasan</h3>
                <p>Isi bintang, tulis ulasan singkat, dan pilih tag yang sesuai. Semua ditampilkan secara anonim.</p>
            </div>
            <div class="step-card fade-up">
                <div class="step-number">04</div>
                <h3>Bantu Sesama Mahasiswa</h3>
                <p>Ulasanmu membantu junior dalam memilih mata kuliah dan mempersiapkan diri lebih baik.</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="cta-bg"></div>
        <div style="position:relative;z-index:1;">
            <span class="section-label">Mulai Sekarang</span>
            <h2 class="section-title">Jadilah bagian dari<br><span style="color:var(--canary)">perubahan kampus.</span>
            </h2>
            <p class="section-sub">Bergabunglah dan bantu sesama mahasiswa membuat keputusan akademik yang lebih cerdas.
            </p>
            <div class="cta-actions">
                @guest
                    <a href="/register" class="btn-hero-primary"
                        style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        Daftar Gratis <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
                    </a>
                @endguest
                @auth
                    <a href="/search" class="btn-hero-primary"
                        style="display: inline-flex; align-items: center; gap: 0.5rem;">
                        Cari Komponen <i data-lucide="search" style="width:16px; height:16px;"></i>
                    </a>
                @endauth
                <a href="/search" class="btn-hero-ghost">Lihat Ulasan</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-logo">EDOM<span> UPS </span>Tegal</div>
        <nav>
            <a href="/search">Cari Dosen</a>
            @guest
                <a href="/login">Masuk</a>
                <a href="/register">Daftar</a>
            @endguest
            @auth
                <a href="/search">Tulis Ulasan</a>
            @endauth
        </nav>
        <p class="footer-copy">© {{ date('Y') }} EDOM-UPSTEGAL · Dibuat oleh Kelompok 3</p>
    </footer>

    <script>
        // Jalankan parser Lucide Icons di akhir body
        lucide.createIcons();
    </script>
</body>

</html>