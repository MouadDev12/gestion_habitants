@extends('layout')
@section('content')
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card shadow text-center">
      <div class="card-body p-4">

        {{-- PHOTO --}}
        @if($habitant->photo)
            <img src="{{ asset('storage/' . $habitant->photo) }}"
                 class="rounded-circle mb-3"
                 width="120" height="120"
                 style="object-fit:cover">
        @else
            <div class="mb-3">
                <span style="font-size:5rem">👤</span>
            </div>
        @endif

        <h3>{{ $habitant->nom }} {{ $habitant->prenom }}</h3>
        <p class="text-muted">CIN : <strong>{{ $habitant->cin }}</strong></p>

        <span class="badge bg-primary fs-6 mb-3">
            🏙️ {{ $habitant->ville->ville ?? '-' }}
        </span>

        <div class="d-flex gap-2 justify-content-center mt-3">
            <a href="{{ route('habitants.edit', $habitant->id) }}"
               class="btn btn-warning">✏️ Modifier</a>
            <a href="{{ route('habitants.index') }}"
               class="btn btn-secondary">⬅️ Retour</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection