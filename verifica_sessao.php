<?php
require_once 'config.php';

if(empty($_SESSION['usuario'])) {
    $_SESSION['flash_erro'] = 'Acesso restrito: faça login para continuar.';
    header('Location: index.php');
    exit;
}

if(isset($perfil_exigido) && $_SESSION['perfil'] !== $perfil_exigido) {
    header('Location: sem_permissao.php');
    exit;
}
?>