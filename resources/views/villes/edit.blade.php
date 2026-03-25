@extends('layout')
@section('title', 'Modifier — '.$ville->ville)
@section('page-title', 'Villes / Modifier')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('villes.index') }}" class="btn btn-icon btn-outline-secondary">
        <i class="bi bi-arrow-left" style="font-size:.85rem"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Modifier : {{ $ville->ville }}</h5>
        <p class="text-muted small mb-0">{{ $ville->habitants_count }} habitant(s) enregistré(s)</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('villes.update', $ville->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom de la ville *</label>
                <input type="text" name="ville"
                       class="form-control @error('ville') is-invalid @enderror"
                       value="{{ old('ville', $ville->ville) }}" autofocus>
                @error('ville')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Population officielle *</label>
                <div class="input-group">
                    <input type="number" name="nombreHabitant"
                           class="form-control @error('nombreHabitant') is-invalid @enderror"
                           value="{{ old('nombreHabitant', $ville->nombreHabitant) }}" min="0">
                    <span class="input-group-text">habitants</span>
                    @error('nombreHabitant')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="bi bi-floppy me-1"></i>Mettre à jour
                </button>
                <a href="{{ route('villes.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <form action="{{ route('villes.destroy', $ville->id) }}"
                      method="POST" class="ms-auto"
                      onsubmit="return confirm('Supprimer {{ addslashes($ville->ville) }} et tous ses habitants ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i>Supprimer
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>

</div>
</div>
@endsection
