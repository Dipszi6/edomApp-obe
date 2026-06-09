<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beri Ulasan - EDOM UPS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    @vite([
        'resources/css/home.css', 
    ])

    <style>
        /* ─── BASE STYLING (MENYESUAIKAN HOME UI) ─── */
        :root {
            --bg-dark: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --canary: #fcd34d;
            --accent-neon: #a855f7;
            --text-muted: #94a3b8;
            --border-color: rgba(255, 255, 255, 0.08);
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

        /* FIXED NAVBAR STYLING */
        .main-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            padding: 0 4rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            background-color: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(12px);
            z-index: 1000;
        }

        /* FIX JARAk CONTENT AGAR TIDAK TERTUTUP NAVBAR */
        .content-wrapper {
            margin-top: 70px; /* Persis setinggi navbar fixed */
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        /* ─── STEP PROGRESS BAR ─── */
        .step-container {
            max-width: 680px;
            width: 100%;
            margin: 3rem auto 1.5rem auto;
            padding: 0 1.5rem;
            box-sizing: border-box;
        }

        .progress-bar-wrapper {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 3rem;
        }

        .progress-line {
            position: absolute;
            top: 20px;
            left: 0;
            height: 3px;
            background: rgba(255, 255, 255, 0.1);
            width: 100%;
            z-index: 1;
        }

        .progress-line-fill {
            position: absolute;
            top: 20px;
            left: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--canary), var(--accent-neon));
            width: 0%;
            z-index: 2;
            transition: width 0.4s ease;
        }

        .step-node {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .step-circle {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #1e293b;
            border: 2px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
            color: var(--text-muted);
        }

        .step-node.active .step-circle {
            border-color: var(--canary);
            background: #0f172a;
            color: var(--canary);
            box-shadow: 0 0 15px rgba(252, 211, 77, 0.3);
        }

        .step-node.completed .step-circle {
            border-color: var(--accent-neon);
            background: var(--accent-neon);
            color: white;
        }

        .step-label {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .step-node.active .step-label {
            color: white;
        }

        /* ─── FORM CONTAINER CARD ─── */
        .form-card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem;
            margin-bottom: 5rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            position: relative;
            width: 100%;
            box-sizing: border-box;
        }

        .form-step-panel {
            display: none;
        }

        .form-step-panel.active {
            display: block;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .panel-title {
            font-size: 1.5rem;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .panel-sub {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .select-input-group {
            margin-top: 1.5rem;
        }

        select, textarea {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.85rem 1rem;
            color: white;
            font-family: inherit;
            font-size: 0.95rem;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s;
        }

        select option {
            background-color: var(--bg-dark);
            color: white;
        }

        select:focus, textarea:focus {
            border-color: var(--accent-neon);
        }

        /* ─── STEP 2 UI (STARS) ─── */
        .stars-rating-container {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 1rem;
            margin: 3rem 0;
        }

        .stars-rating-container input {
            display: none;
        }

        .stars-rating-container label {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .stars-rating-container label svg {
            width: 48px;
            height: 48px;
            fill: transparent;
            stroke: rgba(255, 255, 255, 0.2);
            stroke-width: 1.5;
            transition: all 0.2s;
        }

        .stars-rating-container input:checked ~ label svg,
        .stars-rating-container label:hover ~ input:checked ~ label svg,
        .stars-rating-container label:hover svg,
        .stars-rating-container label:hover ~ label svg {
            fill: var(--canary);
            stroke: var(--canary);
            filter: drop-shadow(0 0 8px rgba(252, 211, 77, 0.5));
        }

        .stars-rating-container label:active {
            transform: scale(0.9);
        }

        .rating-desc-text {
            text-align: center;
            font-weight: 600;
            color: var(--canary);
            height: 24px;
            margin-bottom: 1rem;
        }

        /* ─── STEP 3 UI (TAGS) ─── */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 0.75rem;
            margin-bottom: 2rem;
        }

        .tag-checkbox {
            display: none;
        }

        .tag-pill {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border-color);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s;
            user-select: none;
        }

        .tag-pill:hover {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .tag-checkbox:checked + .tag-pill {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.2), rgba(252, 211, 77, 0.1));
            border-color: var(--accent-neon);
            color: white;
            box-shadow: 0 0 10px rgba(168, 85, 247, 0.2);
        }

        /* ─── STEP 4 UI (CONFIRMATION) ─── */
        .review-summary-box {
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .summary-item:last-child {
            border-bottom: none;
            flex-direction: column;
            gap: 0.5rem;
        }

        .summary-label {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .summary-value {
            font-weight: 500;
            text-align: right;
        }

        /* ─── BUTTONS NAVIGATION ─── */
        .action-buttons-group {
            display: flex;
            justify-content: space-between;
            margin-top: 3rem;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 1.5rem;
        }

        .orb {
            position: absolute;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            z-index: -1;
        }
        .o-1 { top: 10%; left: -100px; background: var(--accent-neon); }
        .o-2 { bottom: 5%; right: -100px; background: var(--canary); }
    </style>
</head>

<body>

    <nav class="main-navbar">
        <a href="/" class="nav-logo" style="text-decoration:none; color:white; font-size:1.3rem; font-weight:700; font-family:'Syne'">EDOM<span style="color:var(--canary)"> UPS </span>Tegal</a>
        <div class="nav-cta">
            <a href="/" class="btn-ghost" style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration:none; color:white;">
                <i data-lucide="arrow-left" style="width:16px; height:16px;"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="orb o-1"></div>
    <div class="orb o-2"></div>

    <div class="content-wrapper">
        <div class="step-container">
            
            <div class="progress-bar-wrapper">
                <div class="progress-line"></div>
                <div class="progress-line-fill" id="progressBarFill"></div>

                <div class="step-node active" data-step="1">
                    <div class="step-circle">1</div>
                    <div class="step-label">Pilih Kelas</div>
                </div>
                <div class="step-node" data-step="2">
                    <div class="step-circle">2</div>
                    <div class="step-label">Beri Rating</div>
                </div>
                <div class="step-node" data-step="3">
                    <div class="step-circle">3</div>
                    <div class="step-label">Tulis Ulasan</div>
                </div>
                <div class="step-node" data-step="4">
                    <div class="step-circle">4</div>
                    <div class="step-label">Konfirmasi</div>
                </div>
            </div>

            <form action="{{ route('review.store') }}" method="POST" id="reviewForm" class="form-card">
                @csrf
                
                <input type="hidden" name="is_anonim" value="1">

                <div class="form-step-panel active" data-panel="1">
                    <h2 class="panel-title accent-title">Pilih Kelas & Dosen</h2>
                    <p class="panel-sub">Silakan pilih Dosen Pengajar serta Mata Kuliah yang ingin kamu nilai.</p>

                    <div class="select-input-group">
                        <label style="display:block; margin-bottom:0.5rem; font-size:0.9rem; color:var(--text-muted)">Dosen Pengajar:</label>
                        <select name="dosen_id" id="dosenSelect">
                            <option value="" disabled {{ !isset($selectedDosenId) ? 'selected' : '' }}>-- Pilih Dosen --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ (isset($selectedDosenId) && $selectedDosenId == $dosen->id) ? 'selected' : '' }}>
                                    {{ $dosen->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="select-input-group">
                        <label style="display:block; margin-bottom:0.5rem; font-size:0.9rem; color:var(--text-muted)">Mata Kuliah:</label>
                        <select name="matkul_id" id="matkulSelect">
                            <option value="" disabled {{ !isset($selectedMatkulId) ? 'selected' : '' }}>-- Pilih Mata Kuliah --</option>
                            @foreach($matkuls as $matkul)
                                <option value="{{ $matkul->id }}" {{ (isset($selectedMatkulId) && $selectedMatkulId == $matkul->id) ? 'selected' : '' }}>
                                    {{ $matkul->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-step-panel" data-panel="2">
                    <h2 class="panel-title accent-title" style="text-align:center;">Beri Skor Penilaian</h2>
                    <p class="panel-sub" style="text-align:center;">Penilaian bersifat anonim. Berikan rating secara jujur.</p>

                    <div class="stars-rating-container">
                        <input type="radio" name="rating" id="star5" value="5"><label for="star5"><i data-lucide="star"></i></label>
                        <input type="radio" name="rating" id="star4" value="4"><label for="star4"><i data-lucide="star"></i></label>
                        <input type="radio" name="rating" id="star3" value="3"><label for="star3"><i data-lucide="star"></i></label>
                        <input type="radio" name="rating" id="star2" value="2"><label for="star2"><i data-lucide="star"></i></label>
                        <input type="radio" name="rating" id="star1" value="1"><label for="star1"><i data-lucide="star"></i></label>
                    </div>
                    <div class="rating-desc-text" id="ratingText">Pilih bintang untuk menilai</div>
                </div>


                <div class="form-step-panel" data-panel="3">
                    <h2 class="panel-title accent-title">Tulis Ulasan & Tag</h2>
                    <p class="panel-sub">Tulis kritikan atau pujian membangun, sertakan tag penanda yang paling menggambarkan keadaan.</p>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="display:block; margin-bottom:0.5rem; font-size:0.9rem; color:var(--text-muted)">Pendapat Jujur Kamu:</label>
                        <textarea name="ulasan" id="komentarText" rows="4" placeholder="Tulis cara mengajar, pemberian nilai, atau fleksibilitas tugas di sini. Minimum 10 karakter."></textarea>
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-size:0.9rem; color:var(--text-muted)">Pilih Tag yang Sesuai:</label>
                        <div class="tags-container">
                            <label>
                                <input type="checkbox" name="tags[]" value="Komunikatif" class="tag-checkbox">
                                <div class="tag-pill">#Komunikatif</div>
                            </label>
                            <label>
                                <input type="checkbox" name="tags[]" value="Nilai Adil" class="tag-checkbox">
                                <div class="tag-pill">#NilaiAdil</div>
                            </label>
                            <label>
                                <input type="checkbox" name="tags[]" value="Materi Jelas" class="tag-checkbox">
                                <div class="tag-pill">#MateriJelas</div>
                            </label>
                            <label>
                                <input type="checkbox" name="tags[]" value="Banyak Tugas" class="tag-checkbox">
                                <div class="tag-pill">#BanyakTugas</div>
                            </label>
                            <label>
                                <input type="checkbox" name="tags[]" value="Asik Pol" class="tag-checkbox">
                                <div class="tag-pill">#AsikPol</div>
                            </label>
                        </div>
                    </div>
                </div>


                <div class="form-step-panel" data-panel="4">
                    <h2 class="panel-title accent-title"><i data-lucide="shield-check" style="vertical-align:middle;color:var(--canary);margin-right:0.5rem;"></i> Cek Sebelum Mengirim</h2>
                    <p class="panel-sub">Ulasan yang dikirim tidak dapat diubah kembali. Sistem menjaga identitasmu tetap anonim.</p>

                    <div class="review-summary-box">
                        <div class="summary-item">
                            <span class="summary-label">Target Review</span>
                            <span class="summary-value" id="summaryTarget">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Skor Rating</span>
                            <span class="summary-value" id="summaryRating" style="color:var(--canary); font-weight:700;">—</span>
                        </div>
                        <div class="summary-item">
                            <span class="summary-label">Isi Ulasan Singkat</span>
                            <p class="summary-value" id="summaryComment" style="margin:0; text-align: left; background:rgba(255,255,255,0.02); padding:0.75rem; border-radius:8px; font-size:0.9rem; line-height:1.5; width:100%; box-sizing:border-box;">—</p>
                        </div>
                    </div>
                </div>

                <div class="action-buttons-group">
                    <button type="button" class="btn-ghost" id="prevBtn" onclick="moveStep(-1)" style="visibility:hidden; cursor:pointer; background:none; border:none; color:white; font-family:inherit;">
                        Sebelumnya
                    </button>
                    <button type="button" class="btn-primary" id="nextBtn" onclick="moveStep(1)" style="cursor:pointer; display:inline-flex; align-items:center; gap:0.5rem;">
                        Lanjutkan <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        const ratingLabels = {
            1: "Buruk / Tidak Direkomendasikan",
            2: "Kurang Memuaskan",
            3: "Cukup / Standar Kampus",
            4: "Sangat Bagus dan Informatif",
            5: "Luar Biasa / Sangat Direkomendasikan"
        };

        document.querySelectorAll('.stars-rating-container input').forEach(radio => {
            radio.addEventListener('change', (e) => {
                document.getElementById('ratingText').innerText = ratingLabels[e.target.value];
            });
        });

        function moveStep(direction) {
            if (direction === 1 && !validateCurrentStep()) return;

            currentStep += direction;

            if (currentStep > totalSteps) {
                document.getElementById('reviewForm').submit();
                return;
            }

            updateStepperUI();
        }

        function validateCurrentStep() {
            if (currentStep === 1) {
                const dosenSelect = document.getElementById('dosenSelect');
                const matkulSelect = document.getElementById('matkulSelect');
                if(!dosenSelect.value || !matkulSelect.value) {
                    alert('Silakan tentukan Dosen DAN Mata Kuliah terlebih dahulu!');
                    return false;
                }
            }
            if (currentStep === 2) {
                const checkedRating = document.querySelector('input[name="rating"]:checked');
                if(!checkedRating) {
                    alert('Mohon pilih skor rating bintang terlebih dahulu!');
                    return false;
                }
            }
            if (currentStep === 3) {
                const ulasan = document.getElementById('komentarText').value.trim();
                if(ulasan.length < 10) {
                    alert('Ulasan terlalu pendek! Tulis minimal 10 karakter.');
                    return false;
                }
            }
            return true;
        }

        function updateStepperUI() {
            document.querySelectorAll('.form-step-panel').forEach(panel => panel.classList.remove('active'));
            document.querySelector(`[data-panel="${currentStep}"]`).classList.add('active');

            document.querySelectorAll('.step-node').forEach(node => {
                const stepNum = parseInt(node.getAttribute('data-step'));
                node.classList.remove('active', 'completed');
                if(stepNum === currentStep) {
                    node.classList.add('active');
                } else if (stepNum < currentStep) {
                    node.classList.add('completed');
                }
            });

            const fillPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
            document.getElementById('progressBarFill').style.width = `${fillPercentage}%`;

            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            prevBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
            
            if(currentStep === totalSteps) {
                compileSummaryData();
                nextBtn.innerHTML = `Kirim Ulasan Anonim <i data-lucide="send" style="width:16px; height:16px;"></i>`;
                nextBtn.style.background = 'linear-gradient(135deg, #a855f7, #fcd34d)';
            } else {
                nextBtn.innerHTML = `Lanjutkan <i data-lucide="arrow-right" style="width:16px; height:16px;"></i>`;
                nextBtn.style.background = '';
            }

            lucide.createIcons();
        }

        function compileSummaryData() {
            const dosenSelect = document.getElementById('dosenSelect');
            const matkulSelect = document.getElementById('matkulSelect');
            
            const dosenText = dosenSelect.options[dosenSelect.selectedIndex].text;
            const matkulText = matkulSelect.options[matkulSelect.selectedIndex].text;
            
            const score = document.querySelector('input[name="rating"]:checked').value;
            const comment = document.getElementById('komentarText').value;

            document.getElementById('summaryTarget').innerHTML = `
                <div style="font-weight: 600; color: #fff;">${dosenText}</div>
                <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.25rem;">Mata Kuliah: ${matkulText}</div>
            `;
            document.getElementById('summaryRating').innerText = `${score} / 5 Bintang`;
            document.getElementById('summaryComment').innerText = comment;
        }

        lucide.createIcons();
    </script>

</body>
</html>