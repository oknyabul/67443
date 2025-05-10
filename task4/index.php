<?php
header('Content-Type: text/html; charset=UTF-8');

// Массив для сообщений пользователю
$messages = array();

// Массив для ошибок
$errors = array();

// Массив для сохраненных значений
$values = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Проверяем успешное сохранение
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() - 3600);
        $messages[] = 'Спасибо, результаты сохранены.';
    }

    // Проверяем ошибки для каждого поля
    $fields = ['fio', 'phone', 'email', 'birth_date', 'gender', 'languages', 'agree', 'bio'];
    foreach ($fields as $field) {
        $errors[$field] = !empty($_COOKIE[$field.'_error']);
        if ($errors[$field]) {
            setcookie($field.'_error', '', time() - 3600);
        }
        $values[$field] = empty($_COOKIE[$field.'_value']) ? '' : $_COOKIE[$field.'_value'];
        if (!empty($_COOKIE[$field.'_value'])) {
            setcookie($field.'_value', '', time() - 3600);
        }
    }

    include('form.php');
    exit();
}

// Валидация данных
$fields = [
    'fio' => [
        'pattern' => '/^[А-Яа-яЁёA-Za-z\s]{1,150}$/u',
        'error' => 'ФИО должно содержать только буквы и пробелы (макс. 150 символов)'
    ],
    'phone' => [
        'pattern' => '/^[\+\d\s\-]{5,20}$/',
        'error' => 'Телефон должен содержать только цифры, пробелы, + и - (5-20 символов)'
    ],
    'email' => [
        'pattern' => '/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
        'error' => 'Введите корректный email'
    ],
    'birth_date' => [
        'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
        'error' => 'Введите дату в формате ГГГГ-ММ-ДД'
    ],
    'gender' => [
        'pattern' => '/^(male|female|other)$/',
        'error' => 'Выберите пол'
    ],
    'languages' => [
        'error' => 'Выберите хотя бы один язык программирования'
    ],
    'agree' => [
        'error' => 'Необходимо согласие с контрактом'
    ]
];

foreach ($fields as $field => $data) {
    if (empty($_POST[$field])) {
        setcookie($field.'_error', '1', time() + 24 * 60 * 60);
        $errors[$field] = true;
    } elseif ($field == 'languages') {
        if (empty($_POST['languages']) || !is_array($_POST['languages'])) {
            setcookie('languages_error', '1', time() + 24 * 60 * 60);
            $errors['languages'] = true;
        } else {
            setcookie('languages_value', serialize($_POST['languages']), time() + 365 * 24 * 60 * 60);
        }
    } elseif (!preg_match($data['pattern'], $_POST[$field])) {
        setcookie($field.'_error', '1', time() + 24 * 60 * 60);
        $errors[$field] = true;
    }
    setcookie($field.'_value', $_POST[$field], time() + 365 * 24 * 60 * 60);
}

if (array_filter($errors)) {
    header('Location: index.php');
    exit();
}

// Удаляем куки с ошибками
foreach ($fields as $field => $data) {
    setcookie($field.'_error', '', time() - 3600);
}

// Сохранение в БД
$user = 'u67443'; 
$pass = '3234547';
$db = new PDO('mysql:host=localhost;dbname=u67443', $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

try {
    $stmt = $db->prepare("
        INSERT INTO application (fio, phone, email, birth_date, gender, bio, agree)
        VALUES (:fio, :phone, :email, :birth_date, :gender, :bio, 1)
    ");
    $stmt->execute([
        'fio' => $_POST['fio'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'birth_date' => $_POST['birth_date'],
        'gender' => $_POST['gender'],
        'bio' => $_POST['bio']
    ]);

    $app_id = $db->lastInsertId();
    $stmt = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");

    foreach ($_POST['languages'] as $lang_id) {
        $stmt->execute([$app_id, $lang_id]);
    }

    setcookie('save', '1', time() + 24 * 60 * 60);
    header('Location: index.php');
} catch (PDOException $e) {
    print('Error: ' . $e->getMessage());
    exit();
}