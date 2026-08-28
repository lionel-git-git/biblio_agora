<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('emprunts');

        if ($request->filled('recherche')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->recherche.'%')
                    ->orWhere('email', 'like', '%'.$request->recherche.'%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->orderBy('role')->orderBy('name')->paginate(15)->withQueryString();

        return view('admin.utilisateurs', compact('users'));
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => ['required', 'string', 'in:etudiant,bibliothecaire,admin'],
        ]);

        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', "Le rôle de {$user->name} a été mis à jour ({$request->role}).");
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('success', "L'utilisateur {$user->name} a été supprimé.");
    }
}
