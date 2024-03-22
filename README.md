

## Installation

Clone o projeto:
```bash
git clone https://github.com/taylormoreira1/phonebook-app
```
Navegue até a pasta do projeto:
```bash
cd phonebook-app
```
Faça uma cópia de .env.example para .env e altere as credenciais do banco:
```bash
cp .env.example .env
```

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=laravel
DB_PASSWORD=secret
```

Inicie os contêineres:
```bash
docker-compose up -d
```
Entre no container:
```bash
docker exec -it taylor-app bash
```
Execute o comando composer install:
```bash
composer install
```
Configure a chave do aplicativo:
```bash
php artisan key:generate
```
Execute as migrations do banco de dados:
```bash
php artisan migrate
```
Execute os seeders:
```bash
php artisan db:seed
```
Executar test:
```bash
php artisan test 
```
## Acesso
acesse http://localhost:8000/

## Endpoint da api

Na raiz do projeto tem uma collection do postman com todos os endpoints da api: phonebook.postman_collection.

### 1. Criar contato

- **Endpoint:** `POST /api/contacts`
- **URL:** http://127.0.0.1:8000/api/contacts

#### Parâmetros da Solicitação:

| Parâmetro | Tipo     | Descrição                                     |
|-----------|----------|-----------------------------------------------|
| name      | String   | **Obrigatório.** O nome do contato.           |
| email     | String   | O email do contato.                           |
| birth     | Date     | A data de nascimento do contato (YYYY-MM-DD). |
| cpf       | String   | O CPF do contato (apenas dígitos).            |
| phones    | Array    | **Obrigatório.** Array de telefones do contato. |

#### Exemplo de Corpo da Solicitação:

```form-data
name: User Api
email: teste@emailapi.com
birth: 1994-01-31
cpf: 39954996001
phones[0][phone]: 91152333
phones[0][ddd]: 11
phones[0][type]: Residencial
phones[1][phone]: 91152325
phones[1][ddd]: 21
phones[1][type]: Whatsapp
```

### 2. Listar contatos

- **Endpoint:** `GET /api/contacts`
- **URL:** http://127.0.0.1:8000/api/contacts

### 3. Detalhes do contatos

- **Endpoint:** `GET /contacts/{id}`
- **URL:** http://127.0.0.1:8000/api/contacts/{id}

| Parâmetro | Tipo     | Descrição                                     |
|-----------|----------|-----------------------------------------------|
| id        | int      | Obrigatório. O ID do contato a ser buscado.   |


### 4. Atualizar contato

- **Endpoint:** `PUT /contacts/{id}`
- **URL:** http://127.0.0.1:8000/api/contacts/{id}


#### Parâmetros da Solicitação:

| Parâmetro | Tipo | Descrição                                      |
|-----------|------|------------------------------------------------|
| id        | Int  | **Obrigatório.** O ID do contato a ser atualizado.|
| name      | String   | O novo nome do contato.                       |
| email     | String   | O novo email do contato.                      |
| birth     | Date     | A nova data de nascimento do contato (YYYY-MM-DD). |
| cpf       | String   | O novo CPF do contato (apenas dígitos).        |
| phones    | Array    | Array de telefones do contato.                 |

#### Exemplo de Corpo da Solicitação:

```form-data
name: User Api
email: teste@emailapi.com
birth: 1994-01-31
cpf: 39954996001
phones[0][phone]: 91152333
phones[0][ddd]: 11
phones[0][type]: Residencial
phones[1][phone]: 91152325
phones[1][ddd]: 21
phones[1][type]: Whatsapp
```

### 5. Detalhes do contatos

- **Endpoint:** `DELETE /contacts/{id}`
- **URL:** http://127.0.0.1:8000/api/contacts/{id}

| Parâmetro | Tipo     | Descrição                                     |
|-----------|----------|-----------------------------------------------|
| id        | int      | Obrigatório. O ID do contato a ser excluído.  |



