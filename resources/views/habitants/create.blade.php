@extends('layout')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-header bg-success text-white">
        <h4>➕ Ajouter un Habitant</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('habitants.store') }}"
              method="POST"
              enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="fw-bold">CIN</label>
            <input type="text" name="cin"
                   class="form-control @error('cin') is-invalid @enderror"
                   value="{{ old('cin') }}" placeholder="Ex: AB123456">
            @error('cin')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="fw-bold">Nom</label>
            <input type="text" name="nom"
                   class="form-control @error('nom') is-invalid @enderror"
                   value="{{ old('nom') }}">
            @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="fw-bold">Prénom</label>
            <input type="text" name="prenom"
                   class="form-control @error('prenom') is-invalid @enderror"
                   value="{{ old('prenom') }}">
            @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="fw-bold">Ville</label>
            <select name="ville_id"
                    class="form-select @error('ville_id') is-invalid @enderror">
              <option value="">-- Choisir une ville --</option>
              @foreach($villes as $ville)
                <option value="{{ $ville->id }}"
                    {{ old('ville_id') == $ville->id ? 'selected' : '' }}>
                    {{ $ville->ville }}
                </option>
              @endforeach
            </select>
            @error('ville_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label class="fw-bold">Photo</label>
            <input type="file" name="photo" accept="image/*"
                   class="form-control @error('photo') is-invalid @enderror"
                   onchange="previewImg(this)">
            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            <img id="preview" src="#"
                 class="mt-2 rounded d-none"
                 style="max-height:150px">
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">💾 Enregistrer</button>
            <a href="{{ route('habitants.index') }}" class="btn btn-secondary">❌ Annuler</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const p = document.getElementById('preview');
            p.src = e.target.result;
            p.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection