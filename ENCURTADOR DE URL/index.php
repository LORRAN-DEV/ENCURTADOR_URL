<?php
require_once 'includes/functions.php';

// Verifica se é uma URL curta
$request_uri = trim($_SERVER['REQUEST_URI'], '/');
if ($request_uri && $request_uri != 'index.php') {
    require_once 'redirect.php';
    exit;
}

// Processa o formulário
$message = '';
$generated_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $original_url = $_POST['url'] ?? '';
    $custom_slug = $_POST['custom_slug'] ?? '';
    
    $result = createShortUrl($original_url, $custom_slug);
    
    if (isset($result['error'])) {
        $message = '<div class="alert alert-danger">' . $result['error'] . '</div>';
    } elseif (isset($result['success'])) {
        $generated_url = $result['short_url'];
        $message = '<div class="alert alert-success">
            <p class="mb-2">URL encurtada com sucesso!</p>
            <div class="input-group">
                <input type="text" class="form-control" value="' . $generated_url . '" id="shortUrl" readonly>
                <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard()">Copiar</button>
            </div>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encurtador de URLs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">Encurtador de URLs</h1>
                        
                        <?php if ($message): ?>
                            <?php echo $message; ?>
                        <?php endif; ?>
                        
                        <form method="POST" action="" class="mb-4">
                            <div class="mb-3">
                                <label for="url" class="form-label">URL Original</label>
                                <input type="url" class="form-control" id="url" name="url" 
                                       placeholder="Cole sua URL aqui" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="custom_slug" class="form-label">Slug Personalizado (opcional)</label>
                                <input type="text" class="form-control" id="custom_slug" name="custom_slug" 
                                       placeholder="exemplo: minha-url">
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Encurtar URL</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function copyToClipboard() {
        var copyText = document.getElementById("shortUrl");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        
        var button = copyText.nextElementSibling;
        button.innerHTML = "Copiado!";
        button.classList.remove("btn-outline-primary");
        button.classList.add("btn-success");
        
        setTimeout(function() {
            button.innerHTML = "Copiar";
            button.classList.remove("btn-success");
            button.classList.add("btn-outline-primary");
        }, 2000);
    }
    </script>
</body>
</html>
