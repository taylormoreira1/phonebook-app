<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Contato</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4 text-center">Detalhes do Contato</h1>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nome:</label>
                <p class="text-gray-900">{{ $contact->name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <p class="text-gray-900">{{ $contact->email }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Data de Nascimento:</label>
                <p class="text-gray-900">{{ date('d/m/Y', strtotime($contact->birth)) }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">CPF:</label>
                <p class="text-gray-900">{{ $contact->cpf }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Telefones:</label>
                <ul>
                    @foreach ($contact->phones as $phone)
                        <li class="text-gray-900">{{ $phone->type }}: ({{ $phone->ddd }}) {{ $phone->phone }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
