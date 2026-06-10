<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - EDOM UPS Tegal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        /* ─── CSS VARIABLES ─── */
        :root {
            --bg:            #0d1117;
            --bg-card:       #161b22;
            --bg-elevated:   #1c2333;
            --sidebar-w:     240px;
            --topbar-h:      56px;
            --canary:        #fcd34d;
            --canary-dim:    rgba(252, 211, 77, 0.12);
            --canary-border: rgba(252, 211, 77, 0.28);
            --purple:        #a855f7;
            --purple-dim:    rgba(168, 85, 247, 0.12);
            --emerald:       #34d399;
            --emerald-dim:   rgba(52, 211, 153, 0.12);
            --blue:          #60a5fa;
            --blue-dim:      rgba(96, 165, 250, 0.12);
            --red-dim:       rgba(239, 68, 68, 0.12);
            --border:        rgba(255, 255, 255, 0.07);
            --border-hover:  rgba(255, 255, 255, 0.13);
            --text:          #f0f6fc;
            --text-muted:    #7d8590;
            --text-sub:      #8b949e;
            --radius-sm:     8px;
            --radius-md:     12px;
            --radius-lg:     16px;
            --radius-xl:     20px;
        }

        /* ─── RESET ─── */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        a    { text-decoration: none; color: inherit; }

        /* ─── BODY: sidebar layout ─── */
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            font-size: 14px;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ════════════════════════════════
           SIDEBAR
        ════════════════════════════════ */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.25rem 0.75rem;
            z-index: 200;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.1rem;
            color: var(--text);
            padding: 0 0.5rem;
            margin-bottom: 1.5rem;
            display: block;
        }
        .sidebar-logo span { color: var(--canary); }

        /* User pill */
        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 0.6rem 0.75rem;
            margin-bottom: 1.5rem;
        }

        .sidebar-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 0.75rem;
            color: #fff; flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 0.8rem; font-weight: 600;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role {
            font-size: 0.68rem; color: var(--canary);
            text-transform: capitalize;
        }

        /* Section label */
        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 0 0.5rem;
            margin: 0.75rem 0 0.4rem;
            display: block;
        }

        /* Nav item */
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.55rem 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 500;
            color: var(--text-sub);
            transition: background 0.18s, color 0.18s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-item:hover {
            background: var(--bg-elevated);
            color: var(--text);
        }

        .sidebar-item.active {
            background: var(--canary-dim);
            color: var(--canary);
            border: 1px solid var(--canary-border);
        }

        .sidebar-item.danger { color: #ef4444; }
        .sidebar-item.danger:hover { background: var(--red-dim); }

        .sidebar-icon { width: 16px; height: 16px; flex-shrink: 0; }

        .sidebar-bottom { margin-top: auto; padding-top: 1rem; }

        /* ════════════════════════════════
           MAIN AREA
        ════════════════════════════════ */
        .dashboard-main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            position: sticky; top: 0; z-index: 100;
            height: var(--topbar-h);
            background: rgba(13, 17, 23, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem;
            gap: 1rem;
        }

        .topbar-search {
            position: relative;
            flex: 1; max-width: 340px;
        }
        .topbar-search input {
            width: 100%;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            padding: 0.4rem 0.9rem 0.4rem 2.2rem;
            color: var(--text);
            font-size: 0.8rem;
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: border-color 0.2s;
        }
        .topbar-search input::placeholder { color: var(--text-muted); }
        .topbar-search input:focus { border-color: var(--canary-border); }
        .topbar-search .s-icon {
            position: absolute; left: 0.65rem; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted); pointer-events: none; display: flex;
        }

        .topbar-right {
            display: flex; align-items: center; gap: 0.75rem; flex-shrink: 0;
        }

        .topbar-notif {
            position: relative;
            width: 36px; height: 36px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            color: var(--text-sub);
            transition: border-color 0.2s, color 0.2s;
        }
        .topbar-notif:hover { border-color: var(--border-hover); color: var(--text); }

        /* ─── PAGE BODY ─── */
        .page-body {
            flex: 1;
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* ─── HERO SECTION ─── */
        .hero {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 2rem 2.25rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; top: -80px; right: -80px;
            width: 300px; height: 300px;
            background: var(--canary);
            filter: blur(120px); opacity: 0.06;
            pointer-events: none;
        }

        .hero-eyebrow {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: var(--canary-dim);
            border: 1px solid var(--canary-border);
            border-radius: 50px;
            padding: 0.2rem 0.7rem;
            font-size: 0.68rem; font-weight: 700;
            color: var(--canary);
            letter-spacing: 0.05em; text-transform: uppercase;
            margin-bottom: 0.85rem;
        }

        .hero-heading {
            font-family: 'Syne', sans-serif;
            font-size: clamp(1.5rem, 2.5vw, 2rem);
            font-weight: 800; line-height: 1.2;
            margin-bottom: 0.6rem;
        }
        .hero-heading .hl { color: var(--canary); }

        .hero-sub {
            color: var(--text-sub);
            font-size: 0.83rem; max-width: 400px;
            line-height: 1.65; margin-bottom: 1.5rem;
        }

        .hero-actions { display: flex; gap: 0.65rem; flex-wrap: wrap; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: var(--canary); color: #0d1117;
            font-weight: 700; font-size: 0.8rem;
            padding: 0.55rem 1.1rem;
            border-radius: var(--radius-md);
            border: none; cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: opacity 0.18s, transform 0.15s;
        }
        .btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }

        .btn-outline {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: transparent; color: var(--text);
            font-weight: 600; font-size: 0.8rem;
            padding: 0.55rem 1.1rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-hover);
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: background 0.18s, border-color 0.18s, color 0.18s, transform 0.15s;
        }
        .btn-outline:hover {
            background: var(--canary-dim);
            border-color: var(--canary-border);
            color: var(--canary);
            transform: translateY(-1px);
        }

        /* ─── STATS GRID ─── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1.1rem;
            display: flex; flex-direction: column; gap: 0.75rem;
            transition: border-color 0.2s, transform 0.2s;
        }
        .stat-card:hover { border-color: var(--border-hover); transform: translateY(-2px); }

        .stat-card-icon {
            width: 38px; height: 38px;
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
        }
        .ic-purple { background: var(--purple-dim); color: var(--purple); }
        .ic-canary  { background: var(--canary-dim);  color: var(--canary); }
        .ic-emerald { background: var(--emerald-dim); color: var(--emerald); }
        .ic-blue    { background: var(--blue-dim);    color: var(--blue); }

        .stat-card-label { font-size: 0.72rem; color: var(--text-muted); margin-bottom: 0.25rem; }
        .stat-card-value { font-family: 'Syne', sans-serif; font-size: 1.7rem; font-weight: 800; line-height: 1; }
        .stat-card-value.sm-val { font-size: 1rem; line-height: 1.4; }
        .val-canary  { color: var(--canary); }
        .val-emerald { color: var(--emerald); }
        .stat-card-sub { font-size: 0.72rem; color: var(--text-muted); margin-top: 0.15rem; }

        /* ─── CONTENT GRID (3 columns) ─── */
        .content-grid {
            display: grid;
            grid-template-columns: 3fr 4fr 3fr;
            gap: 1.25rem;
        }

        /* ─── PANEL BASE ─── */
        .panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 1.35rem;
        }

        .panel-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 1.1rem;
            padding-bottom: 0.85rem;
            border-bottom: 1px solid var(--border);
        }

        .panel-title {
            font-family: 'Syne', sans-serif;
            font-size: 0.9rem; font-weight: 700;
        }

        .panel-link {
            font-size: 0.72rem; color: var(--canary); font-weight: 500;
            opacity: 0.8; transition: opacity 0.18s;
        }
        .panel-link:hover { opacity: 1; }

        /* ─── AKTIVITAS (left col) ─── */
        .activity-list { display: flex; flex-direction: column; gap: 0.85rem; }

        .activity-item { display: flex; gap: 0.75rem; align-items: flex-start; }

        .activity-dot {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 0.1rem;
        }
        .dot-write  { background: var(--purple-dim); color: var(--purple); }
        .dot-upvote { background: var(--canary-dim);  color: var(--canary); }

        .activity-body { flex: 1; min-width: 0; }
        .activity-action { font-size: 0.73rem; color: var(--text-muted); margin-bottom: 0.15rem; }
        .activity-name  { font-size: 0.84rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .activity-time  { font-size: 0.7rem; color: var(--text-muted); margin-top: 0.12rem; }

        /* Motivasi card */
        .motivation-card {
            margin-top: 1.1rem;
            background: linear-gradient(135deg, rgba(252,211,77,0.09), rgba(252,211,77,0.03));
            border: 1px solid var(--canary-border);
            border-radius: var(--radius-lg);
            padding: 1.1rem;
        }
        .motivation-quote {
            font-family: 'Syne', sans-serif;
            font-size: 0.95rem; font-weight: 800; line-height: 1.35; margin-bottom: 0.45rem;
        }
        .motivation-quote span { color: var(--canary); }
        .motivation-sub { font-size: 0.76rem; color: var(--text-muted); line-height: 1.5; }

        /* ─── REVIEW LIST (center col) ─── */
        .review-list { display: flex; flex-direction: column; gap: 0.8rem; }

        .review-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 1rem;
            transition: border-color 0.2s;
        }
        .review-card:hover { border-color: var(--border-hover); }

        .review-card-top {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 0.45rem; gap: 0.5rem;
        }
        .review-meta { flex: 1; min-width: 0; }
        .review-type-badge {
            font-size: 0.62rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.06em;
            color: var(--text-muted); margin-bottom: 0.18rem;
        }
        .review-target {
            font-size: 0.87rem; font-weight: 700;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .review-stars { color: var(--canary); font-size: 0.75rem; letter-spacing: 1px; flex-shrink: 0; }

        .review-body {
            font-size: 0.8rem; color: var(--text-sub); line-height: 1.55;
            margin-bottom: 0.75rem;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

        .review-card-bottom {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 0.7rem; color: var(--text-muted);
            border-top: 1px solid var(--border); padding-top: 0.6rem;
        }

        .upvote-chip {
            display: inline-flex; align-items: center; gap: 0.25rem;
            color: var(--canary);
            background: var(--canary-dim);
            border: 1px solid var(--canary-border);
            padding: 0.18rem 0.5rem; border-radius: 50px;
            font-size: 0.68rem; font-weight: 600;
        }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 2.75rem 1rem;
            background: rgba(255,255,255,0.015);
            border: 1px dashed var(--border);
            border-radius: var(--radius-lg);
        }
        .empty-icon {
            width: 52px; height: 52px;
            background: var(--bg-elevated); border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.85rem; color: var(--text-muted);
        }
        .empty-title  { font-size: 0.9rem; font-weight: 700; margin-bottom: 0.35rem; }
        .empty-sub    { font-size: 0.77rem; color: var(--text-muted); line-height: 1.55; margin-bottom: 1.1rem; }

        /* ─── SIDEBAR PANEL (right col) ─── */
        .right-col { display: flex; flex-direction: column; gap: 1.1rem; }

        /* Profile */
        .profile-avatar-lg {
            width: 52px; height: 52px; border-radius: 50%;
            background: linear-gradient(135deg, var(--purple), var(--blue));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif; font-weight: 800; font-size: 1.1rem;
            color: #fff; flex-shrink: 0;
        }

        .profile-row {
            display: flex; align-items: center; gap: 0.9rem;
            margin-bottom: 1.1rem; padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }
        .profile-name { font-size: 0.9rem; font-weight: 700; line-height: 1.3; }
        .profile-badge {
            display: inline-block;
            font-size: 0.63rem; font-weight: 700;
            background: var(--canary-dim); border: 1px solid var(--canary-border);
            color: var(--canary);
            padding: 0.13rem 0.55rem; border-radius: 50px;
            text-transform: uppercase; letter-spacing: 0.05em; margin-top: 0.2rem;
        }

        .status-row {
            display: flex; justify-content: space-between; align-items: center;
            font-size: 0.78rem; color: var(--text-muted);
            margin-bottom: 0.5rem;
        }
        .status-badge {
            display: inline-flex; align-items: center; gap: 0.3rem;
            background: var(--emerald-dim);
            border: 1px solid rgba(52,211,153,0.25);
            color: var(--emerald);
            font-size: 0.68rem; font-weight: 600;
            padding: 0.18rem 0.55rem; border-radius: 50px;
        }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--emerald); }

        /* Tips */
        .tips-list { display: flex; flex-direction: column; gap: 0.65rem; }
        .tip-item  { display: flex; gap: 0.65rem; align-items: flex-start; }
        .tip-icon  {
            width: 26px; height: 26px; border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 0.05rem;
        }
        .tip-text  { font-size: 0.77rem; color: var(--text-sub); line-height: 1.5; }
        .tip-text strong { color: var(--text); font-weight: 600; display: block; margin-bottom: 0.08rem; }

        /* Kontribusi */
        .kontribusi-card {
            background: linear-gradient(135deg, rgba(252,211,77,0.09), rgba(252,211,77,0.02));
            border: 1px solid var(--canary-border);
            border-radius: var(--radius-lg);
            padding: 1.1rem;
            display: flex; gap: 0.85rem; align-items: flex-start;
        }
        .kontribusi-icon {
            width: 38px; height: 38px; border-radius: var(--radius-sm);
            background: var(--canary-dim); color: var(--canary);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .kontribusi-title { font-size: 0.82rem; font-weight: 700; color: var(--canary); margin-bottom: 0.25rem; }
        .kontribusi-sub   { font-size: 0.73rem; color: var(--text-muted); line-height: 1.5; }

        /* ─── FOOTER ─── */
        .footer {
            border-top: 1px solid var(--border);
            padding: 1rem 1.75rem;
            display: flex; justify-content: space-between; align-items: center;
            background: rgba(13,17,23,0.6);
            font-size: 0.75rem; color: var(--text-muted);
        }
        .footer-logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 0.9rem; }
        .footer-logo span { color: var(--canary); }

        /* ════════════════════════════════
           RESPONSIVE
        ════════════════════════════════ */

        /* ─ Tablet ─ */
        @media (max-width: 1024px) {
            :root { --sidebar-w: 200px; }
            .stat-grid     { grid-template-columns: repeat(2, 1fr); }
            .content-grid  { grid-template-columns: 1fr 1fr; }
            .col-center    { grid-column: 1 / -1; }
        }

        /* ─ Mobile: sidebar collapses ─ */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.28s ease;
            }
            .sidebar.open { transform: translateX(0); }

            .dashboard-main { margin-left: 0; }

            .hamburger {
                display: flex; align-items: center; justify-content: center;
                width: 36px; height: 36px;
                background: var(--bg-card);
                border: 1px solid var(--border);
                border-radius: var(--radius-sm);
                color: var(--text); cursor: pointer;
            }

            .sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.55);
                z-index: 199;
            }
            .sidebar-overlay.open { display: block; }

            .stat-grid    { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
            .content-grid { grid-template-columns: 1fr; }

            .hero {
                flex-direction: column;
                align-items: flex-start;
                padding: 1.5rem;
            }

            .topbar-search { display: none; }
            .page-body { padding: 1rem; }
            .footer { flex-direction: column; gap: 0.4rem; text-align: center; }
        }

        /* ─ No hamburger on desktop ─ */
        @media (min-width: 769px) {
            .hamburger      { display: none; }
            .sidebar-overlay{ display: none !important; }
        }
    </style>
</head>
<body>

    {{-- ════════════════════════════════
         SIDEBAR OVERLAY (mobile)
    ════════════════════════════════ --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ════════════════════════════════
         SIDEBAR
    ════════════════════════════════ --}}
    <aside class="sidebar" id="sidebar">

        {{-- Logo --}}
        <a href="/" class="sidebar-logo">EDOM<span> UPS </span>Tegal</a>

        {{-- User pill --}}
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <div class="sidebar-user-name">{{ Str::words(Auth::user()->name, 2, '') }}</div>
                <div class="sidebar-user-role">Mahasiswa</div>
            </div>
        </div>

        {{-- Nav --}}
        <span class="sidebar-section-label">Menu</span>

        <a href="{{ route('dashboard.mahasiswa') }}" class="sidebar-item active">
            <i data-lucide="layout-dashboard" class="sidebar-icon"></i> Dashboard
        </a>
        <a href="#ulasan" class="sidebar-item">
            <i data-lucide="message-square" class="sidebar-icon"></i> Ulasan Saya
        </a>
        <a href="{{ route('review.create') }}" class="sidebar-item">
            <i data-lucide="pencil-line" class="sidebar-icon"></i> Tulis Ulasan
        </a>

        <span class="sidebar-section-label">Akun</span>

        <!-- Pengaturan -icon + routes -->
        <a href="{{ route('dashboard.mahasiswa') }}" class="sidebar-item">
            <i data-lucide="settings" class="sidebar-icon"></i> Pengaturan
        </a> 
        <!--  -->

        <div class="sidebar-bottom">
            {{-- Logout — tidak diubah sama sekali --}}
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="sidebar-item danger">
                    <i data-lucide="log-out" class="sidebar-icon"></i> Keluar
                </button>
            </form>
        </div>

    </aside>

    {{-- ════════════════════════════════
         MAIN
    ════════════════════════════════ --}}
    <main class="dashboard-main">

        {{-- TOPBAR --}}
        <div class="topbar">
            {{-- Hamburger (mobile) --}}
            <button class="hamburger" id="hamburger" aria-label="Buka menu">
                <i data-lucide="menu" style="width:18px;height:18px;"></i>
            </button>
        </div>

        {{-- PAGE BODY --}}
        <div class="page-body">

            {{-- ─── HERO ─── --}}
            <div class="hero">
                <div>
                    <div class="hero-eyebrow">
                        <i data-lucide="shield-check" style="width:10px;height:10px;"></i>
                        Akun Mahasiswa Aktif
                    </div>
                    <h1 class="hero-heading">
                        Halo, <span class="hl">{{ Auth::user()->name }}</span> 
                    </h1>
                    <p class="hero-sub">
                        Terima kasih telah menjadi bagian dari komunitas akademik yang membantu meningkatkan kualitas pembelajaran di kampus.
                    </p>
                    <div class="hero-actions">
                        <a href="/#search" class="btn-primary">
                            <i data-lucide="search" style="width:13px;height:13px;"></i>
                            Cari Dosen / Matkul
                        </a>
                        <a href="{{ route('review.create') }}" class="btn-outline">
                            <i data-lucide="pencil-line" style="width:13px;height:13px;"></i>
                            Tulis Ulasan Baru
                        </a>
                    </div>
                </div>
            </div>

            {{-- ─── STATS ─── --}}
            <div class="stat-grid">

                {{-- Total Ulasan --}}
                <div class="stat-card">
                    <div class="stat-card-icon ic-purple">
                        <i data-lucide="message-square" style="width:17px;height:17px;"></i>
                    </div>
                    <div>
                        <div class="stat-card-label">Review Ditulis</div>
                        <div class="stat-card-value">{{ $myReviewsCount ?? 0 }}</div>
                        <div class="stat-card-sub">Total ulasan kamu</div>
                    </div>
                </div>

                {{-- Upvote --}}
                <div class="stat-card">
                    <div class="stat-card-icon ic-canary">
                        <i data-lucide="thumbs-up" style="width:17px;height:17px;"></i>
                    </div>
                    <div>
                        <div class="stat-card-label">Upvote Diterima</div>
                        <div class="stat-card-value val-canary">{{ $totalUpvotesReceived ?? 0 }}</div>
                        <div class="stat-card-sub">Dari ulasan kamu</div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="stat-card">
                    <div class="stat-card-icon ic-emerald">
                        <i data-lucide="shield" style="width:17px;height:17px;"></i>
                    </div>
                    <div>
                        <div class="stat-card-label">Status Anonimitas</div>
                        <div class="stat-card-value sm-val val-emerald">Terverifikasi</div>
                        <div class="stat-card-sub">Identitas aman</div>
                    </div>
                </div>

                {{-- Level --}}
                <div class="stat-card">
                    <div class="stat-card-icon ic-blue">
                        <i data-lucide="trophy" style="width:17px;height:17px;"></i>
                    </div>
                    <div>
                        <div class="stat-card-label">Level Kontribusi</div>
                        <div class="stat-card-value sm-val val-canary">
                            @if(($myReviewsCount ?? 0) >= 10)
                                Top Reviewer
                            @elseif(($myReviewsCount ?? 0) >= 5)
                                Kontributor
                            @else
                                Pemula
                            @endif
                        </div>
                        <div class="stat-card-sub">Terus berkontribusi!</div>
                    </div>
                </div>

            </div>

            {{-- ─── CONTENT GRID ─── --}}
            <div class="content-grid">

                {{-- ── KOLOM KIRI: Aktivitas + Motivasi ── --}}
                <div style="display:flex;flex-direction:column;gap:1.1rem;">

                    <div class="panel">
                        <div class="panel-header">
                            <span class="panel-title">Aktivitas Terakhir</span>
                        </div>

                        <div class="activity-list">
                            @if(isset($myReviews) && $myReviews->count() > 0)
                                @foreach($myReviews->take(3) as $rev)
                                    <div class="activity-item">
                                        <div class="activity-dot dot-write">
                                            <i data-lucide="pencil" style="width:13px;height:13px;"></i>
                                        </div>
                                        <div class="activity-body">
                                            <div class="activity-action">Kamu menulis review untuk</div>
                                            <div class="activity-name">
                                                {{ $rev->target_type === 'dosen'
                                                    ? ($rev->dosen->nama ?? 'Dosen Terhapus')
                                                    : ($rev->matkul->nama ?? 'Matkul Terhapus') }}
                                            </div>
                                            <div class="activity-time">{{ $rev->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div style="text-align:center;padding:1.5rem 0;color:var(--text-muted);font-size:0.8rem;">
                                    <i data-lucide="inbox" style="width:28px;height:28px;opacity:0.25;margin-bottom:0.4rem;"></i><br>
                                    Belum ada aktivitas.
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Motivasi --}}
                    <div class="motivation-card">
                        <div style="font-size:1.2rem;margin-bottom:0.4rem;">💬</div>
                        <div class="motivation-quote">
                            Suara Mahasiswa,<br><span>Nyata Adanya.</span>
                        </div>
                        <p class="motivation-sub">
                            Setiap ulasan yang kamu tulis membantu ribuan mahasiswa membuat keputusan lebih baik.
                        </p>
                    </div>

                </div>

                {{-- ── KOLOM TENGAH: Riwayat Ulasan ── --}}
                <div class="col-center" id="ulasan">
                    <div class="panel" style="height:100%;">
                        <div class="panel-header">
                            <span class="panel-title">Riwayat Ulasan Saya</span>
                            <span style="font-size:0.7rem;color:var(--text-muted);">Hanya terlihat olehmu</span>
                        </div>

                        <div class="review-list">
                            @if(isset($myReviews) && $myReviews->count() > 0)
                                @foreach($myReviews as $review)
                                    <div class="review-card">
                                        <div class="review-card-top">
                                            <div class="review-meta">
                                                <div class="review-type-badge">{{ $review->target_type }}</div>
                                                <div class="review-target">
                                                    {{ $review->target_type === 'dosen'
                                                        ? ($review->dosen->nama ?? 'Dosen Terhapus')
                                                        : ($review->matkul->nama ?? 'Matkul Terhapus') }}
                                                </div>
                                            </div>
                                            <div class="review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                                @endfor
                                            </div>
                                        </div>

                                        <p class="review-body">{{ $review->komentar }}</p>

                                        <div class="review-card-bottom">
                                            <span>{{ $review->created_at->format('d M Y') }}</span>
                                            <div class="upvote-chip">
                                                <i data-lucide="thumbs-up" style="width:9px;height:9px;"></i>
                                                {{ $review->upvote_count ?? 0 }} Upvote
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i data-lucide="folder-open" style="width:22px;height:22px;"></i>
                                    </div>
                                    <div class="empty-title">Belum ada ulasan</div>
                                    <p class="empty-sub">
                                        Kamu belum pernah memberikan ulasan. Mulai berkontribusi dan bantu sesama mahasiswa!
                                    </p>
                                    <a href="{{ route('review.create') }}" class="btn-primary" style="font-size:0.78rem;">
                                        <i data-lucide="plus-circle" style="width:12px;height:12px;"></i>
                                        Tulis Ulasan Pertama
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ── KOLOM KANAN: Profil + Tips ── --}}
                <div class="right-col">

                    {{-- Profile panel --}}
                    <div class="panel">
                        <div class="panel-header">
                            <span class="panel-title">Profil Saya</span>
                        </div>

                        <div class="profile-row">
                            <div class="profile-avatar-lg">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="profile-name">{{ Auth::user()->name }}</div>
                                <span class="profile-badge">Mahasiswa</span>
                            </div>
                        </div>

                        <div class="status-row">
                            <span>Status Akun</span>
                            <span class="status-badge">
                                <span class="status-dot"></span> Aktif
                            </span>
                        </div>
                        <div class="status-row">
                            <span>Total Ulasan</span>
                            <span style="font-weight:600;color:var(--text);">{{ $myReviewsCount ?? 0 }}</span>
                        </div>
                        <div class="status-row">
                            <span>Upvote Diterima</span>
                            <span style="font-weight:600;color:var(--canary);">{{ $totalUpvotesReceived ?? 0 }}</span>
                        </div>
                    </div>

                    {{-- Tips panel --}}
                    <div class="panel">
                        <div class="panel-header">
                            <span class="panel-title">Tips Menggunakan EDOM</span>
                        </div>
                        <div class="tips-list">
                            <div class="tip-item">
                                <div class="tip-icon ic-emerald">
                                    <i data-lucide="check-circle" style="width:13px;height:13px;"></i>
                                </div>
                                <div class="tip-text">
                                    <strong>Ulasan Objektif</strong>
                                    Fokus pada metode pengajaran, bukan hal pribadi.
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon ic-blue">
                                    <i data-lucide="heart-handshake" style="width:13px;height:13px;"></i>
                                </div>
                                <div class="tip-text">
                                    <strong>Bahasa Sopan</strong>
                                    Hindari ujaran kasar, SARA, atau ancaman.
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon ic-purple">
                                    <i data-lucide="shield-off" style="width:13px;height:13px;"></i>
                                </div>
                                <div class="tip-text">
                                    <strong>Hindari Spam</strong>
                                    Satu ulasan per dosen/matkul sudah cukup.
                                </div>
                            </div>
                            <div class="tip-item">
                                <div class="tip-icon ic-canary">
                                    <i data-lucide="thumbs-up" style="width:13px;height:13px;"></i>
                                </div>
                                <div class="tip-text">
                                    <strong>Upvote Ulasan Baik</strong>
                                    Bantu ulasan bermanfaat muncul paling atas.
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kontribusi card --}}
                    <div class="kontribusi-card">
                        <div class="kontribusi-icon">
                            <i data-lucide="trophy" style="width:17px;height:17px;"></i>
                        </div>
                        <div>
                            <div class="kontribusi-title">Terus tingkatkan kontribusimu!</div>
                            <p class="kontribusi-sub">Semakin banyak ulasan berkualitas yang kamu tulis, semakin besar dampak yang kamu berikan.</p>
                        </div>
                    </div>

                </div>
                {{-- end right col --}}

            </div>
            {{-- end content-grid --}}

        </div>
        {{-- end page-body --}}

        {{-- FOOTER --}}
        <footer class="footer">
            <div class="footer-logo">EDOM<span> UPS </span>Tegal</div>
            <p>© {{ date('Y') }} EDOM-UPSTEGAL · Mahasiswa Dashboard</p>
        </footer>

    </main>

    <script>
        // ─── Init Lucide icons ───
        lucide.createIcons();

        // ─── Mobile sidebar toggle ───
        const hamburger      = document.getElementById('hamburger');
        const sidebar        = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.add('open');
            sidebarOverlay.classList.add('open');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            sidebarOverlay.classList.remove('open');
        }

        if (hamburger)      hamburger.addEventListener('click', openSidebar);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);
    </script>

</body>
</html>