ncurtador de URL - Documentação
1. Descrição
Este é um projeto de encurtador de URLs simples, desenvolvido em PHP + MySQL, permitindo gerar links curtos para URLs longas e realizar o redirecionamento automaticamente.

O projeto é ideal para estudo e prática de PHP, MySQL, organização de código e conceitos de URL shortener.

2. Estrutura do Projeto
index.php: página principal onde o usuário insere a URL para encurtar.

redirect.php: redireciona o usuário para a URL original quando acessa o slug.

database.sql: script para criação do banco de dados e da tabela urls.

README.md: documentação do projeto.

includes/config.php: configuração do banco de dados.

includes/functions.php: funções auxiliares do sistema.

3. Funcionamento
O usuário insere uma URL longa em index.php.

O sistema gera um slug (código curto) e salva no banco de dados junto com a URL original.

O usuário recebe o link encurtado.

Quando alguém acessa o link encurtado, redirect.php busca o slug no banco e redireciona automaticamente para a URL original.

4. Requisitos
PHP 7.4 ou superior

MySQL 5.7 ou superior

Servidor web Apache ou Nginx

5. Instalação
Instale XAMPP, Laragon ou outro servidor local com PHP e MySQL.

Clone ou baixe este repositório.

Importe database.sql no seu banco de dados MySQL.

Configure includes/config.php com as credenciais do banco de dados.

Coloque os arquivos em htdocs (XAMPP) ou www (Laragon).

Acesse no navegador: http://localhost/pasta_do_projeto.

6. Melhorias para adcionar
Migrar de mysqli para PDO com prepared statements para evitar SQL Injection.

Sanitizar e validar URLs antes de salvar no banco.

Implementar contador de cliques no link encurtado.

Permitir personalização do slug pelo usuário.

Adicionar opção de expiração de links por data ou por quantidade de cliques.

Criar sistema de cadastro e login de usuários para gerenciar os links.

Criar interface mais limpa e responsiva utilizando Bootstrap ou Tailwind.

Adicionar API REST para criação e consulta de links de forma programática.

Criar logs de acesso e relatórios de analytics básicos (quantidade de cliques por link).

Preparar para deployment utilizando Docker e docker-compose.

Criar página de erro 404 personalizada.

Melhorar a organização do código e separar as responsabilidades em arquivos distintos.
