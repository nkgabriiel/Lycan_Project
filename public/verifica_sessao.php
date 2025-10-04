<?php
require_once __DIR__ . '/../app/config.php';

if(empty($_SESSION['usuario_id'])) {
    $_SESSION['flash_erro'] = 'Acesso restrito: faça login para continuar.';
    redirecionar('index.php');
    exit;
}

if(isset($perfil_exigido) && $_SESSION['perfil'] !== $perfil_exigido) {
    redirecionar('sem_permissao.php');
    exit;
}
?>