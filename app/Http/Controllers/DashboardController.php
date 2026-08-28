<?php

namespace App\Http\Controllers;

use App\Models\Livre;
use App\Models\User;
use App\Models\Emprunt;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalLivres = Livre::count();
        $totalEtudiants = User::where('role', 'etudiant')->count();
        $totalBibliothecaires = User::where('role', 'bibliothecaire')->count();
        $totalEmprunts = Emprunt::count();
        $totalRetards = Emprunt::where('statut', 'en_retard')->count();

        return view('admin.dashboard', compact(
            'totalLivres',
            'totalEtudiants',
            'totalBibliothecaires',
            'totalEmprunts',
            'totalRetards'
        ));
    }

    public function etudiant()
    {
        return view('etudiant.dashboard');
    }

    public function bibliothecaire()
    {
        return view('bibliothecaire.dashboard');
    }
}