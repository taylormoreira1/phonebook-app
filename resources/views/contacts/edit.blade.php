<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contato</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-1 alert-validation-msg"
                role="alert">
                <div class="alert-body flex items-center">
                    @foreach ($errors->all() as $error)
                        <i data-feather="info" class="material-icons me-2">info</i>
                        <span>{{ $error }}</span><br>
                    @endforeach
                </div>
            </div>
        @endif
        <h1 class="text-3xl font-bold text-center mt-5">Editar Contato</h1>

        <form method="POST" class="mt-10" action="{{ route('contact.update', ['contact' => $contact]) }}"
            enctype="multipart/form-data" class="mt-4 min-w-full ">
            @csrf
            @method('put')
            <div class="grid grid-cols-1 gap-4">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Informações Pessoais</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Nome</label>
                                <input type="text" name="name" value="{{ $contact->name }}" required
                                    class="block border border-gray-200 p-2 py-1 w-full" />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ $contact->email }}" required
                                    class="block border border-gray-200 p-2 py-1 w-full" />
                            </div>
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">CPF</label>
                                <input type="text" name="cpf" value="{{ $contact->cpf }}" required
                                    class="block border border-gray-200 p-2 py-1 w-full" />
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Data de Nascimento</label>
                                <input type="date" name="birth" id="birthdate" value="{{ $contact->birth }}"
                                    required class="block border border-gray-200 p-2 py-1 w-full" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">

                    <div class="bg-white shadow-md rounded-md p-6">
                        <h2 class="text-lg font-semibold mb-4">Informações de Contato</h2>
                        <div id="phones-container">
                            @foreach ($contact->phones as $phone)
                                <div class="grid grid-cols-4 gap-4 phone-row">
                                    <div>
                                        <label for="phone" class="block text-gray-700">DDD</label>
                                        <input type="text" class="block border border-gray-200 p-2 py-1 mb-5 w-full"
                                            name="ddds[]" value="{{ $phone->ddd }}" maxlength="2" required />
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-gray-700">Telefone</label>
                                        <input type="text"
                                            class="phone-input block border border-gray-200 p-2 py-1 mb-5 w-full"
                                            name="phones[]" value="{{ $phone->phone }}"minlength="8" maxlength="9"
                                            required />
                                    </div>
                                    <div>
                                        <label for="type" class="block text-gray-700 ">Tipo</label>
                                        <input type="text" name="types[]" value="{{ $phone->type }}" required
                                            class="block border border-gray-200 p-2 py-1 mb-5 w-full" />
                                    </div>
                                    <div class="flex items-center">
                                        <button type="button"
                                            class="btn-delete-phone text-red-500 hover:text-red-700">Remover</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-phone"
                            class="btn-add-phone bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">Adicionar
                            Telefone</button>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex justify-between">
                <button type="submit"
                    class="btn-submit bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {


            $('#add-phone').click(function() {
                var newPhoneField = $('.phone-row').first().clone();
                newPhoneField.find('input').val('');
                $('#phones-container').append(newPhoneField);
            });

            $(document).on('click', '.btn-delete-phone', function() {
                $(this).closest('.phone-row').remove();
            });


        });
    </script>

</body>

</html>
