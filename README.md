# SistemaEscolar
Este projeto trata-se de uma referencia de projeto pessoal presente em meu currículo, seu intuito é aplicar os principais conceitos do framework [Laravel](https://laravel.com) e técnicas de desenvolvimento web afim de fortificar o conhecimento adquirido.


![gif do projeto](https://media.giphy.com/media/hXPFAvqNgSboZscaqU/giphy.gif)

![gif 2 do projeto](https://media.giphy.com/media/H5oTMSQxzVBO1BsnA4/giphy.gif)

# Passos a passo

## 1º Clonar projeto

Na aba principal do projeto procure pelo botão com o nome de ‘code’ em seguida copie o https fornecido.
Em seguida escolha o local onde você deseja clonar o projeto, nessa pasta utilize o seguinte comando:

`git clone {a chave que você copiou}`

## 2º Composer install

Na mesma pasta em que o projeto foi clonado rode o comando `composer install` para gerar as dependências do arquivo vendor.

## 3º Mudar .env.example para .env

E em seguida coloque as devidas configurações no arquivo .env.

## 4º Gerar nova key de projeto

Ao renomear o arquivo .env-example, sera necessário rodar o comando `php artisan key:generate`.

## 5º Banco de Dados

Rode o comando `php artisan migrate` no terminal do projeto para gerar as tabelas necessárias. 

## 6º Observações

> Note que o projeto utiliza 3 níveis de acesso , Aluno, Professor, Admin ou seja será necessário antes de rodar o projeto no ambiente de desenvolvimento a inserção dessas 3 roles na tabela role.

> Para definir o nível de acesso “Admin” a um usuário, terá que ser alterado manualmente a pivot table relativa `role_user` no sgbd preferencial.
