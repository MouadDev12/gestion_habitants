<?php

namespace App\Http\Controllers;

use App\Models\Habitant;
use App\Models\Ville;

class DashboardController extends Controller
{
    public function index()
    {
        $totalHabitants  = Habitant::count();
        $totalVilles     = Ville::count();
        $avecPhoto       = Habitant::whereNotNull('photo')->count();
        $recentHabitants = Habitant::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->count();

        $topVilles = Ville::withCount('habitants')
                          ->orderByDesc('habitants_count')
                          ->limit(6)
                          ->get();

        $derniers = Habitant::with('ville')
                            ->latest()
                            ->limit(6)
                            ->get();

        return view('dashboard', compact(
            'totalHabitants', 'totalVilles', 'avecPhoto',
            'recentHabitants', 'topVilles', 'derniers'
        ));
    }
}
