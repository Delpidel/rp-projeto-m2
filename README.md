# Introdução

FitLab LTDA é uma empresa do ramo de suplementos alimentares que está expandindo sua rede de lojas. Este projeto é uma API que torna possível o gerenciamento e listagem dessas lojas e de seus suplementos de forma simples e objetiva aos seus gestores. O projeto foi desenvolvido usando Laravel 10 e PostgreSQL como banco de dados.

## Dependências do projeto

[PHP](https://www.php.net/)
[Laravel](https://laravel.com/)
[Composer](https://getcomposer.org/download/)
[Docker](https://docs.docker.com/desktop/install/windows-install/)

## Modelagem do banco de dados

Para melhor compreendimento, a modelagem do banco de dados pode ser acessada em: https://dbdocs.io/helena_delpizzo/FitLab?view=relationships

## Softwares e repositório para a execução do projeto

Para executar o projeto, é necessário instalar o editor de códigos [Visual Studio Code](https://code.visualstudio.com/); <br>
Instalar o software [Docker](https://www.docker.com/products/docker-desktop/); <br>
Instalar o software [Dbeaver](https://dbeaver.io/), que é a interface do banco de dados; <br>
Acessar https://github.com/Delpidel/rp-projeto-m2 e clonar o repositório para sua máquina. Ao clonar o repositório, abra o terminal com o comando CTRL + Shift + '' e execute o comando 'cd fitlab_api' para acessar a pasta do projeto.

## Execução do projeto

Execute o PowerShell como Administrador e utilize o comando: docker run --name fitlab -e POSTGRESQL_USERNAME=admin -e POSTGRESQL_PASSWORD=admin-e POSTGRESQL_DATABASE=fitlab_api -p 5432:5432 bitnami/postgresql<br>
Dessa forma, ao abrir o Docker, será possível visualizar um container com o nome "fitlab", que é a base do banco de dados do projeto.<br>
Abra o DBeaver, crie uma conexão PostgreSQL e insira o database 'fitlab_api, o usuário e a senha. <br><br>

No VSCode, crie um arquivo .env, copie e cole o conteúdo do arquivo .env.example e faça as seguintes alterações:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=fitlab_api
DB_USERNAME=admin
DB_PASSWORD=admin
```

No terminal, execute o seguinte comando:

```
composer install
```

Para criar as migrations do banco de dados, execute no terminal:

```
php artisan migrate
```

Para rodar o servidor, execute o comando:

```
php artisan serve
```

## Documentação da API

### Endpoint - Rota Usuário - Pública

### S01 - Cadastro de usuário

`POST /api/users`

| Parâmetro  | Tipo     | Descrição                                               |
| ---------- | -------- | ------------------------------------------------------- |
| `name`     | `string` | **Máximo 255 caracteres e obrigatório**.                |
| `email`    | `string` | **Máximo de 255 caracteres, obrigatório e único**.      |
| `cpf`      | `string` | **Máximo de 14 caracteres, obrigatório e único**.       |
| `password` | `string` | **Máximo de 32 caracteres, mínimo de 8 e obrigatório**. |

Exemplo de request JSON

```http
  {
    "name": "Helena Del",
    "email": "helena@email.com",
    "cpf": "77788899944",
    "password": "senha1234",
}
```

| Response Status | Descrição       |
| :-------------- | :-------------- |
| `201`           | Sucesso         |
| `400`           | Dados inválidos |

### Endpoint - Rota Login - Pública

### S02 - Login

`POST /api/login`

Exemplo de request JSON

```http
  {
  "email": "helena@email.com",
  "password": "senha1234"
}
```

| Response Status | Descrição                |
| :-------------- | :----------------------- |
| `200`           | Sucesso                  |
| `token`         | Token jwt válido por 24h |
| `400`           | Dados inválidos          |
| `401`           | Login inválido           |

Exemplo de response JSON

```http
  {
  "message": "Autenticado com sucesso",
  "status": 200,
  "data": {
    "token": "32|qL7tHRe6ZrwcQ2v1ddbK9A1RTeLvl59qZJU2Nk4n4d0231f6",
    "name": "Helena Del"
  }
}
```

### Endpoint - Rota Cadastro de lojas - Privada

### S03 - Cadastro de lojas

`POST /api/stores`

| Parâmetro      | Tipo     | Descrição                                          |
| -------------- | -------- | -------------------------------------------------- |
| `company_name` | `string` | **Máximo 255 caracteres e obrigatório**.           |
| `fantasy_name` | `string` | **Máximo de 255 caracteres e obrigatório**.        |
| `cnpj`         | `string` | **Máximo de 14 caracteres, obrigatório e único**.  |
| `email`        | `string` | **Máximo de 255 caracteres, obrigatório e único**. |
| `contact`      | `string` | **Máximo de 20 caracteres, obrigatório**.          |
| `city`         | `string` | **Máximo de 50 caracteres e obrigatório**.         |
| `neighborhood` | `string` | **Máximo de 50 caracteres e obrigatório**.         |
| `number`       | `string` | **Máximo de 30 caracteres e obrigatório**.         |
| `street`       | `string` | **Máximo de 30 caracteres e obrigatório**.         |
| `state`        | `string` | **Máximo de 2 caracteres e obrigatório**.          |
| `cep`          | `string` | **Máximo de 20 caracteres e obrigatório**.         |

Exemplo de request JSON

```http
  {
  "company_name": "Empresa FitLab LTDA",
  "fantasy_name": "Empresa FitLab",
  "cnpj": "12345658001100",
  "email": "fitlab3@email.com",
  "contact": "999998788",
  "city": "Floripa",
  "neighborhood": "Oficinas",
  "number": "456",
  "street": "Rua Dona Rosa",
  "state": "SC",
  "cep": "12345-678"
}
```

Exemplo de response JSON

```http
  {
  "store": {
    "company_name": "Empresa FitLab LTDA",
    "fantasy_name": "Empresa FitLab",
    "cnpj": "12345658001100",
    "email": "fitlab3@email.com",
    "contact": "999998788",
    "city": "Floripa",
    "neighborhood": "Oficinas",
    "number": "456",
    "street": "Rua Dona Rosa",
    "state": "SC",
    "cep": "12345-678",
    "updated_at": "2024-02-24T16:47:00.000000Z",
    "created_at": "2024-02-24T16:47:00.000000Z",
    "id": 3
  }
}
```

### Endpoint - Rota de Listagem de lojas - Privada

### S04 - Listagem de lojas

`GET /api/stores`

Exemplo de response JSON

```http
  {
  "stores": [
    {
      "id": 1,
      "company_name": "Empresa FitLab LTDA",
      "fantasy_name": "Empresa FitLab",
      "cnpj": "12345678000100",
      "email": "fitlab@email.com",
      "contact": "999998888",
      "city": "Floripa",
      "neighborhood": "Oficinas",
      "number": "456",
      "street": "Rua Dona Rosa",
      "state": "SC",
      "cep": "12345-678",
      "created_at": "2024-02-22T17:50:45.000000Z",
      "updated_at": "2024-02-22T17:50:45.000000Z"
    },
    {
      "id": 2,
      "company_name": "Empresa FitLab LTDA",
      "fantasy_name": "Empresa FitLab",
      "cnpj": "12345678001100",
      "email": "fitlab2@email.com",
      "contact": "999998888",
      "city": "Floripa",
      "neighborhood": "Oficinas",
      "number": "456",
      "street": "Rua Dona Rosa",
      "state": "SC",
      "cep": "12345-678",
      "created_at": "2024-02-23T22:43:52.000000Z",
      "updated_at": "2024-02-23T22:43:52.000000Z"
    }
  ]
  }
```

| Response Status | Descrição |
| :-------------- | :-------- |
| `200`           | Sucesso   |

### Endpoint - Cadastro de suplementos - Privada

### S05 - Cadastro de suplementos

`POST /api/supplements`

| Parâmetro           | Tipo      | Descrição                                          |
| ------------------- | --------- | -------------------------------------------------- |
| `manufacturer_name` | `string`  | **Máximo 255 caracteres e obrigatório**.           |
| `amount`            | `integer` | **Coluna numérica e obrigatória**.                 |
| `description`       | `string`  | **Máximo de 255 caracteres e opcional**.           |
| `price`             | `float`   | **Coluna numérica float e obrigatória**.           |
| `type`              | `ENUM`    | **Opções: Cápsula, Em pó, Grão, Líquido, Outros**. |

Exemplo de request JSON

```http
  {
  "manufacturer_name": "Suplementos",
  "amount": 10,
  "description": "Melhora seu desempenho na academia",
  "price": "10.99",
  "type": "Cápsula"
}
```

Exemplo de response JSON

```http
  {
  "message": "Suplemento cadastrado com sucesso.",
  "status": 201,
  "data": {
    "manufacturer_name": "Suplementos",
    "amount": 10,
    "description": "Melhora seu desempenho na academia",
    "price": "10.99",
    "type": "Cápsula",
    "updated_at": "2024-02-24T17:46:59.000000Z",
    "created_at": "2024-02-24T17:46:59.000000Z",
    "id": 1
  }
}
```

| Response Status | Descrição       |
| :-------------- | :-------------- |
| `201`           | Sucesso         |
| `400`           | Dados inválidos |

### Endpoint - Listagem de suplementos - Privada

### S06 - Listagem de suplementos

`GET /api/supplements`

Exemplo de response JSON

```http
  {
  "supplements": [
    {
      "id": 1,
      "manufacturer_name": "Suplementos",
      "amount": 10,
      "description": "Melhora seu desempenho na academia",
      "price": "10.99",
      "type": "Cápsula",
      "created_at": "2024-02-24T17:46:59.000000Z",
      "updated_at": "2024-02-24T17:46:59.000000Z"
    }
  ]
}
```

| Response Status | Descrição |
| :-------------- | :-------- |
| `200`           | Sucesso   |

### Endpoint - Listagem de suplementos por ID - Privada

### S07 - Listagem de suplementos por ID

`GET /api/supplements/{id}`

Exemplo de request JSON

```http
  {
  "id": 1
}
```

Exemplo de response JSON

```http
  {
  "supplement": {
    "id": 1,
    "manufacturer_name": "Suplementos",
    "amount": 10,
    "description": "Melhora seu desempenho na academia",
    "price": "10.99",
    "type": "Cápsula",
    "created_at": "2024-02-24T17:46:59.000000Z",
    "updated_at": "2024-02-24T17:46:59.000000Z"
  }
}
```

| Response Status | Descrição |
| :-------------- | :-------- |
| `200`           | Sucesso   |

## Melhorias a serem aplicadas

O projeto ficou dentro de uma pasta chamada fitlab_api, que não fica na raiz do projeto, necessitando da execução do comando cd fitlab_api para rodar a aplicação. Outra melhoria seria importar PDF da modelagem de dados para que o leitor não precisasse acessar o link do DBDiagram.
