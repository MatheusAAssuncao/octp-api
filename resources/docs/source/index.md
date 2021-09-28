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
    -d '{"email":"contato@octopusfit.com.br","password":"123!abc"}'

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
    "password": "123!abc"
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
Recupera as informações do usuário logado.

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
        "name": "Matheus",
        "email": "contato@octopusfit.com.br",
        "temp_password": null,
        "cpf": "12345678980",
        "cnpj": null,
        "phone": null,
        "photo": "http:\/\/127.0.0.1:8000\/storage\/images\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.jpg",
        "media_facebook": "https:\/\/facebook.com\/usuario",
        "media_instagram": null,
        "media_whatsapp": null,
        "terms_use": "http:\/\/127.0.0.1:8000\/storage\/terms\/1\/byWMlIyaSD8KAJSve2tQdGtzwIPqH4LIgBpLe2ED.pdf",
        "id_tems_use": 1,
        "status": "A",
        "token": "eyaeXAi85dJhbGcdiJIUzI1NiJ9.HRwOjgXC8xMjcuMC4",
        "created_at": "2021-09-24T22:47:24.000000Z",
        "updated_at": "2021-09-28T01:24:23.000000Z"
    }
}
```

### HTTP Request
`GET api/v1/user`


<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->

<!-- START_fbb042dc4d73e868a98cb91becbbd0af -->
## Alterar dados do usuário

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Altera as informações do usuário logado. O response em caso de sucesso 200 é a própria requisição dentro de 'data'.

> Example request:

```bash
curl -X PUT \
    "http://127.0.0.1:8000/api/v1/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Matheus","cpf":"12345678980","phone":"19991501844","media_facebook":"https:\/\/facebook.com\/usuario","media_instagram":"@linchester","media_whatsapp":"19991501844","terms_use":"accusamus"}'

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

let body = {
    "name": "Matheus",
    "cpf": "12345678980",
    "phone": "19991501844",
    "media_facebook": "https:\/\/facebook.com\/usuario",
    "media_instagram": "@linchester",
    "media_whatsapp": "19991501844",
    "terms_use": "accusamus"
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
`PUT api/v1/user`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome do usuário.
        `cpf` | string |  optional  | CPF sem acentuação.
        `phone` | string |  optional  | Número de telefone sem acentuação.
        `media_facebook` | string |  optional  | URL do Facebook do usuário.
        `media_instagram` | string |  optional  | Conta no Instagram do usuário.
        `media_whatsapp` | string |  optional  | Número do WhatsApp do usuário.
        `terms_use` | string |  optional  | Termo de uso digitado (caso ele não opte pelo upload do PDF).
    
<!-- END_fbb042dc4d73e868a98cb91becbbd0af -->

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

<!-- START_8344b7428c9bacd73137379dbca72169 -->
## Salvar termo de uso

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Salva o PDF do termo de uso escolhido pelo usuário via upload.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/user/term" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user/term"
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
        "terms_use": "http:\/\/127.0.0.1:8000\/storage\/terms\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf"
    }
}
```

### HTTP Request
`POST api/v1/user/term`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `terms_use` | file |  required  | Deve ser um PDF com maximo de 2048 kb.
    
<!-- END_8344b7428c9bacd73137379dbca72169 -->

<!-- START_8ffe7bffa186ae200e3a45eb25762625 -->
## Remover termo de uso

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Remove o arquivo PDF do termo de uso do usuário.

> Example request:

```bash
curl -X DELETE \
    "http://127.0.0.1:8000/api/v1/user/term" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/user/term"
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
    "message": "Termo removido com sucesso!"
}
```

### HTTP Request
`DELETE api/v1/user/term`


<!-- END_8ffe7bffa186ae200e3a45eb25762625 -->

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
    -d '{"name":"Matheus","email":"contato@octopusfit.com.br","password":"123!abc","cpf":"12345678980","cnpj":"velit"}'

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
    "cnpj": "velit"
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


