@extends('layout')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card shadow">
      <div class="card-header bg-warning">
        <h4>✏️ Modifier : {{ $habitant->nom }} {{ $habitant->prenom }}</h4>
      </div>
      <div class="card-body">
        <form action="{{ route('habitants.update', $habitant->id) }}"
              method="POST"
              enctype="multipart/form-data">
          @csrf @method('PUT')

          <div class="mb-3">
            <label class="fw-bold">CIN</label>
            <input type="text" name="cin" class="form-control"
                   value="{{ old('cin', $habitant->cin) }}">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Nom</label>
            <input type="text" name="nom" class="form-control"
                   value="{{ old('nom', $habitant->nom) }}">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Prénom</label>
            <input type="text" name="prenom" class="form-control"
                   value="{{ old('prenom', $habitant->prenom) }}">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Ville</label>
            <select name="ville_id" class="form-select">
              @foreach($villes as $ville)
                <option value="{{ $ville->id }}"
                    {{ $habitant->ville_id == $ville->id ? 'selected' : '' }}>
                    {{ $ville->ville }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Photo actuelle</label><br>
            @if($habitant->photo)
                <img src="{{ asset('storage/' . $habitant->photo) }}"
                     class="rounded mb-2" style="max-height:100px">
            @else
                <p class="text-muted">Aucune photo</p>
            @endif
            <label class="fw-bold">Nouvelle photo</label>
            <input type="file" name="photo" accept="image/*"
                   class="form-control" onchange="previewImg(this)">
            <img id="preview" src="#" class="mt-2 rounded d-none"
                 style="max-height:150px">
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-warning">💾 Mettre à jour</button>
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