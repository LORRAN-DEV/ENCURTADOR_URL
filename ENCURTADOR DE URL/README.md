# Encurtador de URL

Sistema simples e funcional para encurtar URLs, desenvolvido com PHP e MySQL.

## Funcionalidades
- Encurtamento de URLs longas
- Personalização do slug (final do link)
- Interface responsiva e moderna (Mobile First)
- Listagem de links encurtados
- Redirecionamento automático

## Requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

## Instalação
1. Clone este repositório
2. Importe o arquivo `database.sql` no seu MySQL
3. Configure as credenciais do banco de dados no arquivo `config.php`
4. Inicie seu servidor web apontando para o diretório do projeto

## Estrutura do Projeto
```
├── assets/
│   ├── css/
│   └── js/
├── includes/
│   ├── config.php
│   └── functions.php
├── index.php
├── redirect.php
└── database.sql
```
