<?php
$perfil_exigido = 'admin';

require_once __DIR__ . '/../app/verifica_sessao.php';
require_once __DIR__ . '/../app/config.php';

$usuario_exib = htmlspecialchars($_SESSION['usuario_nome'] ?? 'Admin', ENT_QUOTES, 'UTF-8');

$lista_usuarios = [];

if($_SESSION['perfil'] === 'admin') {
    try {
        $pdo=conectar_banco();
        $stmt = $pdo->query('SELECT id, nome, email, perfil FROM usuarios ORDER BY nome ASC');
        $lista_usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao buscar usuários: ". $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="tela-inicialadmin">
    <h1>Bem-vindo, <?= $usuario_exib ?></h1>
    
    <?php if (!empty($_SESSION['flash_sucesso'])): ?>

        <div style="color:green">
            <?= htmlspecialchars($_SESSION['flash_sucesso'])?>
        </div>

        <?php unset($_SESSION['flash_sucesso']); ?>

        <?php endif; ?>
    <?php if ($_SESSION['perfil'] === 'admin'): ?>
        <hr>
        <h2>Gerenciamento de usuários</h2>

        <form action="" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil Atual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['id'] ?> </td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= ucfirst($usuario['perfil']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </form>
        <?php endif ?>
        <p><a href="../app/logout.php", class="btn-sairadmin">Sair</a></p>
        </div>
</body>
</html>
