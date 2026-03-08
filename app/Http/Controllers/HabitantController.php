<?php
// app/Http/Controllers/HabitantController.php

namespace App\Http\Controllers;

use App\Models\Habitant;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HabitantController extends Controller
{
    // 1. Liste + filtre par ville
    public function index(Request $request)
    {
        $villes = Ville::orderBy('ville')->get();

        $query = Habitant::with('ville');

        // Filtre par ville si sélectionné
        if ($request->filled('ville_id')) {
            $query->where('ville_id', $request->ville_id);
        }

        $habitants = $query->orderBy('nom')->paginate(6);

        return view('habitants.index', compact('habitants', 'villes'));
    }

    // 2. Formulaire ajout
    public function create()
    {
        $villes = Ville::orderBy('ville')->get();
        return view('habitants.create', compact('villes'));
    }

    // 3. Enregistrer
    public function store(Request $request)
    {
        $request->validate([
            'cin'      => 'required|unique:habitants|max:20',
            'nom'      => 'required|min:2|max:100',
            'prenom'   => 'required|min:2|max:100',
            'ville_id' => 'required|exists:villes,id',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')
                                     ->store('habitants', 'public');
        }

        Habitant::create($data);

        return redirect()->route('habitants.index')
                         ->with('success', '✅ Habitant ajouté !');
    }

    // 4. Détails
    public function show(Habitant $habitant)
    {
        return view('habitants.show', compact('habitant'));
    }

    // 5. Formulaire modification
    public function edit(Habitant $habitant)
    {
        $villes = Ville::orderBy('ville')->get();
        return view('habitants.edit', compact('habitant', 'villes'));
    }

    // 6. Mettre à jour
    public function update(Request $request, Habitant $habitant)
    {
        $request->validate([
            'cin'      => 'required|max:20|unique:habitants,cin,' . $habitant->id,
            'nom'      => 'required|min:2|max:100',
            'prenom'   => 'required|min:2|max:100',
            'ville_id' => 'required|exists:villes,id',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($habitant->photo) {
                Storage::disk('public')->delete($habitant->photo);
            }
            $data['photo'] = $request->file('photo')
                                     ->store('habitants', 'public');
        }

        $habitant->update($data);

        return redirect()->route('habitants.index')
                         ->with('success', '✅ Habitant modifié !');
    }

    // 7. Supprimer
    public function destroy(Habitant $habitant)
    {
        if ($habitant->photo) {
            Storage::disk('public')->delete($habitant->photo);
        }
        $habitant->delete();

        return redirect()->route('habitants.index')
                         ->with('success', '🗑️ Habitant supprimé !');
    }
}