<?php
// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_USER', 'seu-user');
define('DB_PASS', 'sua-senha');
define('DB_NAME', 'nome-do-seu-banco');

// Conexão com o banco de dados
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// URL base do sistema
$base_path = dirname($_SERVER['PHP_SELF']);
$base_path = $base_path == '/' ? '' : $base_path;
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $base_path . '/');
?>
