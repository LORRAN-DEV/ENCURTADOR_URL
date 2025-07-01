<?php
require_once 'config.php';

/**
 * Gera um slug aleatório se não for fornecido um personalizado
 */
function generateSlug($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $slug = '';
    for ($i = 0; $i < $length; $i++) {
        $slug .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $slug;
}

/**
 * Verifica se o slug já existe no banco de dados
 */
function slugExists($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM urls WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetchColumn() > 0;
}

/**
 * Cria um novo link encurtado
 */
function createShortUrl($original_url, $custom_slug = '') {
    global $pdo;
    
    // Valida a URL
    if (!filter_var($original_url, FILTER_VALIDATE_URL)) {
        return ['error' => 'URL inválida'];
    }
    
    // Gera ou usa o slug personalizado
    $slug = empty($custom_slug) ? generateSlug() : $custom_slug;
    
    // Verifica se o slug personalizado já existe
    if (!empty($custom_slug) && slugExists($slug)) {
        return ['error' => 'Este slug personalizado já está em uso'];
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO urls (original_url, slug, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$original_url, $slug]);
        return [
            'success' => true,
            'short_url' => BASE_URL . $slug
        ];
    } catch (PDOException $e) {
        return ['error' => 'Erro ao criar URL curta'];
    }
}

/**
 * Obtém a URL original a partir do slug
 */
function getOriginalUrl($slug) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT original_url FROM urls WHERE slug = ?");
    $stmt->execute([$slug]);
    return $stmt->fetchColumn();
}

/**
 * Lista todos os links encurtados
 */
function getAllUrls() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM urls ORDER BY created_at DESC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
