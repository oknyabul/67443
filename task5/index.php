<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

try {
    $db = new PDO('mysql:host=localhost;dbname=u67443', 'u67443', '3234547', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Ошибка подключения к базе данных: ' . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = [];
    $errors = [];
    $values = [];

    // Сообщения об успешном сохранении
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 100000);
        $messages[] = 'Спасибо, результаты сохранены.';

        if (!empty($_COOKIE['login']) && !empty($_COOKIE['pass'])) {
            $messages[] = sprintf(
                'Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong> и паролем <strong>%s</strong> для изменения данных.',
                htmlspecialchars($_COOKIE['login']),
                htmlspecialchars($_COOKIE['pass'])
            );
            setcookie('login', '', 100000);
            setcookie('pass', '', 100000);
        }
    }

    // Поля формы
    $fields = ['fio', 'phone', 'email', 'birth_date', 'gender', 'bio', 'agree'];

    // Проверка ошибок и загрузка значений из куки
    foreach ($fields as $field) {
        $errors[$field] = !empty($_COOKIE[$field.'_error']);
        if ($errors[$field]) {
            setcookie($field.'_error', '', 100000);
        }
        $values[$field] = $_COOKIE[$field.'_value'] ?? '';
    }

    // Языки - массив, храним в JSON
    $errors['languages'] = !empty($_COOKIE['languages_error']);
    if ($errors['languages']) {
        setcookie('languages_error', '', 100000);
    }
    if (!empty($_COOKIE['languages_value'])) {
        $values['languages'] = json_decode($_COOKIE['languages_value'], true);
        if (!is_array($values['languages'])) {
            $values['languages'] = [];
        }
    } else {
        $values['languages'] = [];
    }

    // Если пользователь авторизован - загружаем данные из БД
    if (!empty($_SESSION['login']) && !empty($_SESSION['application_id'])) {
        try {
            $stmt = $db->prepare("SELECT * FROM application WHERE id = ?");
            $stmt->execute([$_SESSION['application_id']]);
            $appData = $stmt->fetch();

            if ($appData) {
                foreach ($fields as $field) {
                    if (isset($appData[$field])) {
                        $values[$field] = $appData[$field];
                    }
                }
            }

            // Загружаем языки
            $stmt = $db->prepare("SELECT lang_id FROM application_languages WHERE app_id = ?");
            $stmt->execute([$_SESSION['application_id']]);
            $values['languages'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

        } catch (PDOException $e) {
            $messages[] = 'Ошибка загрузки данных из базы.';
        }
    }

    include('form.php');
    exit();
}

// POST-запрос - обработка формы

$errors = false;
$fields_patterns = [
    'fio' => '/^[А-Яа-яЁёA-Za-z\s]{1,150}$/u',
    'phone' => '/^[\+\d\s\-]{5,20}$/',
    'email' => '/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
    'birth_date' => '/^\d{4}-\d{2}-\d{2}$/',
    'gender' => '/^(male|female|other)$/',
    'agree' => '/^on$/'
];

// Проверка и сохранение ошибок и значений в куки
foreach ($fields_patterns as $field => $pattern) {
    if (empty($_POST[$field]) || !preg_match($pattern, $_POST[$field])) {
        setcookie($field.'_error', '1', time() + 24 * 60 * 60);
        $errors = true;
    } else {
        setcookie($field.'_value', $_POST[$field], time() + 30 * 24 * 60 * 60);
    }
}

// Проверка языков (обязательное поле)
if (empty($_POST['languages']) || !is_array($_POST['languages']) || count($_POST['languages']) == 0) {
    setcookie('languages_error', '1', time() + 24 * 60 * 60);
    $errors = true;
} else {
    setcookie('languages_value', json_encode($_POST['languages']), time() + 30 * 24 * 60 * 60);
}

// bio - необязательное поле
setcookie('bio_value', $_POST['bio'] ?? '', time() + 30 * 24 * 60 * 60);

if ($errors) {
    header('Location: index.php');
    exit();
}

// Если пользователь авторизован - обновляем данные
if (!empty($_SESSION['login']) && !empty($_SESSION['application_id'])) {
    try {
        $stmt = $db->prepare("UPDATE application SET fio=?, phone=?, email=?, birth_date=?, gender=?, bio=?, agree=1 WHERE id=?");
        $stmt->execute([
            $_POST['fio'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['birth_date'],
            $_POST['gender'],
            $_POST['bio'] ?? '',
            $_SESSION['application_id']
        ]);

        // Обновляем языки
        $db->prepare("DELETE FROM application_languages WHERE app_id = ?")->execute([$_SESSION['application_id']]);
        $stmt = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
        foreach ($_POST['languages'] as $lang_id) {
            $stmt->execute([$_SESSION['application_id'], $lang_id]);
        }

        setcookie('save', '1');
        header('Location: index.php');
        exit();

    } catch (PDOException $e) {
        die('Ошибка обновления данных: ' . $e->getMessage());
    }
} else {
    // Новый пользователь - сохраняем данные и генерируем логин/пароль
    try {
        $stmt = $db->prepare("INSERT INTO application (fio, phone, email, birth_date, gender, bio, agree) VALUES (?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([
            $_POST['fio'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['birth_date'],
            $_POST['gender'],
            $_POST['bio'] ?? ''
        ]);
        $app_id = $db->lastInsertId();

        // Сохраняем языки
        $stmt = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
        foreach ($_POST['languages'] as $lang_id) {
            $stmt->execute([$app_id, $lang_id]);
        }

        // Генерация логина и пароля
        $login = uniqid('user_');
        $pass = bin2hex(random_bytes(4));
        $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

        // Сохраняем в users
        $stmt = $db->prepare("INSERT INTO users (login, pass_hash, application_id) VALUES (?, ?, ?)");
        $stmt->execute([$login, $pass_hash, $app_id]);

        // Устанавливаем куки для показа пользователю
        setcookie('login', $login);
        setcookie('pass', $pass);
        setcookie('save', '1');

        header('Location: index.php');
        exit();

    } catch (PDOException $e) {
        die('Ошибка сохранения данных: ' . $e->getMessage());
    }
}
