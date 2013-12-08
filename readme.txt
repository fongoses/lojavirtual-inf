SMART TICKET
Loja Virtual para o Comércio de Tickets

GRUPO:
* Lucas Herbert Jones
* Luiz Gustavo Frozi de Castro e Souza
* Mário Cesar Gasparoni Jr.

DESCRIÇÃO:
* Sistema de Loja Virtual para comercializar Tickets
* Permite a Compra e Venda de tickets via internet

CARACTERÍSTICAS:
* Arquitetura MVC
* Plataforma: 
    * Front-end: WEB (HTML5, CSS3, JAVASCRIPT)
    * Back-end: PHP, Apache, MySQL

PRÉ-REQUISITOS:
* Servidor Web Apache 2.x (ou superior)
* Servidor de Banco de Dados MySQL 5.5.x (ou superior)
* PHP 5.4.x (ou superior) com suporte à MySQL e DBO

CONFIGURAÇÃO DA BASE DE DADOS
* Os modelos e o script de criação da base então na pasta "db/"
* Para ver os modelos deve-se usar a ferramenta MySQL Workbench, 
disponível no site do MySQL ou em repositórios do linux (Debian/Ubuntu).
* Configuração:
    1. Criar uma base de dados chamada "lojavirtual"
    2. Executar o script "db/db.sql" para criar as tabelas com os dados
    de inicialização
    3. Criar um usuário chamado "usuarioweb" com a senha "12345678" e dar
    direitos de select, insert, update, delete na base "lojavirtual"

CONFIGURAÇÃO DO SISTEMA WEB
* Os arquivos do sistema estão dentro do arquivo ".zip"
* Devem ser descompactados dentro de uma pasta "lojavirtual" no servidor, 
por exemplo, se o servidor for "localhost", o sistema deve ser acessado 
usando a url "http://localhost/lojavirtual/"
* Caso seja necessário alterar a configuração da Base de Dados e o Usuário,
deve-se alterar essas configurações no arquivo "model/infodb/datadb.inc"

DOCUMENTAÇÃO ADICIONAL
* A documentação adicional encontra-se na pasta "doc/" do arquivo compactado.
