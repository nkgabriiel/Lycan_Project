<?php
if (session_status() === PHP_SESSION_NONE) session_start();

define('DB_HOST', 'localhost');
define('DB_NAME','sistema_auth');
define('DB_USER',   'root');
define('DB_PASS', '');

function conectar_banco() {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4";
    try {
        return new PDO ($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]);
    } catch (PDOException $e) {
        die("Erro de conexão: " . $e->getMessage());
}
}

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

    function redirecionar($url) {
        header("Location: $url");
        exit;
    }

    function sanitizar($string) {
        return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
    }

    function obterUserLogado() {
        return $_SESSION['usuario'] ?? null;
    }

    function validarForcaSenha($senha) {
        $erros = [];
         if(strlen($senha)<8) $erros[]='Senha com mínimo de 8 caracteres';
         if (!preg_match('/[A-Z]/',$senha)) $erros[]='Uma letra maiúscula';
         if (!preg_match('/[a-z]/',$senha)) $erros[]='Uma letra minúscula';
         if (!preg_match('/[0-9]/',$senha)) $erros[]='Um número';
         if (!preg_match('/[^A-Za-z0-9]/',$senha)) $erros[]='Um caractere especial';
    return ['valida'=>empty($erros),'erros'=>$erros];
    }

    $pdo = conectar_banco();

if(session_status() === PHP_SESSION_NONE) {
    
    ini_set('session.cookie.httponly', 1);
    ini_set('session.use.strict.mode', 1);
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
        ini_set('session.cookie.secure', 1);
    }
}
ob_end_flush();
?>