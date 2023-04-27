<?php
    # usuario_atualizar.php
    require('models/Model.php');
    require('models/Usuario.php');

    $id = $_POST['id'] ?? false;
    $nome = $_POST['nome'] ?? false;
    $email = $_POST['email'] ?? false;
    $username = $_POST['username'] ?? false;

    if (!$id || !$nome || !$email || !$username) {
        // Não mostra erro na tela
        // O usuário que aprenda a preencher os campos
        die;
    }

    $usr = new Usuario();
    $usr->update([
        'nome' => $nome,
        'email' => $email,
        'username' => $username,
    ], $id);
    header('location:/usuarios');
    die;