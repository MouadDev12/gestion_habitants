@extends('layout')
@section('title', 'Villes')
@section('page-title', 'Villes')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-0">Liste des villes</h5>
        <p class="text-muted small mb-0">{{ $villes->total() }} ville(s) enregistrée(s)</p>
    </div>
    <a href="{{ route('villes.create') }}" class="btn btn-success">
        <i class="bi bi-plus-lg me-1"></i> Ajouter une ville
    </a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Ville</th>
                    <th>Population officielle</th>
                    <th>Habitants enregistrés</th>
                    <th>Taux couverture</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($villes as $ville)
                @php
                    $taux = $ville->nombreHabitant > 0
                        ? min(100, round($ville->habitants_count / $ville->nombreHabitant * 100, 1))
                        : 0;
                @endphp
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:36px;height:36px;border-radius:10px;background:#ede9fe;
                                        display:flex;align-items:center;justify-content:center;
                                        color:#6d28d9;font-weight:700;font-size:.85rem;flex-shrink:0">
                                {{ strtoupper(substr($ville->ville,0,2)) }}
                            </div>
                            <span class="fw-semibold">{{ $ville->ville }}</span>
                        </div>
                    </td>
                    <td class="text-muted small">{{ number_format($ville->nombreHabitant, 0, ',', ' ') }}</td>
                    <td>
                        <span class="badge-ville">{{ $ville->habitants_count }}</span>
                    </td>
                    <td style="min-width:140px">
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1" style="height:6px;border-radius:99px;background:#f1f5f9">
                                <div class="progress-bar" style="width:{{ $taux }}%;background:#6366f1;border-radius:99px"></div>
                            </div>
                            <span class="text-muted" style="font-size:.72rem;white-space:nowrap">{{ $taux }}%</span>
                        </div>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('villes.edit', $ville->id) }}"
                               class="btn btn-icon btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil" style="font-size:.8rem"></i>
                            </a>
                            <form action="{{ route('villes.destroy', $ville->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Supprimer {{ addslashes($ville->ville) }} ? Tous ses habitants seront supprimés.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-icon btn-outline-danger" title="Supprimer">
                                    <i class="bi bi-trash" style="font-size:.8rem"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">
                        <i class="bi bi-inbox d-block mb-2" style="font-size:2rem"></i>
                        Aucune ville enregistrée.
                        <div class="mt-2">
                            <a href="{{ route('villes.create') }}" class="btn btn-sm btn-success">
                                <i class="bi bi-plus-lg me-1"></i>Ajouter la première
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($villes->hasPages())
    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center py-3 px-4">
        <span class="text-muted small">Page {{ $villes->currentPage() }} sur {{ $villes->lastPage() }}</span>
        {{ $villes->links() }}
    </div>
    @endif
</div>

@endsection
