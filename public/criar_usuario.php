<?php
$perfil_exigido = 'admin';
require_once __DIR__ . '/../app/verifica_sessao.php';
require_once __DIR__ . '/../app/config.php';
?>

<!DOCTYPE html>
<html lang = "pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar usuário</title>
</head>
<body>
    <h2>Adicionar Novo usuário</h2>
    <form action="../app/salvar_usuario.php" method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required> <br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required> <br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required> <br><br>

        <label>Perfil:</label><br>
        <select name="perfil">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select> <br><br>

        <button type="submit">Salvar usuário</button>
        <a href="dashboard.php">Cancelar</a>
    </form>
</body>
</html>

