<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('phones')->paginate(15);

        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->load('phones');
        return view('contacts.show', compact('contact'));
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $contact->phones()->delete();
        return redirect()->route('contacts.index')->with('success', 'Contato excluído com sucesso!');
    }
}
