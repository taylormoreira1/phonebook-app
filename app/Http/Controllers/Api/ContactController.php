<?php

namespace App\Http\Controllers\Api;

use App\Models\Phone;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function store(CreateContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth' => $request->birth,
            'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
        ]);

        $phonesData = collect($request->phones)->map(function ($phoneData) {
            return [
                'phone' => $phoneData['phone'],
                'ddd' => $phoneData['ddd'],
                'type' => $phoneData['type']
            ];
        });
        $contact->phones()->createMany($phonesData);

        $contact->load('phones');

        return response()->json($contact, 201);
    }

    public function index()
    {
        $contacts = Contact::with('phones')->paginate(15);

        return response()->json($contacts, 200);
    }

    public function show($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contato não encontrado.'], 404);
        }

        $contact->load('phones');
        return response()->json($contact);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contato não encontrado.'], 404);
        }

        if ($request->email != $contact->email && Contact::where('email', $request->email)->exists()) {
            return response()->json(['message' => 'O email fornecido já está em uso.'], 400);
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

            $phonesData = collect($request->phones)->map(function ($phoneData) {
                return [
                    'phone' => $phoneData['phone'],
                    'ddd' => $phoneData['ddd'],
                    'type' => $phoneData['type']
                ];
            });
            $contact->phones()->createMany($phonesData);

            $contact->load('phones');

            DB::commit();
            return response()->json(['message' => 'Contato atualizado com sucesso', 'contact' => $contact]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contato não encontrado.'], 404);
        }

        $contact->delete();
        $contact->phones()->delete();
        return response()->json(['message' => 'Contato deletado com sucesso'], 204);
    }
}
