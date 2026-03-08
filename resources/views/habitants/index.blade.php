@extends('layout')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>👥 Habitants
        <span class="badge bg-secondary">{{ $habitants->total() }}</span>
    </h2>
    <a href="{{ route('habitants.create') }}" class="btn btn-success">
        ➕ Ajouter
    </a>
</div>

{{-- FILTRE PAR VILLE --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="GET" action="{{ route('habitants.index') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="fw-bold">🔍 Filtrer par ville</label>
                <select name="ville_id" class="form-select">
                    <option value="">-- Toutes les villes --</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->id }}"
                            {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
                            {{ $ville->ville }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">🔍 Filtrer</button>
                <a href="{{ route('habitants.index') }}" class="btn btn-secondary">✖ Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- TABLEAU --}}
<div class="table-responsive shadow rounded">
    <table class="table table-bordered table-hover bg-white mb-0">
        <thead class="table-dark text-center">
            <tr>
                <th>Photo</th>
                <th>CIN</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Ville</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($habitants as $habitant)
            <tr class="text-center align-middle">
                <td>
                    @if($habitant->photo)
                        <img src="{{ asset('storage/' . $habitant->photo) }}"
                             width="50" height="50"
                             class="rounded-circle object-fit-cover"
                             alt="photo">
                    @else
                        <span class="fs-4">👤</span>
                    @endif
                </td>
                <td>{{ $habitant->cin }}</td>
                <td><strong>{{ $habitant->nom }}</strong></td>
                <td>{{ $habitant->prenom }}</td>
                <td>
                    <span class="badge bg-primary">
                        {{ $habitant->ville->ville ?? '-' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('habitants.show', $habitant->id) }}"
                       class="btn btn-info btn-sm text-white">👁️</a>
                    <a href="{{ route('habitants.edit', $habitant->id) }}"
                       class="btn btn-warning btn-sm">✏️</a>
                    <form action="{{ route('habitants.destroy', $habitant->id) }}"
                          method="POST" style="display:inline"
                          onsubmit="return confirm('Supprimer ?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-3">
                    Aucun habitant trouvé.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div class="d-flex justify-content-center mt-4">
    {{ $habitants->appends(request()->query())->links() }}
</div>
{{-- appends() garde le filtre actif lors du changement de page --}}

@endsection