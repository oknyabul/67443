<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

if (!empty($_SESSION['login'])) {
    // Пользователь уже авторизован, можно добавить выход
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: login.php');
        exit();
    }
    header('Location: index.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($login === '' || $pass === '') {
        $error = 'Введите логин и пароль';
    } else {
        try {
            $db = new PDO('mysql:host=localhost;dbname=u67443', 'u67443', '3234547', [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            $stmt = $db->prepare("SELECT * FROM users WHERE login = ?");
            $stmt->execute([$login]);
            $user = $stmt->fetch();

            if ($user && password_verify($pass, $user['pass_hash'])) {
                $_SESSION['login'] = $user['login'];
                $_SESSION['application_id'] = $user['application_id'];
                header('Location: index.php');
                exit();
            } else {
                $error = 'Неверный логин или пароль';
            }
        } catch (PDOException $e) {
            $error = 'Ошибка базы данных';
        }
    }
}

include('login_form.php');
