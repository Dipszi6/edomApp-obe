<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - EDOM</title>

    @vite([
        'resources/css/home.css',
        'resources/js/home.js'
    ])
</head>

<body>

<nav>
    <a href="/" class="nav-logo">
        EDOM<span> UPS</span> Tegal
    </a>

    <div class="nav-cta">
        <a href="/" class="btn-ghost">
            Kembali
        </a>
    </div>
</nav>

<section style="padding-top:10rem;max-width:1200px;margin:auto;">

    <span class="section-label">
        HASIL PENCARIAN
    </span>


    <p class="section-sub">
        Ditemukan
        <strong>{{ $dosens->count() }}</strong>
        dosen dan
        <strong>{{ $matkuls->count() }}</strong>
        mata kuliah.
    </p>

</section>

<div class="divider"></div>

{{-- DOSEN --}}
<section style="max-width:1200px;margin:auto;" id="dosen">

    <div style="margin-bottom:2rem;">
        <span class="section-label">
            DOSEN
        </span>

        <h2 class="section-title">
            Hasil Dosen
        </h2>
    </div>

    @if($dosens->count())

        <div class="cards-grid">

            @foreach($dosens as $dosen)

                <a href="/dosen/{{ $dosen->id }}"
                   class="dosen-card fade-up">

                    <div class="dosen-avatar">
                        {{ strtoupper(substr($dosen->nama,0,1)) }}
                    </div>

                    <h4>
                        {{ $dosen->nama }}
                    </h4>

                    <p class="dosen-jurusan">
                        NIDN : {{ $dosen->nidn }}
                    </p>

                    <p class="dosen-jurusan">
                        {{ $dosen->jurusan->nama ?? '-' }}
                    </p>

                    <div class="dosen-rating">

                        <span class="rating-num">
                            {{ number_format($dosen->avg_rating ?? 0,1) }}
                        </span>

                        <span class="rating-stars">

                            @for($i = 1; $i <= 5; $i++)

                                {{ $i <= round($dosen->avg_rating ?? 0) ? '★' : '☆' }}

                            @endfor

                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="bento-card span-12">
            <p>Tidak ada dosen yang ditemukan.</p>
        </div>

    @endif

</section>

<div class="divider"></div>

{{-- MATKUL --}}
<section style="max-width:1200px;margin:auto;" id="matkul">

    <div style="margin-bottom:2rem;">
        <span class="section-label">
            MATA KULIAH
        </span>

        <h2 class="section-title">
            Hasil Mata Kuliah
        </h2>
    </div>

    @if($matkuls->count())

        <div class="cards-grid">

            @foreach($matkuls as $matkul)

                <a href="/matkul/{{ $matkul->id }}"
                   class="dosen-card fade-up">

                    <div class="dosen-avatar">
                        📚
                    </div>

                    <h4>
                        {{ $matkul->nama }}
                    </h4>

                    <p class="dosen-jurusan">
                        {{ $matkul->kode }}
                    </p>

                    <p class="dosen-jurusan">
                        {{ $matkul->sks }} SKS
                        • Semester {{ $matkul->semester }}
                    </p>

                    <p class="dosen-jurusan">
                        {{ $matkul->jurusan->nama ?? '-' }}
                    </p>

                </a>

            @endforeach

        </div>

    @else

        <div class="bento-card span-12">
            <p>Tidak ada mata kuliah yang ditemukan.</p>
        </div>

    @endif

</section>

<footer>
    <div class="footer-logo">
        EDOM<span>UPS</span>
    </div>

    <p class="footer-copy">
        © {{ date('Y') }} EDOM UPS Tegal
    </p>
</footer>

</body>
</html>