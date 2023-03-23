<?php
    # recuperar_senha_escolher.php
    require('twig_carregar.php');
    require('pdo.inc.php');

    $token = $_GET['token'] ?? $_POST['token'] ?? false;

    if (!$token) {
        header('location:login.php');
        die;
    }

    // Rotina de POST - Recuperar senha
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $password = $_POST['senha'] ?? false;
        $password = trim($password);
        // Tratamento para o caso de senha falsa
        // ....
        
        $sql = $pdo->prepare('UPDATE usuarios SET senha = :senha, recupera_token = NULL WHERE recupera_token = :token');
        $sql->execute([
            ':senha' => password_hash($password, PASSWORD_BCRYPT),
            ':token' => $token,
        ]);

        header('location:login.php?erro=3');

        die;
    }

    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE recupera_token = ?');
    $sql->execute([$token]);

    if ($sql->rowCount() == 1) {
        echo $twig->render('recuperar_senha_escolher.html', ['token' => $token]);
    } else {
        header('location:login.php');
        die;
    }