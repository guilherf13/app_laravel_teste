<div align="center" id="top"> 
  <img src="./.github/app.gif" alt="Ambiente_de_desenvolvimentos_scs" />

  &#xa0;

  <!-- <a href="https://ambiente_de_desenvolvimentos_scs.netlify.app">Demo</a> -->
</div>

<h1 align="center">Prova Desenvolvedor - Back-End Pleno</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  Ambiente_de_desenvolvimentos_scs 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/{{YOUR_GITHUB_USERNAME}}" target="_blank">Author</a>
</p>

<br>

## :dart: Sobre o Projeto ##

Desenvolver uma API de uma AGENDA TELEFÔNICA em PHP ou Laravel, fazendo uso de testes
automatizados capaz de cadastrar os itens listados no documento.

## :rocket: Tecnologias ultilizadas ##

Ferramentas ultilizadas no projeto:

- [Laravel](https://laravel.com/docs/10.x)
- [Mysql](https://www.mysql.com/)
- [Docker](https://www.docker.com/)
- [MailHog](https://hub.docker.com/r/mailhog/mailhog/)

## :white_check_mark: Requirements ##

Para rodar o projeto, você vai precisar do docker [Docker](https://www.docker.com/).

## :checkered_flag: Subindo o ambiente de desenvolvimento ##

```bash
# Clone o projeto
$ git clone https://github.com/guilherf13/SCS_DevOps

# Executando o ambiente

$ cd app_laravel_teste
$ cd backend
$ cp .env.example .env
$ cd ../../
$ sudo chmod -R 777 app_laravel_teste
$ cd app_laravel_teste
$ docker compose up -d --build
$ docker exec -it backend composer install
$ docker exec -it backend php artisan key:generate
$ docker exec -it backend php artisan migrate

# Executando os testes

$ docker exec -it backend php artisan test --filter ScheduleTest

# A aplicação esta rodando nas seguintes rotas:

# laravel <http://localhost:80>
# meilhog (http://localhost:8025>
# mysql port 3306
```
## Documentação das APIs

```http
  POST /login
```
#### Retorna um objeto json contendo uma mensagem .

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `json string` | *Obrigatório*. É o email do user |
| `password` | `json string ` | Obrigatório. É o senha do user|
|  **Rota:** |URL http://localhost:80/api/mail-reset |
|  **Formato:** |{"email": "teste@gmail.com", "password": 12345678} |

```http
  POST /register
```
#### Cria um novo user e retorna a mensagem "Usuario registrado com sucesso!". 

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `json string` | Obrigatório. O nome do user |
| `email`     | `json string` | Obrigatório. O email do user |
| `password`  | `json string` | Obrigatório. A senha do user |
| **Rota:**   | URL http://localhost:80/api/register  |
| **Formato:** | {"name":"nameTeste, "email":"emailTeste@hotmail.com, "password":12345678} |

```http
  POST /send-email-validate
```
#### Envia um formulario com o link de redefinição de senha para o email do user informado.
#### retorna uma mensagem com testo: 'E-mail de redefinição de senha enviado com sucesso'.

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `email`     | `json string` | Obrigatório. O email do user |
| **Rota:**   | URL http://localhost:80/api/send-email-validate |
| **Formato:** | {"email":"emailTeste@hotmail.com} |

```http
  DELETE /delete-user/{id}
```
#### Deleta o user pelo id informado.

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`| `Parâmetro GET` | Obrigatório. O id do user|
| **Rota:**   | URL http://localhost:80/api/delete-user/{id} |
| **Formato:** | /delete-user/{1} |

```http
  POST /schedules
```
#### Criação de um registro

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`| `string` | Obrigatório. O name do user|
| `email`| `string` | Obrigatório. O email do user|
| `date_of_birth`| `string` | Obrigatório. O data de nascimento do user|
| `cpf`| `string` | Obrigatório. O cpf do user|
| `phone`| `string` | Obrigatório. O phone do user|
| **Rota:**   | URL http://localhost:80/api/schedules|
| **Formato:** | 
  {
    "name": "Exemplo de Nome", 
    "email": "exemplo@email.com",
    "date_of_birth": "1990-01-01", 
    "cpf": "12345678900", 
    "phone": "1122334455"
  }|

```http
  PUT /schedules{id}
```
#### Atualização de uma agenda

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`| `string` | O name do user|
| `email`| `string` | O email do user|
| `date_of_birth`| `string` | Obrigatório. O data de nascimento do user|
| `cpf`| `string` | O cpf do user|
| `phone`| `string` | O phone do user|
| **Rota:**   | URL http://localhost:80/api/schedules/{id}
| **Formato:** | 
  {
    "name": "Exemplo de Nome", 
    "email": "exemplo@email.com",
    "date_of_birth": "1990-01-01", 
    "cpf": "12345678900", 
    "phone": "1122334455"
  }|

```http
  DELETE /schedules{id}
```
#### Exclui um registro da agenda

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`| `string` | O id da agenda|
| **Rota:**   | URL http://localhost:80/api/schedules/{id}
| **Formato:** | http://localhost:80/api/schedules/{id}

```http
  GET /schedules
```
#### Retorna todos os registro da agenda

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| **Rota:**   | URL http://localhost:80/api/schedules
| **Formato:** | http://localhost:80/api/schedules

```http
  GET /schedules/report
```
#### Retorna um relatorio de todos os nomes da agenda paginados por 10 itens

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| **Rota:**   | URL http://localhost:80/api/schedules/report
| **Formato:** | http://localhost:80/api/schedules/report

## :memo: License ##

This project is under license from MIT. For more details, see the [LICENSE](LICENSE.md) file.


Made with :heart: by <a href="https://github.com/guilherf13" target="_blank">{{guilherme}}</a>

&#xa0;

<a href="#top">Back to top</a>
