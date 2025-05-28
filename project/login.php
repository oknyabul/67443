<?php
    header('Content-Type: text/html; charset=UTF-8');
    session_start();
    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        session_destroy();
        header('Location: login.php');
        exit();
    }
    if (!empty($_SESSION['login']))
    {
        header('Location: ./');
        exit();
    }

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require('database.php');
        $login = $_POST['login'];
        $password = md5($_POST['password']);
        try
        {
            $stmt = $db->prepare("SELECT u.id, u.application_id FROM users u WHERE u.login = ? AND u.pass_hash = ?");
            $stmt->execute([$login, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if($user)
            {
                $_SESSION['login'] = $login;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['application_id'] = $user['application_id'];
                header('Location: ./');
            }
            else
                $error = 'Неверный логин или пароль';
        }
        catch(PDOException $e)
        {
            print('Error : ' . $e->getMessage());
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <title>Задание_8</title>
</head>
<body>
    <form action="" method="post" class="form">
        <div class="mess" style="color: red;"><?php echo $error; ?></div>
        <h2>Вход в форму</h2>
        <div> <input class="input" style="width: 100%;" type="text" name="login" placeholder="Логин"> </div>
        <div> <input class="input" style="width: 100%;" type="password" name="password" placeholder="Пароль"> </div>
        <button class="button" type="submit">Войти</button>
    </form>
</body>
</html>