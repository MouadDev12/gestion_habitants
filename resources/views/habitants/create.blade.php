@extends('layout')
@section('title', 'Ajouter un habitant')
@section('page-title', 'Habitants / Ajouter')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-7">

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('habitants.index') }}" class="btn btn-icon btn-outline-secondary">
        <i class="bi bi-arrow-left" style="font-size:.85rem"></i>
    </a>
    <div>
        <h5 class="fw-bold mb-0">Ajouter un habitant</h5>
        <p class="text-muted small mb-0">Remplissez les informations ci-dessous</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('habitants.store') }}" method="POST" enctype="multipart/form-data" id="habitantForm">
            @csrf

            {{-- Photo upload --}}
            <div class="text-center mb-4">
                <div id="avatarPreview"
                     style="width:90px;height:90px;border-radius:50%;background:#f1f5f9;border:2px dashed #cbd5e1;
                            display:flex;align-items:center;justify-content:center;margin:0 auto;cursor:pointer;overflow:hidden;transition:.2s">
                    <i class="bi bi-camera text-muted" style="font-size:1.5rem" id="cameraIcon"></i>
                    <img id="previewImg" src="#" class="d-none" style="width:100%;height:100%;object-fit:cover">
                </div>
                <label for="photo" class="btn btn-sm btn-outline-secondary mt-2">
                    <i class="bi bi-upload me-1"></i>Choisir une photo
                </label>
                <input type="file" name="photo" id="photo" accept="image/*" class="d-none" onchange="handlePhoto(this)">
                @error('photo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">CIN *</label>
                    <input type="text" name="cin"
                           class="form-control @error('cin') is-invalid @enderror"
                           value="{{ old('cin') }}" placeholder="Ex: AB123456" maxlength="20">
                    @error('cin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Ville *</label>
                    <select name="ville_id" class="form-select @error('ville_id') is-invalid @enderror">
                        <option value="">— Sélectionner —</option>
                        @foreach($villes as $ville)
                            <option value="{{ $ville->id }}" {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
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
                           value="{{ old('nom') }}" placeholder="Nom de famille">
                    @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Prénom *</label>
                    <input type="text" name="prenom"
                           class="form-control @error('prenom') is-invalid @enderror"
                           value="{{ old('prenom') }}" placeholder="Prénom">
                    @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <hr class="my-4">

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-floppy me-1"></i>Enregistrer
                </button>
                <a href="{{ route('habitants.index') }}" class="btn btn-outline-secondary">Annuler</a>
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
            document.getElementById('cameraIcon').classList.add('d-none');
            const img = document.getElementById('previewImg');
            img.src = e.target.result;
            img.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
