<?php
require_once 'config.php';

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
    <style>
        Body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, gray, black);
        }
        .tela-login{
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
    <div class="tela-login">
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
    </div>
</form>
</body>
</html>