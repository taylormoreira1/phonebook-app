<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('phones')->paginate(15);

        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->load('phones');
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {

        if ($request->email != $contact->email && Contact::where('email', $request->email)->exists()) {
            return back()->withErrors('O email fornecido já está em uso.');
        }

        DB::beginTransaction();
        try {

            $contact->update([
                'name' => $request->name,
                'email' => $request->email,
                'birth' => $request->birth,
                'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
            ]);

            $contact->phones()->delete();

            $phonesData = collect($request->phones)->map(function ($phoneData, $index) use ($request) {
                return [
                    'phone' => $request->phones[$index],
                    'ddd' => $request->ddds[$index],
                    'type' => $request->types[$index]
                ];
            });

            $contact->phones()->createMany($phonesData);
            $contact->load('phones');

            DB::commit();
            return redirect()->route('contacts.index')->with('success', 'Usuário atualizado com sucesso');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
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
