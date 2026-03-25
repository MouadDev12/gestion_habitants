<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GestionHab') — Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-w: 250px;
            --sidebar-bg: #0f172a;
            --sidebar-hover: rgba(255,255,255,.07);
            --sidebar-active: rgba(99,102,241,.25);
            --accent: #6366f1;
        }
        * { box-sizing: border-box; }
        body { background: #f1f5f9; font-family: 'Segoe UI', sans-serif; margin: 0; }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed; top: 0; left: 0;
            width: var(--sidebar-w); height: 100vh;
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            z-index: 200; overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.4rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            display: flex; align-items: center; gap: .7rem;
        }
        .sidebar-brand .logo {
            width: 36px; height: 36px; border-radius: 10px;
            background: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; color: #fff; flex-shrink: 0;
        }
        .sidebar-brand span { color: #fff; font-weight: 700; font-size: 1rem; }
        .sidebar-brand small { color: rgba(255,255,255,.4); font-size: .7rem; display: block; }

        .nav-section {
            color: rgba(255,255,255,.3);
            font-size: .65rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .1em;
            padding: 1.2rem 1.5rem .4rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.6);
            padding: .6rem 1.5rem;
            display: flex; align-items: center; gap: .75rem;
            border-radius: 0; font-size: .875rem;
            transition: all .15s; border-left: 3px solid transparent;
        }
        .sidebar .nav-link i { font-size: 1rem; width: 18px; text-align: center; }
        .sidebar .nav-link:hover { color: #fff; background: var(--sidebar-hover); }
        .sidebar .nav-link.active {
            color: #fff; background: var(--sidebar-active);
            border-left-color: var(--accent);
        }
        .sidebar-footer {
            margin-top: auto;
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.07);
            color: rgba(255,255,255,.3); font-size: .75rem;
        }

        /* ── MAIN ── */
        .main-wrap { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: .85rem 1.75rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .topbar-title { font-weight: 600; color: #1e293b; font-size: .95rem; }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-date { color: #94a3b8; font-size: .8rem; }

        .page-body { padding: 1.75rem; flex: 1; }

        /* ── CARDS ── */
        .card { border: none; border-radius: 14px; }
        .card-header { background: transparent; border-bottom: 1px solid #f1f5f9; padding: 1.1rem 1.4rem .8rem; }

        /* ── STAT CARDS ── */
        .stat-card { border-radius: 14px; overflow: hidden; transition: transform .2s, box-shadow .2s; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,.12) !important; }

        /* ── TABLE ── */
        .table thead th { font-size: .75rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; color: #64748b; border-bottom: 1px solid #e2e8f0; }
        .table tbody tr { transition: background .1s; }
        .table-hover tbody tr:hover { background: #f8fafc; }
        .table td { vertical-align: middle; border-color: #f1f5f9; }

        /* ── AVATAR ── */
        .avatar {
            width: 40px; height: 40px; border-radius: 50%;
            object-fit: cover; flex-shrink: 0;
        }
        .avatar-placeholder {
            width: 40px; height: 40px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .85rem; flex-shrink: 0;
        }

        /* ── BADGES ── */
        .badge-ville { background: #ede9fe; color: #6d28d9; font-weight: 600; font-size: .75rem; padding: .3em .7em; border-radius: 20px; }

        /* ── BUTTONS ── */
        .btn { border-radius: 8px; font-size: .85rem; }
        .btn-icon { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; }

        /* ── FORM ── */
        .form-control, .form-select { border-radius: 8px; border-color: #e2e8f0; font-size: .875rem; }
        .form-control:focus, .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(99,102,241,.15); }
        .form-label { font-size: .8rem; font-weight: 600; color: #475569; text-transform: uppercase; letter-spacing: .04em; margin-bottom: .4rem; }

        /* ── ALERTS ── */
        .alert { border: none; border-radius: 10px; font-size: .875rem; }

        /* ── PAGINATION ── */
        .pagination .page-link { border-radius: 8px !important; margin: 0 2px; border: 1px solid #e2e8f0; color: #475569; font-size: .85rem; }
        .pagination .page-item.active .page-link { background: var(--accent); border-color: var(--accent); }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrap { margin-left: 0; }
        }
    </style>
</head>
<body>

{{-- ══ SIDEBAR ══ --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="logo"><i class="bi bi-buildings"></i></div>
        <div>
            <span>GestionHab</span>
            <small>Administration</small>
        </div>
    </div>

    <nav class="mt-1">
        <div class="nav-section">Principal</div>
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Tableau de bord
        </a>

        <div class="nav-section">Gestion</div>
        <a href="{{ route('habitants.index') }}"
           class="nav-link {{ request()->routeIs('habitants.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Habitants
        </a>
        <a href="{{ route('villes.index') }}"
           class="nav-link {{ request()->routeIs('villes.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i> Villes
        </a>
    </nav>

    <div class="sidebar-footer">
        <i class="bi bi-circle-fill text-success me-1" style="font-size:.5rem"></i>
        Système opérationnel
    </div>
</aside>

{{-- ══ MAIN ══ --}}
<div class="main-wrap">
    <header class="topbar">
        <div class="topbar-title">
            <i class="bi bi-chevron-right text-muted me-1" style="font-size:.7rem"></i>
            @yield('page-title', 'Tableau de bord')
        </div>
        <div class="topbar-right">
            <span class="topbar-date">
                <i class="bi bi-calendar3 me-1"></i>{{ now()->translatedFormat('d F Y') }}
            </span>
        </div>
    </header>

    <main class="page-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
