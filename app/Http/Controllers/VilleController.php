<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    public function index()
    {
        $villes = Ville::withCount('habitants')
                       ->orderBy('ville')
                       ->paginate(10);

        return view('villes.index', compact('villes'));
    }

    public function create()
    {
        return view('villes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ville'          => 'required|unique:villes|min:2|max:100',
            'nombreHabitant' => 'required|integer|min:0',
        ]);

        Ville::create($request->only('ville', 'nombreHabitant'));

        return redirect()->route('villes.index')
                         ->with('success', 'Ville ajoutée avec succès.');
    }

    public function edit(Ville $ville)
    {
        $ville->loadCount('habitants');
        return view('villes.edit', compact('ville'));
    }

    public function update(Request $request, Ville $ville)
    {
        $request->validate([
            'ville'          => 'required|min:2|max:100|unique:villes,ville,' . $ville->id,
            'nombreHabitant' => 'required|integer|min:0',
        ]);

        $ville->update($request->only('ville', 'nombreHabitant'));

        return redirect()->route('villes.index')
                         ->with('success', 'Ville mise à jour.');
    }

    public function destroy(Ville $ville)
    {
        $ville->delete();

        return redirect()->route('villes.index')
                         ->with('success', 'Ville supprimée.');
    }
}
