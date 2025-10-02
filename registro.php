<?php
require_once 'config.php';

if(isset($_SESSION['usuario'])) redirecionar('dashboard.php');

$erro = $_SESSION['flash_erro'] ?? '';
$sucesso = $_SESSION['flash_sucesso'] ?? '';
unset($_SESSION['flash_erro'], $_SESSION['flash_sucesso']);

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome_completo'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST ['senha'] ?? '';
    $confirma = $_POST['confirmar_senha'] ?? '';

    $_SESSION['form_data'] = [
        'nome_completo' => $nome_completo,
        'email' => $email
    ];


    $erros = [];

    if(!$nome || !$email || !$senha || !$confirma) $erros[] = 'Todos os campos são obrigatórios';
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) $erros[] = 'E-mail inválido.';

    if(empty($erros)) {
        $pdo = conectar_banco();
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email=: email LIMIT 1");
        $stmt->execute([':email =>$email']);
        if($stmt ->fetch()) $erros[] = 'E-mail já cadastrado';
    }

    if(empty($erros)) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdto->prepare ("INSERT INTO usuarios (email, senha_hash, nome_completo) VALUES (:email, :senha_hash, :nome");
        if($stmt->execute['flash_sucesso'] = 'Cadastro realizado! Faça login.');
        redirecionar('index.php');
    }else {
        $erros[] = 'Erro ao criar conta.';
    }
    if(!empty($erros)) $_SESSION['flash_erro'] = implode('<br>',$erros);
    redirecionar('registro.php');

    $validacao_senha = validarForcaSenha($senha);
    if(!$validacao_senha['valida']) {
        $erros =array_merge($erros, $validacao_senha['erros']);
    }
    
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
</head>
<body>
<h2>Cadastro</h2>
<?php if($erro) echo "<p style='color:red'>$erro</p>"; ?>
<?php if($sucesso) echo "<p style='color:green'>".sanitizar($sucesso)."</p>"; ?>

<form method="POST" action="registro.php">
<label>Nome: <input type="text" name="nome_completo"></label><br>
<label>E-mail: <input type="email" name="email"></label><br>
<label>Senha: <input type="password" name="senha"></label><br>
<label>Confirmar Senha: <input type="password" name="confirmar_senha"></label><br>
<button type="submit">Criar Conta</button>
</form>

<p>Já tem conta? <a href="index.php">Login</a></p>
</body>
</html>