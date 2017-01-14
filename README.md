# API de Contato

## Configurações
1. criar um vhost
```
<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/busca.local"
    ServerName busca.local
    ErrorLog "logs/busca_local-error.log"
    CustomLog "logs/busca_local-access.log" common
</VirtualHost>
```
2. redirecionar o hosts
    * C:\Windows\System32\drivers\etc\hosts
    * 127.0.0.1	busca.local
3. testar URL
    * Chamar a url "busca.local" e validar se retorna o seguinte texto:
```
Contatos
Autor: Caio Santos
Email: santoscaio@gmail.com
```

## Endpoints (*CRUD de contato*)
- Todos os retornos são respondidos em HTTP mais a informação em JSON
- Atualmente uso o postman para consumo e teste de api's
- Buscar vaga com palavra chave
    - Busca uma vaga no JSON
    - method: **GET**
    - http://busca.local/vaga/[KEYWORD]
    - Campo obrigatório: **[KEYWORD]** => Filtro no titulo ou descrição
    - Retorno: **dados da vaga(s)**
- Buscar vaga com palavra chave e ordenação
    - Busca uma vaga no JSON
    - method: **GET**
    - http://busca.local/vaga/[KEYWORD]/[ORDER]
    - Campo obrigatório: **[KEYWORD]** => Filtro no titulo ou descrição
    - Campo obrigatório: **[ORDER]** => Ordenação por valor do salário
    - Retorno: **dados da vaga(s)**
- Buscar vaga com palavra chave, ordenação e cidade
    - Busca uma vaga no JSON
    - method: **GET**
    - http://busca.local/vaga/[KEYWORD]/[ORDER]/[CITY]
    - Campo obrigatório: **[KEYWORD]** => Filtro no titulo ou descrição
    - Campo obrigatório: **[ORDER]** => Ordenação por valor do salário
    - Campo obrigatório: **[CITY]** => Filtra os resultados da busca pela cidade
    - Retorno: **dados da vaga(s)**

# Extra Documentation
## Semantics and Content of HTTP
https://tools.ietf.org/html/rfc7231

## List of HTTP status codes
https://en.wikipedia.org/wiki/List_of_HTTP_status_codes


# Lumen PHP Framework
## Official Documentation
Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

## License
The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
