@extends('layout')
@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')

@section('content')

{{-- ── STAT CARDS ── --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#6366f1,#4f46e5)">
            <div class="card-body p-4 text-white d-flex align-items-center gap-3">
                <div style="background:rgba(255,255,255,.15);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold lh-1">{{ number_format($totalHabitants) }}</div>
                    <div class="opacity-75 small mt-1">Total habitants</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#10b981,#059669)">
            <div class="card-body p-4 text-white d-flex align-items-center gap-3">
                <div style="background:rgba(255,255,255,.15);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold lh-1">{{ $totalVilles }}</div>
                    <div class="opacity-75 small mt-1">Villes enregistrées</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#f59e0b,#d97706)">
            <div class="card-body p-4 text-white d-flex align-items-center gap-3">
                <div style="background:rgba(255,255,255,.15);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
                    <i class="bi bi-person-plus-fill"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold lh-1">{{ $recentHabitants }}</div>
                    <div class="opacity-75 small mt-1">Ajoutés ce mois</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm h-100" style="background:linear-gradient(135deg,#ec4899,#db2777)">
            <div class="card-body p-4 text-white d-flex align-items-center gap-3">
                <div style="background:rgba(255,255,255,.15);border-radius:12px;width:52px;height:52px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
                    <i class="bi bi-camera-fill"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold lh-1">{{ $avecPhoto }}</div>
                    <div class="opacity-75 small mt-1">Avec photo</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── BOTTOM ROW ── --}}
<div class="row g-4">

    {{-- Top villes --}}
    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-fill me-2 text-indigo-500" style="color:#6366f1"></i>Répartition par ville</h6>
                <a href="{{ route('villes.index') }}" class="btn btn-sm btn-outline-secondary">Voir tout</a>
            </div>
            <div class="card-body">
                @forelse($topVilles as $ville)
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="fw-semibold small">{{ $ville->ville }}</span>
                        <span class="text-muted small">{{ $ville->habitants_count }} hab.</span>
                    </div>
                    @php
                        $max = $topVilles->first()->habitants_count;
                        $pct = $max > 0 ? round($ville->habitants_count / $max * 100) : 0;
                        $colors = ['#6366f1','#10b981','#f59e0b','#ec4899','#3b82f6'];
                        $color  = $colors[$loop->index % count($colors)];
                    @endphp
                    <div class="progress" style="height:7px;border-radius:99px;background:#f1f5f9">
                        <div class="progress-bar" style="width:{{ $pct }}%;background:{{ $color }};border-radius:99px"></div>
                    </div>
                </div>
                @empty
                    <p class="text-muted small">Aucune donnée.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Derniers habitants --}}
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2" style="color:#10b981"></i>Derniers habitants ajoutés</h6>
                <a href="{{ route('habitants.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1"></i>Ajouter
                </a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($derniers as $h)
                    <li class="list-group-item px-4 py-3 d-flex align-items-center gap-3">
                        @if($h->photo)
                            <img src="{{ asset('storage/'.$h->photo) }}" class="avatar">
                        @else
                            @php
                                $bg = ['#ede9fe','#d1fae5','#fef3c7','#fce7f3','#dbeafe'];
                                $fg = ['#6d28d9','#065f46','#92400e','#9d174d','#1e40af'];
                                $i  = $loop->index % 5;
                            @endphp
                            <div class="avatar-placeholder" style="background:{{ $bg[$i] }};color:{{ $fg[$i] }}">
                                {{ strtoupper(substr($h->nom,0,1)) }}
                            </div>
                        @endif
                        <div class="flex-grow-1 min-w-0">
                            <div class="fw-semibold small text-truncate">{{ $h->nom }} {{ $h->prenom }}</div>
                            <div class="text-muted" style="font-size:.75rem">
                                <i class="bi bi-geo-alt me-1"></i>{{ $h->ville->ville ?? '—' }}
                                &nbsp;·&nbsp; <code style="font-size:.7rem">{{ $h->cin }}</code>
                            </div>
                        </div>
                        <div class="text-muted" style="font-size:.72rem;white-space:nowrap">
                            {{ $h->created_at->diffForHumans() }}
                        </div>
                        <a href="{{ route('habitants.show', $h->id) }}" class="btn btn-icon btn-outline-secondary">
                            <i class="bi bi-eye" style="font-size:.8rem"></i>
                        </a>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted py-4">Aucun habitant.</li>
                    @endforelse
                </ul>
            </div>
            @if($totalHabitants > 6)
            <div class="card-footer bg-transparent text-center py-2">
                <a href="{{ route('habitants.index') }}" class="text-decoration-none small text-muted">
                    Voir tous les habitants <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
