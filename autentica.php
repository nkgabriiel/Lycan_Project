<?php
require_once 'config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$max_falhas = 5;
if(!isset($_SESSION['falhas_login'])) {
    $_SESSION['falhas_login'] = 0;
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? null;

if (empty($email) || empty($senha)) {
    $_SESSION['flash_erro'] = 'Preencha e-mail e senha.';
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare('SELECT id, email, senha_hash, perfil FROM usuarios WHERE email = :email LIMIT 1');
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();
} catch (Exception $e) {
    $_SESSION ['flash_erro'] = 'Erro interno. Tente novamente';
    header('Location: index.php');
    exit;
}

if(!empty($_SESSION['falhas_login']) && $_SESSION['falhas_login'] >= $max_falhas) {
    $_SESSION['flash_erro'] = 'Muitas tentativas inválidas. Tente novamente mais tarde.';
    header('Location: index.php');
    exit;
}


if(!$user || !password_verify($senha, $user['senha_hash'])) {
    $_SESSION['falhas_login']++;
    $_SESSION['flash_erro'] = 'Credenciais inválidas.';
    header('Location: index.php');
    exit;
}

session_regenerate_id(true);

$_SESSION['usuario']   = $user['email'];
$_SESSION['usuario_id'] = $user['id'];
$_SESSION['perfil']    = $user['perfil'];

$_SESSION['falhas_login'] = 0;

$_SESSION['flash_sucesso'] = 'Login realizado com sucesso.';

redirecionar('dashboard.php');
?>