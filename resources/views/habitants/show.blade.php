@extends('layout')
@section('title', $habitant->nom.' '.$habitant->prenom)
@section('page-title', 'Habitants / Fiche')

@section('content')
<div class="row justify-content-center">
<div class="col-lg-6">

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('habitants.index') }}" class="btn btn-icon btn-outline-secondary">
        <i class="bi bi-arrow-left" style="font-size:.85rem"></i>
    </a>
    <h5 class="fw-bold mb-0">Fiche habitant</h5>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">

        {{-- Header coloré --}}
        <div style="background:linear-gradient(135deg,#6366f1,#4f46e5);border-radius:14px 14px 0 0;padding:2rem;text-align:center">
            @if($habitant->photo)
                <img src="{{ asset('storage/'.$habitant->photo) }}"
                     style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.4)">
            @else
                <div style="width:90px;height:90px;border-radius:50%;background:rgba(255,255,255,.2);
                            display:flex;align-items:center;justify-content:center;
                            font-size:2.2rem;font-weight:700;color:#fff;margin:0 auto;
                            border:3px solid rgba(255,255,255,.3)">
                    {{ strtoupper(substr($habitant->nom,0,1)) }}
                </div>
            @endif
            <h4 class="text-white fw-bold mt-3 mb-1">{{ $habitant->nom }} {{ $habitant->prenom }}</h4>
            <span style="background:rgba(255,255,255,.2);color:#fff;padding:.3em .9em;border-radius:20px;font-size:.8rem">
                <i class="bi bi-geo-alt me-1"></i>{{ $habitant->ville->ville ?? '—' }}
            </span>
        </div>

        {{-- Infos --}}
        <div class="p-4">
            <div class="row g-3">
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#f8fafc">
                        <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;font-weight:700">CIN</div>
                        <div class="fw-semibold mt-1"><code>{{ $habitant->cin }}</code></div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#f8fafc">
                        <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;font-weight:700">Ville</div>
                        <div class="fw-semibold mt-1">{{ $habitant->ville->ville ?? '—' }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#f8fafc">
                        <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;font-weight:700">Ajouté le</div>
                        <div class="fw-semibold mt-1">{{ $habitant->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3" style="background:#f8fafc">
                        <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.05em;font-weight:700">Modifié le</div>
                        <div class="fw-semibold mt-1">{{ $habitant->updated_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('habitants.edit', $habitant->id) }}" class="btn btn-warning flex-grow-1">
                    <i class="bi bi-pencil me-1"></i>Modifier
                </a>
                <a href="{{ route('habitants.index') }}" class="btn btn-outline-secondary flex-grow-1">
                    <i class="bi bi-arrow-left me-1"></i>Retour
                </a>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endsection
