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

    public function indexAdmin()
    {
        $messages = MessageContact::latest()->paginate(15);

        return view('admin.messages', compact('messages'));
    }

    public function marquerLu(MessageContact $message)
    {
        $message->update(['lu' => true]);

        return back()->with('success', 'Message marqué comme lu.');
    }

    public function destroy(MessageContact $message)
    {
        $message->delete();

        return back()->with('success', 'Message supprimé.');
    }
}
