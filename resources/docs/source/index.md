---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://127.0.0.1:8000/docs/collection.json)

<!-- END_INFO -->

#Auth


Gerenciamento de login
<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Log-off

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Faz log-off do usuário.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Usuário deslogado!"
}
```

### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

<!-- START_1c1379ad98c1e4337433460cbb47992e -->
## Refresh

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Atualiza o Token do usuário logado.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
    "token_type": "bearer",
    "reset_password": false
}
```

### HTTP Request
`POST api/v1/auth/refresh`


<!-- END_1c1379ad98c1e4337433460cbb47992e -->

<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Login

Autenticação via e-mail e senha para obter um token JTW bearer.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"email":"contato@octopusfit.com.br","password":"123!123"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "contato@octopusfit.com.br",
    "password": "123!123"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
    "token_type": "bearer",
    "reset_password": false
}
```

### HTTP Request
`POST api/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | E-mail do usuário.
        `password` | string |  required  | Senha do usuário.
    
<!-- END_a925a8d22b3615f12fca79456d286859 -->

#File


Gerenciamento de documentos
<!-- START_5a0bd3075d15a3d997afc6ec1fd3b92b -->
## Listagem de documentos

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os documentos cadastrados do usuário

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/file" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/file"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": [
        {
            "id": 1,
            "description": "PADRÃO",
            "category": "TERMO DE USO",
            "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf",
            "created_at": "2021-10-15T22:02:34.000000Z"
        },
        {
            "id": 2,
            "description": "ANAMNESE NOVO ALUNO",
            "category": "ANAMNESE",
            "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf",
            "created_at": "2021-10-15T22:02:34.000000Z"
        }
    ]
}
```

### HTTP Request
`GET api/v1/file`


<!-- END_5a0bd3075d15a3d997afc6ec1fd3b92b -->

<!-- START_4564250a8b30c72ffa7c1305b3936fcc -->
## Cadastrar novo documento

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Salva um arquivo em PDF através de upload. Exemplos: Anamnese, Contrato, Prescrição Médica

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/file" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"category":"quasi"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/file"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "category": "quasi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
null
```

### HTTP Request
`POST api/v1/file`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `category` | string |  required  | O nome da categoria do documento. Ver endpoint de exibição de categorias
        `description` | string |  required  | Uma descrição para o documento.
        `file` | file |  required  | Deve ser um arquivo com maximo de 2048 kb.
    
<!-- END_4564250a8b30c72ffa7c1305b3936fcc -->

<!-- START_97a06e6531b3f9cf4507c08e7f82a231 -->
## Remover documento

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Remove um arquivo do usuário da base de dados

> Example request:

```bash
curl -X DELETE \
    "http://127.0.0.1:8000/api/v1/file/1?id=debitis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/file/1"
);

let params = {
    "id": "debitis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Documento removido com sucesso!"
}
```

### HTTP Request
`DELETE api/v1/file/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | integer required O ID do documento a ser removido.

<!-- END_97a06e6531b3f9cf4507c08e7f82a231 -->

<!-- START_deb22f3ab09814614b6a2a19e50603a0 -->
## Listagem de categorias

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista as categorias possíveis para upload de documentos

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/file/category" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/file/category"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": [
        "ANAMNESE",
        "TERMO DE USO",
        "PRESCRIÇÃO MÉDICA"
    ]
}
```

### HTTP Request
`GET api/v1/file/category`


<!-- END_deb22f3ab09814614b6a2a19e50603a0 -->

#Student


Gerenciamento de usuário do tipo aluno
<!-- START_030b955ad750805ab931f71b74142453 -->
## Upload de anamnese

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Permite que o aluno faça upload do arquivo PDF de anamnese preenchido.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/student/anamnesis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/student/anamnesis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {
        "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf"
    },
    "message": "Mensagem de erro se houver"
}
```

### HTTP Request
`POST api/v1/student/anamnesis`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `description` | string |  optional  | Descrição opcional.
        `file` | file |  required  | Deve ser um arquivo com maximo de 2048 kb.
    
<!-- END_030b955ad750805ab931f71b74142453 -->

#Teacher


Gerenciamento de usuário do tipo professor
<!-- START_80c4d2e94ee0dfdb80a1bac74b5f642b -->
## Alterar dados do professor

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Altera as informações do professor logado. O response em caso de sucesso 200 é a própria requisição dentro de 'data'.

> Example request:

```bash
curl -X PUT \
    "http://127.0.0.1:8000/api/v1/teacher" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Matheus","cpf":"12345678980","cnpj":"73942003000118","phone":"19991501844","media_facebook":"https:\/\/facebook.com\/professor","media_instagram":"@linchester","media_whatsapp":"19991501844","terms_use":"eligendi","genre":"dolores","dt_born":"01\/01\/1970"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/teacher"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Matheus",
    "cpf": "12345678980",
    "cnpj": "73942003000118",
    "phone": "19991501844",
    "media_facebook": "https:\/\/facebook.com\/professor",
    "media_instagram": "@linchester",
    "media_whatsapp": "19991501844",
    "terms_use": "eligendi",
    "genre": "dolores",
    "dt_born": "01\/01\/1970"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {},
    "message": "Mensagem de erro se houver"
}
```

### HTTP Request
`PUT api/v1/teacher`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome do professor.
        `cpf` | string |  optional  | CPF sem acentuação.
        `cnpj` | string |  optional  | CNPJ sem acentuação.
        `phone` | string |  optional  | Número de telefone sem acentuação.
        `media_facebook` | string |  optional  | URL do Facebook do professor.
        `media_instagram` | string |  optional  | Conta no Instagram do professor.
        `media_whatsapp` | string |  optional  | Número do WhatsApp do professor.
        `terms_use` | string |  optional  | Termo de uso digitado (caso ele não opte pelo upload do PDF).
        `genre` | string |  required  | Gênero (sexo) do professor, sendo M - Masculino, F - Feminino, O - Outro
        `dt_born` | date |  optional  | Data de nascimento.
    
<!-- END_80c4d2e94ee0dfdb80a1bac74b5f642b -->

<!-- START_2f276f728990f872d02e8a1fdfe08d01 -->
## Adiciona e convida um novo aluno

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Cadastra e envia um e-mail a um novo aluno vinculado ao professor logado. No e-mail contém a senha para o primeiro acesso.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/teacher/new-student" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Matheus","phone":"19991501844","type_student":"P","type_contract":"T","notes":"Aluno antigo da escola"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/teacher/new-student"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Matheus",
    "phone": "19991501844",
    "type_student": "P",
    "type_contract": "T",
    "notes": "Aluno antigo da escola"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {},
    "message": "Mensagem de erro se houver"
}
```

### HTTP Request
`POST api/v1/teacher/new-student`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome do professor.
        `phone` | string |  optional  | Número de telefone sem acentuação.
        `type_student` | string |  required  | Tipo de aluno: P - presencial, O - online.
        `type_contract` | string |  required  | Tipo de contrato: M - mensal, T - trimestral, S - semestral.
        `photo` | file |  optional  | Imagem em png ou jpg com maximo de 2048 kb.
        `notes` | string |  optional  | Texto com máximo de 255 caracteres.
    
<!-- END_2f276f728990f872d02e8a1fdfe08d01 -->

<!-- START_e34f3d487e621ab164d1333e46c1636b -->
## Atualiza dados do aluno

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Permite que o professor atualize dados do cadastro de um aluno.

> Example request:

```bash
curl -X PUT \
    "http://127.0.0.1:8000/api/v1/teacher/edit-student" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"id_student":0,"type_student":"P","type_contract":"T","status":"magnam","notes":"Aluno antigo da escola","id_required_anamnesis":20}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/teacher/edit-student"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "id_student": 0,
    "type_student": "P",
    "type_contract": "T",
    "status": "magnam",
    "notes": "Aluno antigo da escola",
    "id_required_anamnesis": 20
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {},
    "message": "Mensagem de erro se houver"
}
```

### HTTP Request
`PUT api/v1/teacher/edit-student`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id_student` | integer |  required  | ID do aluno.
        `type_student` | string |  required  | Tipo de aluno: P - presencial, O - online.
        `type_contract` | string |  required  | Tipo de contrato: M - mensal, T - trimestral, S - semestral.
        `status` | string |  required  | Status do aluno. Aqui é possível bloquear o acesso no login se definido I (inativo). Exampe: A
        `notes` | string |  optional  | Texto com máximo de 255 caracteres.
        `id_required_anamnesis` | integer |  optional  | ID do documento de anamnese caso o professor queira solicitar preenchimento de anamnese. Ver módulo 'File'
    
<!-- END_e34f3d487e621ab164d1333e46c1636b -->

<!-- START_e9b54d1b794da3a0b76d1837c45b401c -->
## Listagem de alunos

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os alunos vinculados ao professor

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/teacher/show-students" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/teacher/show-students"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": [
        {
            "id_student": 2,
            "name": "JUQUINHA",
            "status": "A",
            "type_student": "P",
            "type_contract": "S",
            "notes": null,
            "created_at": "2021-10-15 18:42:22",
            "updated_at": "2021-10-15 19:16:05",
            "anamnesis": {
                "id_required_anamnesis": 2,
                "url_required_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
                "description_required_anamnesis": "ANAMNESE NOVO ALUNO",
                "id_uploaded_anamnesis": null,
                "url_uploaded_anamnesis": null,
                "description_uploaded_anamnesis": null
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/teacher/show-students`


<!-- END_e9b54d1b794da3a0b76d1837c45b401c -->

#User


Gerenciamento de usuário
<!-- START_2bd7e3f2440dabd5a1a7ec210e7ac7c5 -->
## Alterar senha

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Altera a senha de um usuário.

> Example request:

```bash
curl -X PUT \
    "http://127.0.0.1:8000/api/v1/user/pass" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"password":"123!abc"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user/pass"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "password": "123!abc"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Alguma mensagem de erro, se existir.",
    "access_token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
    "token_type": "bearer"
}
```

### HTTP Request
`PUT api/v1/user/pass`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `password` | string |  required  | Senha de 6 caracteres com letras, números e caracteres especiais.
    
<!-- END_2bd7e3f2440dabd5a1a7ec210e7ac7c5 -->

<!-- START_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
## Exibir dados do usuário

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Recupera as informações do usuário logado. Alguns itens podem variar dependendo do tipo de usuário logado: Professor (T) ou Aluno (S). Por exemplo, o campo terms_use só existe para os professores.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {
        "id": 1,
        "name": "PERSONAL MATHEUS",
        "email": "contato@octopusfit.com.br",
        "cpf": "12345678980",
        "cnpj": null,
        "phone": null,
        "photo": "http:\/\/127.0.0.1:8000\/storage\/images\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.jpg",
        "media_facebook": "https:\/\/facebook.com\/usuario",
        "media_instagram": null,
        "media_whatsapp": null,
        "terms_use": "http:\/\/127.0.0.1:8000\/storage\/terms\/1\/byWMlIyaSD8KAJSve2tQdGtzwIPqH4LIgBpLe2ED.pdf",
        "status": "A",
        "genre": "M",
        "dt_born": "01\/01\/1970",
        "type": "T",
        "token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
        "created_at": "2021-09-24T22:47:24.000000Z",
        "updated_at": "2021-09-28T01:24:23.000000Z"
    }
}
```
> Example response (200):

```json
{
    "result": true,
    "data": {
        "id": 2,
        "name": "JUQUINHA",
        "email": "juquinha@gmail.com",
        "cpf": null,
        "phone": null,
        "photo": null,
        "media_facebook": null,
        "media_instagram": null,
        "media_whatsapp": null,
        "status": "A",
        "genre": "M",
        "dt_born": "01\/01\/1970",
        "type": "S",
        "token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
        "created_at": "2021-10-15T21:42:22.000000Z",
        "updated_at": "2021-10-15T22:41:20.000000Z",
        "info": {
            "type_student": "P",
            "type_contract": "S",
            "notes": null,
            "status": "A",
            "anamnesis": {
                "id_required_anamnesis": 2,
                "url_required_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
                "description_required_anamnesis": "ANAMNESE NOVO ALUNO",
                "id_uploaded_anamnesis": 3,
                "url_uploaded_anamnesis": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/b4zQVLi6wAhiROK6UMqqnPDxBSnJ6cJFCXmm8RqZ.pdf",
                "description_uploaded_anamnesis": null
            },
            "teacher": {
                "id": 1,
                "name": "PERSONAL MATHEUS",
                "media_facebook": "https:\/\/facebook.com\/usuario",
                "media_instagram": null,
                "media_whatsapp": null,
                "genre": "M"
            }
        }
    }
}
```

### HTTP Request
`GET api/v1/user`


<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->

<!-- START_827a17bffc1a06b780d13a89cc1ccd51 -->
## Salvar imagem de perfil

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Salva a imagem de perfil do usuário.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/user/photo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user/photo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {
        "photo": "http:\/\/127.0.0.1:8000\/storage\/images\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.jpg"
    }
}
```

### HTTP Request
`POST api/v1/user/photo`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `photo` | file |  required  | Imagem em png ou jpg com maximo de 2048 kb.
    
<!-- END_827a17bffc1a06b780d13a89cc1ccd51 -->

<!-- START_1b54cb09758834354bcb7b0128c1241e -->
## Remover imagem de perfil

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Remove a imagem de perfil do usuário.

> Example request:

```bash
curl -X DELETE \
    "http://127.0.0.1:8000/api/v1/user/photo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user/photo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Foto removida com sucesso!"
}
```

### HTTP Request
`DELETE api/v1/user/photo`


<!-- END_1b54cb09758834354bcb7b0128c1241e -->

<!-- START_f0654d3f2fc63c11f5723f233cc53c83 -->
## Cadastrar novo usuário

Cadastra um novo usuário Personal Trainer. O response em caso de sucesso 200 é a própria requisição dentro de 'data'.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Matheus","email":"contato@octopusfit.com.br","password":"123!abc","cpf":"12345678980","cnpj":"modi"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Matheus",
    "email": "contato@octopusfit.com.br",
    "password": "123!abc",
    "cpf": "12345678980",
    "cnpj": "modi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "data": {},
    "message": "Mensagem de erro se houver"
}
```

### HTTP Request
`POST api/user`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome do usuário.
        `email` | string |  required  | E-mail do usuário usado para acesso ao app.
        `password` | string |  required  | Senha de 6 caracteres com letras, números e caracteres especiais.
        `cpf` | string |  optional  | CPF sem acentuação.
        `cnpj` | string |  optional  | CNPJ sem acentuação.
    
<!-- END_f0654d3f2fc63c11f5723f233cc53c83 -->

<!-- START_4afb717d4e78c85b0b8bd4ee9bf42117 -->
## Redefinir senha

Funcionalidade da tela inicial para redefinição de senha por esquecimento.
Depois do primeiro login com a nova senha, a chave 'reset_password' ficará como true e o app deverá direcionar o usuário para uma tela onde deverá ser escolhida a senha definitiva. Para tanto, chamar o endpoint 'Alterar senha'.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/user/forgot-pass" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"email":"contato@octopusfit.com.br"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/user/forgot-pass"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "email": "contato@octopusfit.com.br"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "result": true,
    "message": "Foi enviado um e-mail para $email com a nova senha de acesso!"
}
```

### HTTP Request
`POST api/user/forgot-pass`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | E-mail do usuário usado para acesso ao app.
    
<!-- END_4afb717d4e78c85b0b8bd4ee9bf42117 -->

#general


<!-- START_4dfafe7f87ec132be3c8990dd1fa9078 -->
## Return an empty response simply to trigger the storage of the CSRF cookie in the browser.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/sanctum/csrf-cookie" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/sanctum/csrf-cookie"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`GET sanctum/csrf-cookie`


<!-- END_4dfafe7f87ec132be3c8990dd1fa9078 -->


