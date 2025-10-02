<?php
$perfil_exigido = 'admin';

require_once 'verifica_sessao.php';

$usuario_exib = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
     <style>
        Body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, gray, black);
        }
        .HomePage{
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: white;
        }
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        button{
            background-color: blue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }
        button:hover{
            background-color: dodgerblue;
        }
    </style>
</head>
<body>
    <div class="HomePage">
    <h1>Bem-vindo, <?= $usuario_exib ?></h1>
    
    <?php if (!empty($_SESSION['flash_sucesso'])): ?>
        <div style="color:green"><?= htmlspecialchars($_SESSION['flash_sucesso'])?></div>
        <?php unset($_SESSION['flash_sucesso']); ?>
        <?php endif; ?>
    
        <p><a href="logout.php">Sair</a></p>
        </div>
</body>
</html>