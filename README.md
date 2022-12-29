<h1 align="center"> Gerenciador de Produtos </h1>
<p align="center"> Este é um sistema web utilizando o Laravel framework tendo as seguintes funcionalidades:  </p>

- Gerenciamento e Autenticação de usuários;
- Gerenciamento de produtos;
- Gerenciamento de categorias de produtos;
- Upload de imagens;

<h1 align="center"> Demo </h1>
https://gerenciador.adevtecnologia.com.br/

<h1 align="center"> Pré-requisitos </h1>

- PHP 7.2
- Banco de dados MySQL
- Apache ou Nginx

<h1 align="center"> Documentação api </h1>

<!-- CATEGORIES  -->
<h2 align="center"> Criar categoria </h2>

| Method | Url                               |
|:-------|:----------------------------------|
| POST   | http://\<dominio\>/api/categories |

### BODY PARAMS

| Campo             |  Descrição                           | Tipo    | Obrigatório? |
|:------------------|:-------------------------------------|:--------|:-------------|
| category          | Nome da categoria                    | string  | Sim          |
| description       | Descrição da categoria               | text    | Não          |
| category_father   | ID da categoria pai. Valor padrão: 0 | integer | Sim          |

- Content-Type `application/json`
- Accept `application/json`

### Exemplo de retorno

Status: `201 Created`

```
{
    "category": "Informática",
    "description": "Criando categoria",
    "category_father": "0",
    "updated_at": "2021-11-18T23:34:49.000000Z",
    "created_at": "2021-11-18T23:34:49.000000Z",
    "id": 1
}
```

<br>

<h2 align="center"> Editar categoria </h2>

| Method | Url                                      |
|:-------|:-----------------------------------------|
| PUT    | http://\<dominio\>/api/categories/\<id\> |

### BODY PARAMS

| Campo             |  Descrição                           | Tipo    | Obrigatório? |
|:------------------|:-------------------------------------|:--------|:-------------|
| category          | Nome da categoria                    | string  | Sim          |
| description       | Descrição da categoria               | text    | Não          |
| category_father   | ID da categoria pai. Valor padrão: 0 | integer | Não          |

- Content-Type `application/json`
- Accept `application/json`

### Exemplo de retorno

Status: `200 OK`

```
{
    "id": 1,
    "category": "Informática Editado",
    "description": "Editando categoria",
    "category_father": "0",
    "created_at": "2021-11-18T20:16:58.000000Z",
    "updated_at": "2021-11-18T23:53:40.000000Z",
    "deleted_at": null
}
```

<br>

<h2 align="center"> Listar categorias </h2>

| Method | Url                               |
|:-------|:----------------------------------|
| GET    | http://\<dominio\>/api/categories |

### Exemplo de retorno

Status: `200 OK`

```
[
    {
        "id": 1,
        "category": "Smartphones",
        "description": "Todos os Smartphones",
        "category_father": "0",
        "created_at": "2021-11-18T20:16:58.000000Z",
        "updated_at": "2021-11-18T20:16:58.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "category": "Notebooks",
        "description": "Todos os Notebooks",
        "category_father": "0",
        "created_at": "2021-11-18T20:22:07.000000Z",
        "updated_at": "2021-11-18T20:37:38.000000Z",
        "deleted_at": null
    }
]
```

<br>

<h2 align="center"> Deletar categoria </h2>

| Method | Url                                      |
|:-------|:-----------------------------------------|
| DELETE | http://\<dominio\>/api/categories/\<id\> |

### Exemplo de retorno

Status: `204 No Content`

<br>

<!-- PRODUCTS -->
<h2 align="center"> Criar produto </h2>

| Method | Url                             |
|:-------|:--------------------------------|
| POST   | http://\<dominio\>/api/products |

### BODY PARAMS

| Campo             |  Descrição                           | Tipo    | Obrigatório? |
|:------------------|:-------------------------------------|:--------|:-------------|
| category_id       | ID da categoria                      | bigint  | Sim          |
| product           | Nome do produto                      | string  | Sim          |
| description       | Descrição do produto                 | text    | Não          |
| price             | Preço do produto                     | integer | Sim          |
| stock             | Quantidade de produtos em estoque    | integer | Sim          |
| archive_id        | ID da imagem do produto              | bigint  | Não          |

- Content-Type `application/json`
- Accept `application/json`

### Exemplo de retorno

Status: `201 Created`

```
{
    "category_id": "3",
    "product": "iPhone XR",
    "description": "Criando produto",
    "price": "3.000,00",
    "stock": "6",
    "archive_id": null,
    "updated_at": "2021-11-19T00:54:54.000000Z",
    "created_at": "2021-11-19T00:54:54.000000Z",
    "id": 2
}
```

<br>

<h2 align="center"> Editar produto </h2>

| Method | Url                                      |
|:-------|:-----------------------------------------|
| PUT    | http://\<dominio\>/api/products/\<id\>   |

### BODY PARAMS

| Campo             |  Descrição                           | Tipo    | Obrigatório? |
|:------------------|:-------------------------------------|:--------|:-------------|
| category_id       | ID da categoria                      | bigint  | Sim          |
| product           | Nome do produto                      | string  | Sim          |
| description       | Descrição do produto                 | text    | Não          |
| price             | Preço do produto                     | integer | Sim          |
| stock             | Quantidade de produtos em estoque    | integer | Sim          |
| archive_id        | ID da imagem do produto              | bigint  | Não          |

- Content-Type `application/json`
- Accept `application/json`

### Exemplo de retorno

Status: `200 OK`

```
{
    "id": 2,
    "category_id": "3",
    "product": "iPhone XR Editado",
    "description": "Editando Produto",
    "price": "2.500,00",
    "stock": "3",
    "archive_id": null,
    "created_at": "2021-11-18T20:39:39.000000Z",
    "updated_at": "2021-11-19T01:06:27.000000Z",
    "deleted_at": null
}
```

<br>

<h2 align="center"> Listar produtos </h2>

| Method | Url                               |
|:-------|:----------------------------------|
| GET    | http://\<dominio\>/api/products   |

### Exemplo de retorno

Status: `200 OK`

```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "category_id": 3,
            "product": "iPhone XR",
            "description": "iphone XR 64GB",
            "price": "2.500,00",
            "stock": 3,
            "archive_id": null,
            "created_at": "2021-11-18T20:39:39.000000Z",
            "updated_at": "2021-11-19T01:09:47.000000Z",
            "deleted_at": null
        },
        {
            "id": 2,
            "category_id": 3,
            "product": "Acer Nitro 5",
            "description": "Nitro 5 I7",
            "price": "3.000,00",
            "stock": 6,
            "archive_id": null,
            "created_at": "2021-11-19T00:54:54.000000Z",
            "updated_at": "2021-11-19T01:10:03.000000Z",
            "deleted_at": null
        }
    ],
    "first_page_url": "http://\<dominio\>/api/products?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://\<dominio\>/api/products?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://\<dominio\>/api/products?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://\<dominio\>/api/products",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

<br>

<h2 align="center"> Deletar produto </h2>

| Method | Url                                    |
|:-------|:---------------------------------------|
| DELETE | http://\<dominio\>/api/products/\<id\> |

### Exemplo de retorno

Status: `204 No Content`

<br>

<!-- IMAGEM -->
<h2 align="center"> Cadastrar imagem </h2>

| Method | Url                             |
|:-------|:--------------------------------|
| POST   | http://\<dominio\>/api/archives |

### BODY PARAMS

| Campo    |  Descrição                           | Tipo    | Obrigatório? |
|:---------|:-------------------------------------|:--------|:-------------|
| archive  | Imagem do produto                    | file    | Sim          |

- Content-Type `multipart/form-data`
- Accept `application/json`

### Exemplo de retorno

Status: `201 Created`

```
{
    "id": 1
    "archive": "iPhone XR.jpg",
    "updated_at": "2021-11-19T01:25:35.000000Z",
    "created_at": "2021-11-19T01:25:35.000000Z",
}
```

<br>

<h2 align="center"> Listar imagens </h2>

| Method | Url                             |
|:-------|:--------------------------------|
| GET    | http://\<dominio\>/api/archives |

### Exemplo de retorno

Status: `200 OK`

```
[
    {
        "id": 1,
        "archive": "iPhone XR.jpg",
        "created_at": "2021-11-19T01:25:35.000000Z",
        "updated_at": "2021-11-19T01:44:04.000000Z",
        "deleted_at": null
    },
    {
        "id": 2,
        "archive": "Acer Nitro 5.png",
        "created_at": "2021-11-19T01:58:51.000000Z",
        "updated_at": "2021-11-19T01:58:51.000000Z",
        "deleted_at": null
    }
]
```

<br>

<h2 align="center"> Deletar imagem </h2>

| Method | Url                                    |
|:-------|:---------------------------------------|
| DELETE | http://\<dominio\>/api/archives/\<id\> |

### Exemplo de retorno

Status: `204 No Content`


