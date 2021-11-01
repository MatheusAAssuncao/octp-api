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

#Card


Gerenciamento de fichas
<!-- START_c05468726b0b6e22a35cc6246eac5562 -->
## Listagem de fichas

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista as fichas cadastradas para o aluno

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/card/1?id=molestiae" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/card/1"
);

let params = {
    "id": "molestiae",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

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
            "name": "FICHA DE ADAPTAÇÃO",
            "description": "TREINO TEMPORÁRIO DE ADAPTAÇÃO DOS GRUPOS MUSCULARES",
            "id_teacher_student": 1,
            "id_user": 1,
            "dt_end": "01\/12\/2022",
            "times": null,
            "status": "A",
            "created_at": "2021-10-30T14:02:23.000000Z",
            "updated_at": "2021-10-30T14:02:23.000000Z",
            "trains": [
                {
                    "id": 12,
                    "name": "A",
                    "break": 120,
                    "id_card": 1,
                    "created_at": "2021-11-01T19:55:24.000000Z",
                    "updated_at": "2021-11-01T19:55:24.000000Z",
                    "exercise_groups": [
                        {
                            "id": 11,
                            "type": "TRADICIONAL",
                            "id_train": 12,
                            "order": 1,
                            "created_at": "2021-11-01T19:55:24.000000Z",
                            "updated_at": "2021-11-01T19:55:24.000000Z",
                            "exercise_details": [
                                {
                                    "id": 10,
                                    "id_exercise": 1,
                                    "id_exercise_group": 11,
                                    "id_equipment": 1,
                                    "url": null,
                                    "repetition_type": "REPETIÇÕES",
                                    "charge_type": "KILO",
                                    "series_interval": 60,
                                    "notes": "",
                                    "created_at": "2021-11-01T19:55:24.000000Z",
                                    "updated_at": "2021-11-01T19:55:24.000000Z",
                                    "exercise": {
                                        "id": 1,
                                        "name": "SUPINO RETO",
                                        "description": null,
                                        "id_muscle_group": 4,
                                        "id_equipment": 1,
                                        "id_user": null,
                                        "url": null,
                                        "musclegroup": {
                                            "id": 4,
                                            "name": "PEITORAL"
                                        },
                                        "equipment": {
                                            "id": 1,
                                            "name": "BANCO SUPINO"
                                        }
                                    },
                                    "exercise_series": [
                                        {
                                            "id": 25,
                                            "id_exercise_detail": 10,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 1,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 26,
                                            "id_exercise_detail": 10,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 2,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 27,
                                            "id_exercise_detail": 10,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 3,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 28,
                                            "id_exercise_detail": 10,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 4,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            "id": 12,
                            "type": "BI-SET",
                            "id_train": 12,
                            "order": 2,
                            "created_at": "2021-11-01T19:55:24.000000Z",
                            "updated_at": "2021-11-01T19:55:24.000000Z",
                            "exercise_details": [
                                {
                                    "id": 11,
                                    "id_exercise": 2,
                                    "id_exercise_group": 12,
                                    "id_equipment": 1,
                                    "url": null,
                                    "repetition_type": "REPETIÇÕES",
                                    "charge_type": "KILO",
                                    "series_interval": 60,
                                    "notes": "",
                                    "created_at": "2021-11-01T19:55:24.000000Z",
                                    "updated_at": "2021-11-01T19:55:24.000000Z",
                                    "exercise": {
                                        "id": 2,
                                        "name": "CRUCIFIXO INCLINADO",
                                        "description": null,
                                        "id_muscle_group": 4,
                                        "id_equipment": 2,
                                        "id_user": null,
                                        "url": null,
                                        "musclegroup": {
                                            "id": 4,
                                            "name": "PEITORAL"
                                        },
                                        "equipment": {
                                            "id": 2,
                                            "name": "BANCO RECLINÁVEL"
                                        }
                                    },
                                    "exercise_series": [
                                        {
                                            "id": 29,
                                            "id_exercise_detail": 11,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 1,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 30,
                                            "id_exercise_detail": 11,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 2,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 31,
                                            "id_exercise_detail": 11,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 3,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 32,
                                            "id_exercise_detail": 11,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 4,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        }
                                    ]
                                },
                                {
                                    "id": 12,
                                    "id_exercise": 3,
                                    "id_exercise_group": 12,
                                    "id_equipment": 1,
                                    "url": null,
                                    "repetition_type": "REPETIÇÕES",
                                    "charge_type": "KILO",
                                    "series_interval": 60,
                                    "notes": "",
                                    "created_at": "2021-11-01T19:55:24.000000Z",
                                    "updated_at": "2021-11-01T19:55:24.000000Z",
                                    "exercise": {
                                        "id": 3,
                                        "name": "CROSS OVER",
                                        "description": null,
                                        "id_muscle_group": 4,
                                        "id_equipment": 1,
                                        "id_user": null,
                                        "url": null,
                                        "musclegroup": {
                                            "id": 4,
                                            "name": "PEITORAL"
                                        },
                                        "equipment": {
                                            "id": 1,
                                            "name": "BANCO SUPINO"
                                        }
                                    },
                                    "exercise_series": [
                                        {
                                            "id": 33,
                                            "id_exercise_detail": 12,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 1,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 34,
                                            "id_exercise_detail": 12,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 2,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 35,
                                            "id_exercise_detail": 12,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 3,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        },
                                        {
                                            "id": 36,
                                            "id_exercise_detail": 12,
                                            "charge": 30,
                                            "repetition": 12,
                                            "order": 4,
                                            "created_at": "2021-11-01T19:55:24.000000Z",
                                            "updated_at": "2021-11-01T19:55:24.000000Z"
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]
}
```

### HTTP Request
`GET api/v1/card/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | O ID do aluno.

<!-- END_c05468726b0b6e22a35cc6246eac5562 -->

<!-- START_15961bf6f21defc4b4433721c0a07c01 -->
## Adiciona uma nova ficha

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Cadastra uma ficha modelo caso o parâmetro id_student esteja nulo, do contrário atribui ao aluno.

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/card" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"name":"Ficha de adapta\u00e7\u00e3o","description":"Treino tempor\u00e1rio de adapta\u00e7\u00e3o dos grupos musculares","id_student":15,"dt_end":"01\/01\/2022","times":12}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/card"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "name": "Ficha de adapta\u00e7\u00e3o",
    "description": "Treino tempor\u00e1rio de adapta\u00e7\u00e3o dos grupos musculares",
    "id_student": 15,
    "dt_end": "01\/01\/2022",
    "times": 12
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
`POST api/v1/card`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Nome da ficha.
        `description` | string |  optional  | Descrição opcional.
        `id_student` | integer |  optional  | ID do aluno
        `dt_end` | date |  optional  | Data de término.
        `times` | integer |  optional  | número de vezes que a ficha deve ser executada
    
<!-- END_15961bf6f21defc4b4433721c0a07c01 -->

#Equipment


Equipamentos cadastrados
<!-- START_12a211602c23da463598adc31c06a157 -->
## Listagem de equipamentos

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os equipamentos públicos cadastrados em ordem albafética

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/equipment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/equipment"
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
            "id": 2,
            "name": "BANCO RECLINÁVEL"
        },
        {
            "id": 3,
            "name": "BOX JUMP"
        }
    ]
}
```

### HTTP Request
`GET api/v1/equipment`


<!-- END_12a211602c23da463598adc31c06a157 -->

#Exercise


Gerenciamento de exercícios
<!-- START_c8b2c3e4ea3ea06882f95382630b28af -->
## Listagem de exercícios

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os exercícios públicos e privados (cadastrados pelo usuário)

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/exercise" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/exercise"
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
null
```

### HTTP Request
`GET api/v1/exercise`


<!-- END_c8b2c3e4ea3ea06882f95382630b28af -->

<!-- START_2834144fec25709e2991bacc1715991d -->
## Listagem de tipos de exercícios

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista as grupos de exercícios possíveis

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/exercise/group-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/exercise/group-type"
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
        "TRADICIONAL",
        "BI-SET",
        "TRI-SET",
        "DROP-SET",
        "TEXTO LIVRE"
    ]
}
```

### HTTP Request
`GET api/v1/exercise/group-type`


<!-- END_2834144fec25709e2991bacc1715991d -->

<!-- START_2f0381ce5d17640da2edd80932a485a8 -->
## Listagem de tipos de repetições

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os tipos de repetições para os exercícios

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/exercise/repetition-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/exercise/repetition-type"
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
        "REPETIÇÕES",
        "MINUTOS",
        "SEGUNDOS"
    ]
}
```

### HTTP Request
`GET api/v1/exercise/repetition-type`


<!-- END_2f0381ce5d17640da2edd80932a485a8 -->

<!-- START_28f8623f2716b4f0b8ccb01c27564ad0 -->
## Listagem de tipos de pesos

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os tipos de pesos a serem usados nos exercícios

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/exercise/charge-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/exercise/charge-type"
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
        "KILO",
        "LIBRA",
        "PESO",
        "POR CENTO"
    ]
}
```

### HTTP Request
`GET api/v1/exercise/charge-type`


<!-- END_28f8623f2716b4f0b8ccb01c27564ad0 -->

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
    -d '{"category":"exercitationem"}'

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
    "category": "exercitationem"
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
    "http://127.0.0.1:8000/api/v1/file/1?id=est" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/file/1"
);

let params = {
    "id": "est",
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
    `id` |  required  | O ID do documento a ser removido.

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

#Muscle-Groups


Grupos musculares cadastrados
<!-- START_69fc910fb27dd32e65af3b839199a617 -->
## Listagem de grupos musculares

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Lista os grupos musculares públicos cadastrados em ordem albafética

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/v1/muscle-group" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/muscle-group"
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
            "id": 6,
            "name": "ABDOMINAL"
        },
        {
            "id": 2,
            "name": "BÍCEPS"
        }
    ]
}
```

### HTTP Request
`GET api/v1/muscle-group`


<!-- END_69fc910fb27dd32e65af3b839199a617 -->

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
    -d '{"name":"Matheus","cpf":"12345678980","cnpj":"73942003000118","phone":"19991501844","media_facebook":"https:\/\/facebook.com\/professor","media_instagram":"@linchester","media_whatsapp":"19991501844","terms_use":"aliquam","genre":"at","dt_born":"01\/01\/1970"}'

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
    "terms_use": "aliquam",
    "genre": "at",
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
    -d '{"id_student":0,"type_student":"P","type_contract":"T","status":"error","notes":"Aluno antigo da escola","id_required_anamnesis":11}'

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
    "status": "error",
    "notes": "Aluno antigo da escola",
    "id_required_anamnesis": 11
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

#Train


Gerenciamento de treinos
<!-- START_42a9b4fe5a27ccffaf2cb62a5bc42bf8 -->
## Adiciona um treino

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Cadastra um treino a um ID de ficha existente. Exemplo de JSON na requisição:
{
       "id_card": 1,
       "name": "A",
       "break": 120,
       "exercise_groups": [
           {
               "type": "TRADICIONAL",
               "order": 1,
               "detail": [
                   {
                       "id_exercise": 1,
                       "id_equipment": 1,
                       "url": null,
                       "repetition_type": "REPETIÇÕES",
                       "charge_type": "KILO",
                       "series_interval": 60,
                       "notes": null,
                       "series": [
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 1
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 2
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 3
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 4
                           }
                       ]
                   }
               ]
           },
           {
               "type": "BI-SET",
               "order": 2,
               "detail": [
                   {
                       "id_exercise": 2,
                       "id_equipment": 1,
                       "url": null,
                       "repetition_type": "REPETIÇÕES",
                       "charge_type": "KILO",
                       "series_interval": 60,
                       "notes": null,
                       "series": [
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 1
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 2
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 3
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 4
                           }
                       ]
                   },
                   {
                       "id_exercise": 3,
                       "id_equipment": 1,
                       "url": null,
                       "repetition_type": "REPETIÇÕES",
                       "charge_type": "KILO",
                       "series_interval": 60,
                       "notes": null,
                       "series": [
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 1
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 2
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 3
                           },
                           {
                               "charge": 30,
                               "repetition": 12,
                               "order": 4
                           }
                       ]
                   }
               ]
           }
       ]
   }

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/v1/train" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"id_card":123,"name":"A","break":120,"exercise_groups":{"type":"BI-SET","order":"1","detail":{"id_exercise":10,"id_equipment":2,"url":"https:\/\/youtub\/*e.com.br\/Hkh6RF2F1","repetition_type":"REPETI\u00c7\u00d5ES","charge_type":"KILO","series_interval":15,"notes":"Executar at\u00e9 a falha","series":[],"charge":20,"repetition":12,"order":1}}}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/v1/train"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "id_card": 123,
    "name": "A",
    "break": 120,
    "exercise_groups": {
        "type": "BI-SET",
        "order": "1",
        "detail": {
            "id_exercise": 10,
            "id_equipment": 2,
            "url": "https:\/\/youtub\/*e.com.br\/Hkh6RF2F1",
            "repetition_type": "REPETI\u00c7\u00d5ES",
            "charge_type": "KILO",
            "series_interval": 15,
            "notes": "Executar at\u00e9 a falha",
            "series": [],
            "charge": 20,
            "repetition": 12,
            "order": 1
        }
    }
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
`POST api/v1/train`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id_card` | integer |  required  | ID da ficha.
        `name` | string |  required  | Nome do treino.
        `break` | integer |  required  | Tempo em segundos para descanso entre exercícios.
        `exercise_groups` | array |  required  | Array de objetos JSON que conterá os exercícios
        `exercise_groups.type` | string |  required  | Tipos de grupos de exercícios. Ver em exercise/group-type
        `exercise_groups.order` | required |  optional  | integer Ordenação dos exercícios.
        `exercise_groups.detail` | array |  required  | Array de objetos JSON com os detalhes do(s) exercício(s).
        `exercise_groups.detail.id_exercise` | integer |  required  | ID do exercício.
        `exercise_groups.detail.id_equipment` | integer |  required  | ID do equipamento.
        `exercise_groups.detail.url` | string |  optional  | URL do vídeo exemplo.
        `exercise_groups.detail.repetition_type` | string |  required  | Tipo das repetições. Ver em exercise/repetition-type.
        `exercise_groups.detail.charge_type` | string |  required  | Tipo de peso utilizado. Ver em exercise/charge-type.
        `exercise_groups.detail.series_interval` | integer |  required  | Array de objetos JSON com os detalhes do(s) exercício(s).
        `exercise_groups.detail.notes` | string |  optional  | Observações opcionais.
        `exercise_groups.detail.series` | array |  required  | Array de objetos JSON com os detalhes da series.
        `exercise_groups.detail.charge` | integer |  required  | Numéro do peso recomendado.
        `exercise_groups.detail.repetition` | integer |  required  | Número de repetições da serie.
        `exercise_groups.detail.order` | integer |  required  | Ordenação das repetições.
    
<!-- END_42a9b4fe5a27ccffaf2cb62a5bc42bf8 -->

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
    -d '{"name":"Matheus","email":"contato@octopusfit.com.br","password":"123!abc","cpf":"12345678980","cnpj":"et"}'

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
    "cnpj": "et"
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


