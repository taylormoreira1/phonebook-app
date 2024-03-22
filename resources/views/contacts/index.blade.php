<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lista de Contatos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        @if (Session::has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-10"
                role="alert">
                <strong class="font-bold">Successo!</strong>
                <span class="block sm:inline">{{ Session::get('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Fechar</title>
                        <path
                            d="M14.354 5.646a.5.5 0 0 1 0 .708L10.707 10l3.647 3.646a.5.5 0 0 1-.708.708L10 10.707l-3.646 3.647a.5.5 0 1 1-.708-.708L9.293 10 5.646 6.354a.5.5 0 0 1 .708-.708L10 9.293l3.646-3.647a.5.5 0 0 1 .708 0z" />
                    </svg>
                </span>
            </div>
        @endif
        <h1 class="text-3xl font-bold text-center">Agenda Telefonica</h1>

        {{-- <div>
            <input id="search-input" class="block border border-gray-200 p-3 py-2 mt-10 w-full" type="text"
                placeholder="Digite o nome de um contato">
        </div> --}}


        <table class="min-w-full divide-y divide-gray-200 mt-10">

            <thead class="bg-indigo-500 text-white rounded">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Nome
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Qtd de telefones</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($contacts as $contact)
                    <tr>
                        <td class="p-3 border border-gray-200">{{ $contact->name }}</td>
                        <td class="p-3 border border-gray-200">{{ $contact->email }}</td>
                        <td class="p-3 border border-gray-200 text-center">{{ $contact->phones->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <!-- Botão para detalhes do usuário -->
                            <a href="{{ route('contacts.show', $contact->id) }}"
                                class="text-green-600 hover:text-green-900 ml-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </a>

                            <!-- Botão para deletar usuário -->
                            <a href="{{ route('contacts.delete', $contact->id) }}"
                                class="text-red-600 hover:text-red-900 ml-2"
                                onclick="event.preventDefault(); document.getElementById('delete-contact-form-{{ $contact->id }}').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>

                            <form id="delete-contact-form-{{ $contact->id }}"
                                action="{{ route('contacts.delete', $contact->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginação -->
        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</body>

</html>
