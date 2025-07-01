<?php
if (!defined('BASE_URL')) {
    require_once 'includes/functions.php';
}

// Pega o slug da URL
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
$slug = explode('/', $request_uri);
$slug = end($slug);

if (empty($slug)) {
    header('Location: ' . BASE_URL);
    exit;
}

// Busca a URL original
$original_url = getOriginalUrl($slug);

if ($original_url) {
    // Atualiza o contador de cliques
    $pdo->prepare("UPDATE urls SET clicks = clicks + 1 WHERE slug = ?")->execute([$slug]);
    
    // Redireciona para a URL original
    header('Location: ' . $original_url);
    exit;
} else {
    // URL não encontrada
    header('HTTP/1.0 404 Not Found');
    echo '<!DOCTYPE html>
          <html>
          <head>
              <title>Link não encontrado</title>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          </head>
          <body class="bg-light">
              <div class="container py-5 text-center">
                  <h1>404 - Link não encontrado</h1>
                  <p>O link que você está tentando acessar não existe.</p>
                  <a href="' . BASE_URL . '" class="btn btn-primary">Voltar para a página inicial</a>
              </div>
          </body>
          </html>';
    exit;
}
