<?php
require_once __DIR__ . '/../app/config.php';

$erro = $_SESSION['flash_erro'] ?? '';
$sucesso = $_SESSION['flash_sucesso'] ?? '';
unset($_SESSION['flash_erro'], $_SESSION['flash_sucesso']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if($erro) : ?>
        <div style = "color:red"><?= htmlspecialchars($erro)?></div>
    <?php endif; ?>

    <?php if($sucesso) : ?>
        <div style = "color:green"><?= htmlspecialchars($sucesso)?></div>
        <?php endif; ?>

<form action="autentica.php" method="post" autocomplete="off">
    <label for="email">E-mail: </label><br>
    <input type="email" name="email" id="email" required><br><br>

    <label for="senha">Senha: </label><br>
    <input type="password" name="senha" id="senha" required><br><br>

    <button type="submit">Entrar</button>

    <p>Ainda não tem conta?</p>
<a href="registro.php">
    <button type="button">Registre-se</button>
</a>
</form>
</body>
</html>