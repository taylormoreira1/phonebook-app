<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CPFValidationRule;

class UpdateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'birth' => 'date',
            'cpf' => [new CPFValidationRule],
            'phones' => [
                'required',
                'array',
                'min:1',
                'max:5',
                'distinct',
                function ($attribute, $value, $fail) {
                    foreach ($value as $phone) {
                        $rules = [
                            'phone' => 'required|string|regex:/^\d{8,9}$/',
                            'ddd' => 'required|string|max:2',
                            'type' => 'required|string',
                        ];

                        $validator = \Validator::make($phone, $rules);

                        if ($validator->fails()) {
                            $fail($validator->errors()->first());
                        }
                    }
                },
            ],
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Por favor, insira um e-mail válido.',
            'email.unique' => 'Este e-mail já está sendo usado por outro contato.',
            'birth.required' => 'O campo de nascimento é obrigatório.',
            'birth.date' => 'Por favor, insira uma data de nascimento válida.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está sendo usado por outro contato.',
            'phones.required' => 'Pelo menos um telefone é obrigatório.',
            'phones.array' => 'O campo telefones deve ser um array.',
            'phones.min' => 'Pelo menos um telefone é obrigatório.',
            'phones.max' => 'Você não pode adicionar mais de 5 telefones.',
            'phones.distinct' => 'Não é permitido telefones duplicados.',
            'phone.regex' => 'O número de telefone deve conter apenas números e ter no mínimo 8 e no máximo 9 dígitos.',
        ];
    }


    public function withValidator($validator)
    {
        $cpf = $this->input('cpf');

        if (!empty($cpf)) {
            $validator->after(function ($validator) use ($cpf) {
                $this->merge(['cpf' => preg_replace('/[^0-9]/', '', $cpf)]);
                $cpfValidator = new CPFValidationRule();

                if (!$cpfValidator->passes('cpf', $this->input('cpf'))) {
                    $validator->errors()->add('cpf', 'CPF inválido.');
                }
            });
        }
    }
}
