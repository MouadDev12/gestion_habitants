@extends('layout')
@section('title', 'Modifier — '.$habitant->nom)
@section('page-title', 'Habitants / Modifier')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('habitants.index') }}" class="btn btn-icon btn-outline-secondary">
        <i class="bi bi-arrow-left" style="font-size:.85rem"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Modifier : {{ $habitant->nom }} {{ $habitant->prenom }}</h5>
        <p class="text-muted small mb-0">CIN : <code>{{ $habitant->cin }}</code></p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('habitants.update', $habitant->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Photo --}}
            <div class="text-center mb-4">
                <div style="width:90px;height:90px;border-radius:50%;overflow:hidden;margin:0 auto;border:2px solid #e2e8f0">
                    @if($habitant->photo)
                        <img id="previewImg" src="{{ asset('storage/'.$habitant->photo) }}"
                             style="width:100%;height:100%;object-fit:cover">
                    @else
                        <div id="previewImg" style="width:100%;height:100%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;color:#94a3b8">
                            {{ strtoupper(substr($habitant->nom,0,1)) }}
                        </div>
                    @endif
                </div>
                <label for="photo" class="btn btn-sm btn-outline-secondary mt-2">
                    <i class="bi bi-upload me-1"></i>Changer la photo
                </label>
                <input type="file" name="photo" id="photo" accept="image/*" class="d-none" onchange="handlePhoto(this)">
                @error('photo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">CIN *</label>
                    <input type="text" name="cin"
                           class="form-control @error('cin') is-invalid @enderror"
                           value="{{ old('cin', $habitant->cin) }}" maxlength="20">
                    @error('cin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Ville *</label>
                    <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror">
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}"
                                {{ old('ville_id', $habitant->ville_id) == $ville->id ? 'selected' : '' }}>
                                {{ $ville->ville }}
                            </option>
                        @endforeach
                    </select>
                    @error('ville_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nom *</label>
                    <input type="text" name="nom"
                           class="form-control @error('nom') is-invalid @enderror"
                           value="{{ old('nom', $habitant->nom) }}">
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Prénom *</label>
                    <input type="text" name="prenom"
                           class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom', $habitant->prenom) }}">
                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="bi bi-floppy me-1"></i>Mettre à jour
                </button>
                <a href="{{ route('habitants.index') }}" class="btn btn-outline-secondary">Annuler</a>
                <form action="{{ route('habitants.destroy', $habitant->id) }}"
                      method="POST" class="ms-auto"
                      onsubmit="return confirm('Supprimer définitivement cet habitant ?')">
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

@push('scripts')
<script>
function handlePhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const el = document.getElementById('previewImg');
            if (el.tagName === 'IMG') {
                el.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.id = 'previewImg';
                img.src = e.target.result;
                img.style = 'width:100%;height:100%;object-fit:cover';
                el.replaceWith(img);
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
