<?php
require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../app/verifica_sessao.php';

$usuario_exib = htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuario', ENT_QUOTES, 'UTF-8');


$id = $_SESSION['usuario_id'] ??'';

$pdo = conectar_banco();

$stmt= $pdo->prepare('SELECT name, email FROM usuarios WHERE id = ?');
$stmt->execute([$id]);

$usuario = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
</head>
<body>
    <h1>Bem vindo, <?= $usuario_exib ?>!</h1>

    <form action="../app/atualizar_meu_perfil.php" method="POST">
        <label for="nome">Nome: </label>
        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>">

        <label for="email">Email: </label>
        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email'])?>">

        <button type="submit">Confirmar</button>
    </form>
    
</body>
</html>