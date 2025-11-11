<?php
$perfil_exigido = 'admin';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/verifica_sessao.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
<<<<<<< HEAD
    redirecionar('../public/dashboard');
=======
    redirecionar('../public/dashboard.php');
>>>>>>> 1c54e78bfd508d4a82c4db8c4c61057e55f93471
}

$id = $_POST['id'] ?? 0;
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ??'');
<<<<<<< HEAD
$senha = trim($_POST['senha'] ??'');
$perfil = $_post['perfil'] ?? 'user';
=======
$perfil = $_POST['perfil'] ?? 'user';
>>>>>>> 1c54e78bfd508d4a82c4db8c4c61057e55f93471

if (empty($id) || empty($nome) || empty($email)) {
    $_SESSION['flash_erro'] = 'Dados inválidos.';
    redirecionar('../public/dashboard.php');
}

<<<<<<< HEAD
if($id == $_SESSION['usuario_id'] && $perfil = 'user') {
    $_SESSION['flash_erro'] = 'Você não pode remover seu status de administrador.';
    redirecionar('../public/editar_usuario.php');
=======
if($id == $_SESSION['usuario_id'] && $perfil == 'user') {
    $_SESSION['flash_erro'] = 'Você não pode remover seu status de administrador.';
    redirecionar('../public/editar_usuario.php?id=' . $id);
>>>>>>> 1c54e78bfd508d4a82c4db8c4c61057e55f93471
}

$pdo = conectar_banco();

try {
   $sql = "UPDATE usuarios SET nome = ?, email = ?, perfil = ? WHERE id = ?";
   $stmt = $pdo->prepare($sql);
<<<<<<< HEAD
   $stmt->execute([$nome, $email, $perfil, $id]);

   $_SESSION['flash_sucesso'] = "Usuário atualizado com sucesso!";
=======

    if($stmt->execute([$nome, $email, $perfil, $id])) {
   $_SESSION['flash_sucesso'] = "Usuário atualizado com sucesso!";
    } else {
        $_SESSION['flash_erro'] = 'Ocorreu uma falha ao executar a atualização.';
        redirecionar('../public/editar_usuario.php?id='. $id);
    }
>>>>>>> 1c54e78bfd508d4a82c4db8c4c61057e55f93471

} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062) {
        $_SESSION['flash_erro'] = 'Este email já está em uso por outra conta.';
        redirecionar('../public/editar_usuario.php?id='. $id);
    } else {
<<<<<<< HEAD
        $_SESSION['flash_erro'] = 'Erro ao atualizar usuário.';
    }   
}
redirecionar('../public/dashboard.php');
?>
=======
        $_SESSION['flash_erro'] = 'Erro ao atualizar usuário: '. $e->getMessage();
        redirecionar('../public/editar_usuario.php?id='. $id);
    }   
}
redirecionar('../public/dashboard.php');

>>>>>>> 1c54e78bfd508d4a82c4db8c4c61057e55f93471
