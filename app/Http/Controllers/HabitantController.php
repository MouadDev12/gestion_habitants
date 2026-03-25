<?php

namespace App\Http\Controllers;

use App\Models\Habitant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HabitantController extends Controller
{
    public function index(Request $request)
    {
        $villes = Ville::orderBy('ville')->get();

        $query = Habitant::with('ville');

        if ($request->filled('ville_id')) {
            $query->where('ville_id', $request->ville_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('nom',    'like', "%$s%")
                  ->orWhere('prenom', 'like', "%$s%")
                  ->orWhere('cin',    'like', "%$s%");
            });
        }

        $habitants = $query->orderBy('nom')->paginate(10)->withQueryString();

        return view('habitants.index', compact('habitants', 'villes'));
    }

    public function create()
    {
        $villes = Ville::orderBy('ville')->get();
        return view('habitants.create', compact('villes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cin'      => 'required|unique:habitants|max:20',
            'nom'      => 'required|min:2|max:100',
            'prenom'   => 'required|min:2|max:100',
            'ville_id' => 'required|exists:villes,id',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('cin', 'nom', 'prenom', 'ville_id');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('habitants', 'public');
        }

        Habitant::create($data);

        return redirect()->route('habitants.index')
                         ->with('success', 'Habitant ajouté avec succès.');
    }

    public function show(Habitant $habitant)
    {
        return view('habitants.show', compact('habitant'));
    }

    public function edit(Habitant $habitant)
    {
        $villes = Ville::orderBy('ville')->get();
        return view('habitants.edit', compact('habitant', 'villes'));
    }

    public function update(Request $request, Habitant $habitant)
    {
        $request->validate([
            'cin'      => 'required|max:20|unique:habitants,cin,' . $habitant->id,
            'nom'      => 'required|min:2|max:100',
            'prenom'   => 'required|min:2|max:100',
            'ville_id' => 'required|exists:villes,id',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('cin', 'nom', 'prenom', 'ville_id');

        if ($request->hasFile('photo')) {
            if ($habitant->photo) {
                Storage::disk('public')->delete($habitant->photo);
            }
            $data['photo'] = $request->file('photo')->store('habitants', 'public');
        }

        $habitant->update($data);

        return redirect()->route('habitants.index')
                         ->with('success', 'Habitant mis à jour.');
    }

    public function destroy(Habitant $habitant)
    {
        if ($habitant->photo) {
            Storage::disk('public')->delete($habitant->photo);
        }
        $habitant->delete();

        return redirect()->route('habitants.index')
                         ->with('success', 'Habitant supprimé.');
    }
}
