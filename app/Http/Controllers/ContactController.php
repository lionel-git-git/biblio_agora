<?php

namespace App\Http\Controllers;

use App\Models\MessageContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'objet' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        MessageContact::create($request->only('nom', 'email', 'objet', 'message'));

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
    }
}