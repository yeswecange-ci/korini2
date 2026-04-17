<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KORINI — Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --blue: #27306c;
            --orange: #f29220;
        }
        * { box-sizing: border-box; }
        body {
            background: #f0f2f8;
            font-family: 'Segoe UI', sans-serif;
            color: #1a1a2e;
            min-height: 100vh;
        }

        /* ── Navbar ── */
        .topbar {
            background: var(--blue);
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(39,48,108,0.25);
        }
        .topbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            text-decoration: none;
        }
        .topbar-brand img { height: 36px; width: 36px; object-fit: contain; }
        .topbar-brand span {
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
            color: rgba(255,255,255,0.7);
            font-size: 0.82rem;
        }
        .btn-logout {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.2); color: #fff; }

        /* ── Layout ── */
        .page { padding: 28px 32px; }

        /* ── Stat cards ── */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px 24px;
            box-shadow: 0 2px 12px rgba(39,48,108,0.07);
            border-left: 4px solid var(--blue);
            height: 100%;
        }
        .stat-card.orange { border-left-color: var(--orange); }
        .stat-card.green  { border-left-color: #22c55e; }
        .stat-card.red    { border-left-color: #ef4444; }
        .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 6px;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: 800;
            color: var(--blue);
            line-height: 1;
        }
        .stat-card.orange .stat-value { color: var(--orange); }
        .stat-card.green  .stat-value { color: #16a34a; }
        .stat-card.red    .stat-value { color: #dc2626; }
        .stat-sub {
            font-size: 0.72rem;
            color: #9ca3af;
            margin-top: 4px;
        }

        /* ── Filter card ── */
        .filter-card {
            background: #fff;
            border-radius: 14px;
            padding: 20px 24px;
            box-shadow: 0 2px 12px rgba(39,48,108,0.07);
            margin-bottom: 20px;
        }
        .filter-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #6b7280;
            margin-bottom: 14px;
        }
        .form-control, .form-select {
            font-size: 0.85rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            color: #111827;
            padding: 8px 12px;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 3px rgba(242,146,32,0.15);
            background: #fff;
        }
        .btn-filter {
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: opacity 0.2s;
        }
        .btn-filter:hover { opacity: 0.85; }
        .btn-reset {
            background: transparent;
            color: #6b7280;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.82rem;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-reset:hover { background: #f3f4f6; color: #374151; }
        .btn-export {
            background: var(--orange);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-export:hover { opacity: 0.88; color: #fff; }

        /* ── Table ── */
        .table-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(39,48,108,0.07);
            overflow: hidden;
        }
        .table-header {
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #f3f4f6;
        }
        .table-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--blue);
        }
        .table-count {
            font-size: 0.78rem;
            color: #9ca3af;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: #f9fafb;
            padding: 11px 16px;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #6b7280;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }
        tbody td {
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: #fafbff; }
        .email-cell { font-weight: 500; color: #111827; }
        .badge-actif {
            background: #dcfce7;
            color: #15803d;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .badge-desabonne {
            background: #fee2e2;
            color: #dc2626;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .source-badge {
            background: #eff6ff;
            color: #3b82f6;
            border-radius: 20px;
            padding: 3px 10px;
            font-size: 0.72rem;
            font-weight: 600;
        }
        .ip-cell { color: #9ca3af; font-size: 0.78rem; font-family: monospace; }
        .date-cell { color: #6b7280; font-size: 0.8rem; white-space: nowrap; }
        .action-select {
            font-size: 0.78rem;
            padding: 4px 8px;
            border-radius: 6px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #9ca3af;
        }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 12px; }

        /* ── Pagination ── */
        .pagination-wrap { padding: 16px 24px; border-top: 1px solid #f3f4f6; }
        .pagination .page-link {
            border-radius: 8px;
            font-size: 0.82rem;
            color: var(--blue);
            border-color: #e5e7eb;
        }
        .pagination .page-item.active .page-link {
            background: var(--blue);
            border-color: var(--blue);
        }

        /* ── Success toast ── */
        .toast-success {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #22c55e;
            color: #fff;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 8px 24px rgba(34,197,94,0.35);
            z-index: 9999;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(60px); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        @media (max-width: 768px) {
            .page { padding: 16px; }
            .topbar { padding: 0 16px; }
            .stat-value { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- Topbar -->
    <nav class="topbar">
        <a href="{{ route('admin.dashboard') }}" class="topbar-brand">
            <img src="{{ asset('img/LOGO-PDG.png') }}" alt="Korini">
            <span>Korini — Admin</span>
        </a>
        <div class="topbar-right">
            <span><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn-logout"><i class="bi bi-box-arrow-right me-1"></i>Déconnexion</button>
            </form>
        </div>
    </nav>

    @if(session('success'))
        <div class="toast-success" id="toast">{{ session('success') }}</div>
        <script>setTimeout(() => document.getElementById('toast')?.remove(), 3000)</script>
    @endif

    <div class="page">

        <!-- Stats -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-label">Total leads</div>
                    <div class="stat-value">{{ $stats['total'] }}</div>
                    <div class="stat-sub">depuis le début</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card orange">
                    <div class="stat-label">Aujourd'hui</div>
                    <div class="stat-value">{{ $stats['today'] }}</div>
                    <div class="stat-sub">{{ now()->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card">
                    <div class="stat-label">Cette semaine</div>
                    <div class="stat-value">{{ $stats['this_week'] }}</div>
                    <div class="stat-sub">{{ now()->startOfWeek()->format('d/m') }} – {{ now()->endOfWeek()->format('d/m') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card orange">
                    <div class="stat-label">Ce mois</div>
                    <div class="stat-value">{{ $stats['this_month'] }}</div>
                    <div class="stat-sub">{{ now()->translatedFormat('F Y') }}</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card green">
                    <div class="stat-label">Actifs</div>
                    <div class="stat-value">{{ $stats['actif'] }}</div>
                    <div class="stat-sub">inscrits actifs</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="stat-card red">
                    <div class="stat-label">Désabonnés</div>
                    <div class="stat-value">{{ $stats['desabonne'] }}</div>
                    <div class="stat-sub">ont quitté</div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-card">
            <div class="filter-title"><i class="bi bi-funnel me-1"></i>Filtres</div>
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <div class="row g-2 align-items-end">
                    <div class="col-12 col-md-3">
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Rechercher un email..."
                            value="{{ request('search') }}"
                        >
                    </div>
                    <div class="col-6 col-md-2">
                        <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}" title="Date de début">
                    </div>
                    <div class="col-6 col-md-2">
                        <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}" title="Date de fin">
                    </div>
                    <div class="col-6 col-md-2">
                        <select name="status" class="form-select">
                            <option value="">Tous les statuts</option>
                            <option value="actif"      @selected(request('status') === 'actif')>Actif</option>
                            <option value="desabonne"  @selected(request('status') === 'desabonne')>Désabonné</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-1">
                        <select name="source" class="form-select">
                            <option value="">Source</option>
                            @foreach($sources as $src)
                                <option value="{{ $src }}" @selected(request('source') === $src)>{{ $src }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-2 d-flex gap-2">
                        <button type="submit" class="btn-filter flex-grow-1"><i class="bi bi-search me-1"></i>Filtrer</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-reset"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-header">
                <div>
                    <div class="table-title">Liste des leads</div>
                    <div class="table-count">{{ $leads->total() }} résultat(s)</div>
                </div>
                <a
                    href="{{ route('admin.export', request()->query()) }}"
                    class="btn-export"
                >
                    <i class="bi bi-download"></i> Exporter CSV
                </a>
            </div>

            @if($leads->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    Aucun lead trouvé avec ces filtres.
                </div>
            @else
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Statut</th>
                                <th>IP</th>
                                <th>Inscrit le</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leads as $lead)
                                <tr>
                                    <td class="text-muted" style="font-size:0.78rem;">{{ $lead->id }}</td>
                                    <td class="email-cell">{{ $lead->email }}</td>
                                    <td><span class="source-badge">{{ $lead->source }}</span></td>
                                    <td>
                                        @if($lead->status === 'actif')
                                            <span class="badge-actif">Actif</span>
                                        @else
                                            <span class="badge-desabonne">Désabonné</span>
                                        @endif
                                    </td>
                                    <td class="ip-cell">{{ $lead->ip_address ?? '—' }}</td>
                                    <td class="date-cell">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.leads.status', $lead) }}">
                                            @csrf
                                            @method('PATCH')
                                            <select
                                                name="status"
                                                class="action-select"
                                                onchange="this.form.submit()"
                                            >
                                                <option value="actif"     @selected($lead->status === 'actif')>Actif</option>
                                                <option value="desabonne" @selected($lead->status === 'desabonne')>Désabonner</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($leads->hasPages())
                    <div class="pagination-wrap">
                        {{ $leads->links() }}
                    </div>
                @endif
            @endif
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
