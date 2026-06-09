<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $dosen->nama }} - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite(['resources/css/home.css', 'resources/js/home.js'])
</head>
<body>

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    {{-- Navbar --}}
    <nav>
        <a href="/" class="nav-logo">EDOM<span> UPS </span>Tegal</a>
        <div class="nav-cta">
            @auth
                <a href="{{ Auth::user()->role === 'admin' ? route('dashboard.admin') : (Auth::user()->role === 'dosen' ? route('dashboard.dosen') : '/') }}" class="btn-ghost">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-ghost" style="cursor:pointer;background:transparent;">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-ghost">Masuk</a>
                <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
            @endauth
        </div>
    </nav>

    {{-- ═══ HERO PROFILE ═══ --}}
    <section style="padding:7rem 5% 3rem;position:relative;z-index:1;">
        <div style="max-width:900px;margin:0 auto;">

            {{-- Breadcrumb --}}
            <div style="display:flex;align-items:center;gap:0.5rem;font-size:0.8rem;color:rgba(255,255,255,0.35);margin-bottom:2rem;" class="fade-up">
                <a href="/" style="color:rgba(255,255,255,0.35);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.35)'">Beranda</a>
                <i data-lucide="chevron-right" style="width:14px;height:14px;"></i>
                <a href="/search" style="color:rgba(255,255,255,0.35);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='rgba(255,255,255,0.35)'">Dosen</a>
                <i data-lucide="chevron-right" style="width:14px;height:14px;"></i>
                <span style="color:rgba(255,255,255,0.65);">{{ $dosen->nama }}</span>
            </div>

            {{-- Profile Card --}}
            <div style="
                background:rgba(6,26,84,0.3);
                border:1px solid rgba(255,255,255,0.08);
                border-radius:20px;
                padding:2.5rem;
                display:flex;
                align-items:flex-start;
                gap:2rem;
                flex-wrap:wrap;
                margin-bottom:1.5rem;
            " class="fade-up">

                {{-- Avatar --}}
                <div style="
                    width:88px;height:88px;
                    border-radius:20px;
                    background:linear-gradient(135deg,var(--deep-navy),var(--navy-mid));
                    border:2px solid rgba(255,246,78,0.25);
                    display:flex;align-items:center;justify-content:center;
                    font-family:'Poppins',sans-serif;font-weight:800;font-size:2rem;
                    color:var(--canary);flex-shrink:0;
                ">
                    {{ strtoupper(substr($dosen->nama, 0, 1)) }}
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:200px;">
                    <span class="section-label" style="margin-bottom:0.4rem;">Dosen</span>
                    <h1 style="font-family:'Poppins',sans-serif;font-size:1.75rem;font-weight:800;letter-spacing:-0.02em;margin-bottom:0.25rem;">
                        {{ $dosen->nama }}
                    </h1>
                    <p style="color:rgba(255,255,255,0.5);font-size:0.875rem;margin-bottom:1rem;">
                        {{ $dosen->gelar ?? 'Dosen' }} &middot; {{ $dosen->jurusan->nama ?? '—' }}
                    </p>

                    <div style="display:flex;align-items:center;gap:0.5rem;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:0.4rem;padding:0.35rem 0.85rem;background:rgba(255,246,78,0.1);border:1px solid rgba(255,246,78,0.2);border-radius:8px;">
                            <i data-lucide="id-card" style="width:14px;height:14px;color:var(--canary);"></i>
                            <span style="font-size:0.8rem;color:var(--canary);font-weight:500;">{{ $dosen->nidn }}</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.4rem;padding:0.35rem 0.85rem;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;">
                            <i data-lucide="landmark" style="width:14px;height:14px;color:rgba(255,255,255,0.4);"></i>
                            <span style="font-size:0.8rem;color:rgba(255,255,255,0.6);">{{ $dosen->jurusan->fakultas ?? '—' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Rating Summary --}}
                <div style="
                    background:rgba(255,246,78,0.06);
                    border:1px solid rgba(255,246,78,0.15);
                    border-radius:16px;
                    padding:1.5rem 2rem;
                    text-align:center;
                    flex-shrink:0;
                ">
                    <div style="font-family:'Poppins',sans-serif;font-size:3rem;font-weight:800;color:var(--canary);line-height:1;">
                        {{ number_format($dosen->avg_rating, 1) }}
                    </div>
                    <div style="color:var(--canary);font-size:1rem;margin:0.3rem 0;letter-spacing:2px;">
                        @for($i = 1; $i <= 5; $i++){{ $i <= round($dosen->avg_rating) ? '★' : '☆' }}@endfor
                    </div>
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.35);">
                        {{ $dosen->total_review }} ulasan
                    </div>
                </div>

            </div>

            {{-- Rating Distribution --}}
            <div style="
                background:rgba(6,26,84,0.2);
                border:1px solid rgba(255,255,255,0.06);
                border-radius:16px;
                padding:1.5rem 2rem;
                margin-bottom:2.5rem;
                display:flex;
                gap:3rem;
                flex-wrap:wrap;
                align-items:center;
            " class="fade-up">
                <div>
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.75rem;">
                        Distribusi Rating
                    </div>
                    @for($star = 5; $star >= 1; $star--)
                        @php
                            $count = $dosen->reviews->where('rating', $star)->count();
                            $pct   = $dosen->reviews->count() > 0 ? round(($count / $dosen->reviews->count()) * 100) : 0;
                        @endphp
                        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:0.4rem;font-size:0.75rem;color:rgba(255,255,255,0.45);">
                            <span style="width:10px;text-align:right;">{{ $star }}</span>
                            <div style="width:160px;height:6px;background:rgba(255,255,255,0.07);border-radius:999px;overflow:hidden;">
                                <div style="height:100%;width:{{ $pct }}%;background:var(--canary);border-radius:999px;"></div>
                            </div>
                            <span style="width:28px;">{{ $count }}</span>
                        </div>
                    @endfor
                </div>

                {{-- Tags terpopuler --}}
                @if($dosen->reviews->count())
                <div style="flex:1;">
                    <div style="font-size:0.75rem;color:rgba(255,255,255,0.35);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:0.75rem;">
                        Tag Terpopuler
                    </div>
                    @php
                        $allTags = $dosen->reviews->pluck('tags')->filter()->flatten()->countBy()->sortDesc()->take(8);
                    @endphp
                    <div style="display:flex;flex-wrap:wrap;gap:0.4rem;">
                        @foreach($allTags as $tag => $count)
                        <span style="
                            padding:0.3rem 0.75rem;
                            background:rgba(255,246,78,0.08);
                            border:1px solid rgba(255,246,78,0.18);
                            border-radius:999px;
                            font-size:0.72rem;
                            color:var(--canary);
                            font-weight:500;
                        ">{{ $tag }} <span style="opacity:0.5;">({{ $count }})</span></span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- CTA Beri Ulasan --}}
                @auth
                @if(Auth::user()->isMahasiswa())
                <a href="{{ route('review.create', ['dosen_id' => $dosen->id]) }}"
                   style="
                    display:flex;align-items:center;gap:0.6rem;
                    padding:0.85rem 1.5rem;
                    background:var(--canary);
                    border-radius:10px;
                    color:var(--ink-black);
                    text-decoration:none;
                    font-weight:700;
                    font-size:0.875rem;
                    font-family:'Poppins',sans-serif;
                    transition:transform 0.15s,box-shadow 0.2s;
                    white-space:nowrap;
                   "
                   onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(255,246,78,0.3)'"
                   onmouseout="this.style.transform='';this.style.boxShadow=''">
                    <i data-lucide="pencil" style="width:16px;height:16px;"></i>
                    Beri Ulasan
                </a>
                @endif
                @else
                <a href="{{ route('login') }}"
                   style="
                    display:flex;align-items:center;gap:0.6rem;
                    padding:0.85rem 1.5rem;
                    background:var(--canary);
                    border-radius:10px;
                    color:var(--ink-black);
                    text-decoration:none;
                    font-weight:700;
                    font-size:0.875rem;
                    font-family:'Poppins',sans-serif;
                    white-space:nowrap;
                   ">
                    <i data-lucide="pencil" style="width:16px;height:16px;"></i>
                    Beri Ulasan
                </a>
                @endauth

            </div>

            {{-- ═══ ULASAN ═══ --}}
            <div class="fade-up">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                    <h2 style="font-family:'Poppins',sans-serif;font-weight:700;font-size:1.3rem;">
                        Ulasan Mahasiswa
                        <span style="color:rgba(255,255,255,0.3);font-size:1rem;font-weight:400;">({{ $dosen->total_review }})</span>
                    </h2>
                </div>

                {{-- 10 ulasan pertama --}}
                @forelse($dosen->reviews->take(10) as $index => $review)
                <div style="
                    background:rgba(6,26,84,0.25);
                    border:1px solid rgba(255,255,255,0.07);
                    border-radius:14px;
                    padding:1.5rem;
                    margin-bottom:1rem;
                    transition:border-color 0.2s;
                " onmouseover="this.style.borderColor='rgba(255,246,78,0.15)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'">

                    {{-- Header --}}
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:0.75rem;gap:1rem;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:0.75rem;">
                            <div style="
                                width:38px;height:38px;border-radius:10px;
                                background:linear-gradient(135deg,var(--deep-navy),var(--navy-mid));
                                border:1px solid rgba(255,246,78,0.15);
                                display:flex;align-items:center;justify-content:center;
                                font-family:'Poppins',sans-serif;font-weight:700;font-size:0.9rem;
                                color:var(--canary);
                            ">
                                {{ $review->is_anonim ? '?' : strtoupper(substr($review->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:600;font-size:0.875rem;">
                                    {{ $review->is_anonim ? 'Anonim' : ($review->user->name ?? 'Mahasiswa') }}
                                </div>
                                <div style="font-size:0.72rem;color:rgba(255,255,255,0.35);">
                                    {{ $review->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:0.4rem;">
                            <span style="color:var(--canary);font-size:0.8rem;letter-spacing:1px;">
                                @for($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                            </span>
                            <span style="font-family:'Poppins',sans-serif;font-weight:700;font-size:0.9rem;color:var(--canary);">
                                {{ $review->rating }}.0
                            </span>
                        </div>
                    </div>

                    {{-- Matkul badge --}}
                    @if($review->matkul)
                    <div style="margin-bottom:0.6rem;">
                        <span style="
                            display:inline-flex;align-items:center;gap:0.35rem;
                            padding:0.2rem 0.65rem;
                            background:rgba(255,255,255,0.05);
                            border:1px solid rgba(255,255,255,0.1);
                            border-radius:6px;
                            font-size:0.72rem;
                            color:rgba(255,255,255,0.5);
                        ">
                            <i data-lucide="book-open" style="width:11px;height:11px;"></i>
                            {{ $review->matkul->nama }}
                        </span>
                    </div>
                    @endif

                    {{-- Ulasan --}}
                    <p style="color:rgba(255,255,255,0.7);font-size:0.875rem;line-height:1.7;">
                        {{ $review->ulasan }}
                    </p>

                    {{-- Tags --}}
                    @if($review->tags)
                    <div style="display:flex;flex-wrap:wrap;gap:0.35rem;margin-top:0.75rem;">
                        @foreach($review->tags as $tag)
                        <span style="
                            padding:0.25rem 0.65rem;
                            background:rgba(255,246,78,0.08);
                            border:1px solid rgba(255,246,78,0.15);
                            border-radius:999px;
                            font-size:0.7rem;
                            color:var(--canary);
                            font-weight:500;
                        ">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Upvote --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:0.85rem;padding-top:0.75rem;border-top:1px solid rgba(255,255,255,0.05);">
                        <div style="display:flex;align-items:center;gap:0.4rem;font-size:0.75rem;color:rgba(255,255,255,0.35);">
                            <i data-lucide="thumbs-up" style="width:13px;height:13px;"></i>
                            {{ $review->upvotes }} orang merasa terbantu
                        </div>
                        @auth
                        <form method="POST" action="{{ route('review.upvote', $review->id) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" style="
                                display:flex;align-items:center;gap:0.35rem;
                                padding:0.3rem 0.75rem;
                                border-radius:7px;
                                border:1px solid rgba(255,255,255,0.1);
                                background:rgba(255,255,255,0.04);
                                color:rgba(255,255,255,0.5);
                                font-size:0.75rem;
                                cursor:pointer;
                                transition:0.2s;
                                font-family:'Poppins',sans-serif;
                            "
                            onmouseover="this.style.borderColor='rgba(255,246,78,0.25)';this.style.color='var(--canary)'"
                            onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='rgba(255,255,255,0.5)'">
                                <i data-lucide="thumbs-up" style="width:12px;height:12px;"></i>
                                Helpful
                            </button>
                        </form>
                        @endauth
                    </div>

                </div>
                @empty
                <div style="text-align:center;padding:4rem 0;">
                    <i data-lucide="inbox" style="width:40px;height:40px;color:rgba(255,255,255,0.15);margin-bottom:1rem;display:block;margin:0 auto 1rem;"></i>
                    <p style="color:rgba(255,255,255,0.35);">Belum ada ulasan untuk dosen ini.</p>
                    @auth
                    @if(Auth::user()->isMahasiswa())
                    <a href="{{ route('review.create', ['dosen_id' => $dosen->id]) }}" style="display:inline-flex;align-items:center;gap:0.5rem;margin-top:1rem;color:var(--canary);text-decoration:none;font-size:0.875rem;font-weight:600;">
                        <i data-lucide="pencil" style="width:14px;height:14px;"></i>
                        Jadilah yang pertama memberi ulasan
                    </a>
                    @endif
                    @endauth
                </div>
                @endforelse

                {{-- Locked Section — sisanya perlu login --}}
                @if($dosen->reviews->count() > 10)
                <div style="position:relative;margin-top:-1rem;">

                    {{-- Blur overlay --}}
                    <div style="
                        position:absolute;top:0;left:0;right:0;
                        height:120px;
                        background:linear-gradient(to bottom,transparent,var(--ink-black));
                        z-index:2;pointer-events:none;
                    "></div>

                    {{-- Dummy blurred reviews --}}
                    @for($b = 0; $b < 2; $b++)
                    <div style="
                        background:rgba(6,26,84,0.2);
                        border:1px solid rgba(255,255,255,0.05);
                        border-radius:14px;
                        padding:1.5rem;
                        margin-bottom:1rem;
                        filter:blur(4px);
                        pointer-events:none;
                        user-select:none;
                    ">
                        <div style="display:flex;gap:0.75rem;margin-bottom:0.75rem;">
                            <div style="width:38px;height:38px;border-radius:10px;background:rgba(255,255,255,0.06);"></div>
                            <div>
                                <div style="width:100px;height:10px;background:rgba(255,255,255,0.08);border-radius:4px;margin-bottom:6px;"></div>
                                <div style="width:60px;height:8px;background:rgba(255,255,255,0.05);border-radius:4px;"></div>
                            </div>
                        </div>
                        <div style="width:100%;height:10px;background:rgba(255,255,255,0.06);border-radius:4px;margin-bottom:6px;"></div>
                        <div style="width:80%;height:10px;background:rgba(255,255,255,0.05);border-radius:4px;"></div>
                    </div>
                    @endfor

                    {{-- Login prompt --}}
                    <div style="
                        position:relative;z-index:3;
                        text-align:center;
                        padding:2.5rem 1.5rem;
                        background:rgba(6,26,84,0.4);
                        border:1px solid rgba(255,246,78,0.15);
                        border-radius:16px;
                        backdrop-filter:blur(12px);
                        margin-top:0.5rem;
                    ">
                        <div style="
                            width:52px;height:52px;
                            border-radius:14px;
                            background:rgba(255,246,78,0.1);
                            border:1px solid rgba(255,246,78,0.2);
                            display:flex;align-items:center;justify-content:center;
                            margin:0 auto 1rem;
                        ">
                            <i data-lucide="lock" style="width:22px;height:22px;color:var(--canary);"></i>
                        </div>
                        <h3 style="font-family:'Poppins',sans-serif;font-weight:700;font-size:1.1rem;margin-bottom:0.5rem;">
                            {{ $dosen->reviews->count() - 10 }} ulasan lainnya tersembunyi
                        </h3>
                        <p style="color:rgba(255,255,255,0.45);font-size:0.875rem;margin-bottom:1.5rem;max-width:360px;margin-left:auto;margin-right:auto;line-height:1.6;">
                            Login untuk melihat semua ulasan dan membantu sesama mahasiswa membuat keputusan yang lebih baik.
                        </p>
                        <div style="display:flex;gap:0.75rem;justify-content:center;flex-wrap:wrap;">
                            <a href="{{ route('login') }}" style="
                                padding:0.7rem 1.5rem;
                                background:var(--canary);
                                border-radius:9px;
                                color:var(--ink-black);
                                text-decoration:none;
                                font-weight:700;
                                font-size:0.875rem;
                                font-family:'Poppins',sans-serif;
                                display:inline-flex;align-items:center;gap:0.5rem;
                            ">
                                <i data-lucide="log-in" style="width:15px;height:15px;"></i>
                                Masuk Sekarang
                            </a>
                            <a href="{{ route('register') }}" style="
                                padding:0.7rem 1.5rem;
                                border:1px solid rgba(255,255,255,0.15);
                                border-radius:9px;
                                color:var(--white);
                                text-decoration:none;
                                font-size:0.875rem;
                                font-weight:500;
                                display:inline-flex;align-items:center;gap:0.5rem;
                            ">
                                Daftar Gratis
                            </a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </section>

    <footer style="padding:2.5rem 5%;border-top:1px solid rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;position:relative;z-index:1;">
        <div style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.1rem;">
            EDOM<span style="color:var(--canary);"> UPS </span>Tegal
        </div>
        <p style="font-size:0.8rem;color:rgba(255,255,255,0.3);">© {{ date('Y') }} EDOM UPS Tegal · Kelompok 5</p>
    </footer>

    <script>
        lucide.createIcons();
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>

</body>
</html>