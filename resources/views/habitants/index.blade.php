@extends('layout')
@section('title', 'Habitants')
@section('page-title', 'Habitants')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h5 class="fw-bold mb-0">Liste des habitants</h5>
        <p class="text-muted small mb-0">{{ $habitants->total() }} enregistrement(s) trouvé(s)</p>
    </div>
    <a href="{{ route('habitants.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> Ajouter un habitant
    </a>
</div>

{{-- ── FILTRES ── --}}
<div class="card shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('habitants.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Ville</label>
                <select name="ville_id" class="form-select form-select-sm">
                    <option value="">Toutes les villes</option>
                    @foreach($villes as $v)
                        <option value="{{ $v->id }}" {{ request('ville_id') == $v->id ? 'selected' : '' }}>
                            {{ $v->ville }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Recherche</label>
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control"
                           placeholder="Nom, prénom ou CIN…" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-auto d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                @if(request()->hasAny(['ville_id','search']))
                    <a href="{{ route('habitants.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-x-lg"></i> Réinitialiser
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th class="ps-4">Habitant</th>
                    <th>CIN</th>
                    <th>Ville</th>
                    <th>Date d'ajout</th>
                    <th class="text-end pe-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($habitants as $habitant)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center gap-3">
                            @if($habitant->photo)
                                <img src="{{ asset('storage/'.$habitant->photo) }}" class="avatar">
                            @else
                                @php
                                    $colors = [
                                        ['#ede9fe','#6d28d9'],['#d1fae5','#065f46'],
                                        ['#fef3c7','#92400e'],['#fce7f3','#9d174d'],['#dbeafe','#1e40af']
                                    ];
                                    $c = $colors[$habitant->id % 5];
                                @endphp
                                <div class="avatar-placeholder" style="background:{{ $c[0] }};color:{{ $c[1] }}">
                                    {{ strtoupper(substr($habitant->nom,0,1)) }}
                                </div>
                            @endif
                            <div>
                                <div class="fw-semibold small">{{ $habitant->nom }} {{ $habitant->prenom }}</div>
                            </div>
                        </div>
                    </td>
                    <td><code class="small">{{ $habitant->cin }}</code></td>
                    <td>
                        <span class="badge-ville">
                            <i class="bi bi-geo-alt me-1"></i>{{ $habitant->ville->ville ?? '—' }}
                        </span>
                    </td>
                    <td class="text-muted small">{{ $habitant->created_at->format('d/m/Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('habitants.show', $habitant->id) }}"
                               class="btn btn-icon btn-outline-secondary" title="Voir">
                                <i class="bi bi-eye" style="font-size:.8rem"></i>
                            </a>
                            <a href="{{ route('habitants.edit', $habitant->id) }}"
                               class="btn btn-icon btn-outline-warning" title="Modifier">
                                <i class="bi bi-pencil" style="font-size:.8rem"></i>
                            </a>
                            <form action="{{ route('habitants.destroy', $habitant->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Supprimer {{ addslashes($habitant->nom.' '.$habitant->prenom) }} ?')">
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
                        Aucun habitant trouvé.
                        <div class="mt-2">
                            <a href="{{ route('habitants.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus-lg me-1"></i>Ajouter le premier
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($habitants->hasPages())
    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center py-3 px-4">
        <span class="text-muted small">
            Page {{ $habitants->currentPage() }} sur {{ $habitants->lastPage() }}
        </span>
        {{ $habitants->appends(request()->query())->links() }}
    </div>
    @endif
</div>

@endsection
