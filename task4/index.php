<?php
header('Content-Type: text/html; charset=UTF-8');

// Определяем регулярные выражения для валидации
$patterns = [
    'fio' => '/^[А-Яа-яЁёA-Za-z\s]{1,150}$/u',
    'phone' => '/^[\+\d\s\-]{5,20}$/',
    'email' => '/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
    'birth_date' => '/^\d{4}-\d{2}-\d{2}$/',
    'gender' => '/^(male|female|other)$/',
    'languages' => '/^[\d,]+$/',
    'bio' => '/^[\s\S]{0,500}$/',
    'agree' => '/^on$/'
];

// Сообщения об ошибках
$errorMessages = [
    'fio' => 'ФИО должно содержать только буквы и пробелы (макс. 150 символов)',
    'phone' => 'Телефон должен содержать цифры, +, - или пробелы (5-20 символов)',
    'email' => 'Введите корректный email',
    'birth_date' => 'Введите дату в формате ГГГГ-ММ-ДД',
    'gender' => 'Выберите пол',
    'languages' => 'Выберите хотя бы один язык',
    'bio' => 'Биография не должна превышать 500 символов',
    'agree' => 'Необходимо согласие с контрактом'
];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $messages = array();
    $errors = array();
    $values = array();

    // Проверяем успешное сохранение
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() - 3600);
        $messages[] = 'Спасибо, результаты сохранены.';
    }

    // Проверяем ошибки в полях
    foreach ($patterns as $field => $pattern) {
        $errors[$field] = !empty($_COOKIE[$field.'_error']);
        if ($errors[$field]) {
            setcookie($field.'_error', '', time() - 3600);
            $messages[] = '<div class="error">'.$errorMessages[$field].'</div>';
        }
        $values[$field] = empty($_COOKIE[$field.'_value']) ? '' : $_COOKIE[$field.'_value'];
    }

    // Для чекбокса согласия
    $values['agree'] = empty($_COOKIE['agree_value']) ? '' : 'checked';

    include('form.php');
}
else {
    $errors = FALSE;
    
    // Проверяем каждое поле
    foreach ($patterns as $field => $pattern) {
        $value = $_POST[$field] ?? '';
        
        if ($field == 'languages') {
            // Особый случай для языков
            $langs = $_POST['languages'] ?? array();
            if (empty($langs)) {
                setcookie('languages_error', '1', time() + 24 * 60 * 60);
                $errors = TRUE;
            }
            // Проверяем, что $langs - массив и не пустой
            if (is_array($langs)) {
                setcookie('languages_value', implode(',', $langs), time() + 365 * 24 * 60 * 60);
            } else {
                setcookie('languages_error', '1', time() + 24 * 60 * 60);
                $errors = TRUE;
            }
        } elseif ($field == 'agree') {
            // Особый случай для чекбокса
            if (empty($_POST['agree'])) {
                setcookie('agree_error', '1', time() + 24 * 60 * 60);
                $errors = TRUE;
            }
            setcookie('agree_value', $_POST['agree'] ?? '', time() + 365 * 24 * 60 * 60);
        } else {
            // Обычные поля
            if (empty($value) || !preg_match($pattern, $value)) {
                setcookie($field.'_error', '1', time() + 24 * 60 * 60);
                $errors = TRUE;
            }
            setcookie($field.'_value', $value, time() + 365 * 24 * 60 * 60);
        }
    }

    if ($errors) {
        header('Location: index.php');
        exit();
    }
    else {
        // Удаляем Cookies с ошибками
        foreach ($patterns as $field => $pattern) {
            setcookie($field.'_error', '', time() - 3600);
        }
        
        // Сохраняем в базу данных (ваш существующий код)
        try {
            $user = 'u67443'; 
            $pass = '3234547';
            $db = new PDO('mysql:host=localhost;dbname=u67443', $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

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

            setcookie('save', '1');
            header('Location: index.php');
        } catch (PDOException $e) {
            // Обработка ошибок БД
            $messages[] = '<div class="error">Ошибка базы данных: '.$e->getMessage().'</div>';
            include('form.php');
        }
    }
}
