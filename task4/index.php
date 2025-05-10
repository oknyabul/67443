<?php
header('Content-Type: text/html; charset=UTF-8');

$fields = [
  'fio' => '/^[А-Яа-яЁёA-Za-z\s]{1,150}$/u',
  'phone' => '/^[\+\d\s\-]{5,20}$/',
  'email' => '/^[^@\s]+@[^@\s]+\.[^@\s]+$/',
  'birth_date' => '/^\d{4}-\d{2}-\d{2}$/',
  'gender' => '/^(male|female|other)$/',
  'agree' => '/^on$/'
];

// Вспомогательная функция для очистки куков с ошибками и значениями
function clearErrorCookies() {
  foreach ($_COOKIE as $key => $value) {
    if (strpos($key, '_error') !== false || strpos($key, '_value') !== false) {
      setcookie($key, '', 100000);
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = [];
  $errors = [];
  $values = [];

  // Если есть кука save - показываем сообщение и удаляем куку
  if (!empty($_COOKIE['save'])) {
    $messages[] = '<div class="success">Ваши данные успешно сохранены!</div>';
    setcookie('save', '', 100000);
  }

  // Проверяем ошибки в куках
  foreach ($fields as $field => $pattern) {
    $errors[$field] = !empty($_COOKIE[$field . '_error']);
    if ($errors[$field]) {
      setcookie($field . '_error', '', 100000);
    }
  }
  // Ошибка для languages (массив)
  $errors['languages'] = !empty($_COOKIE['languages_error']);
  if ($errors['languages']) {
    setcookie('languages_error', '', 100000);
  }

  // Ошибка для bio отсутствует (необязательное поле)
  $errors['bio'] = false;

  // Загружаем значения из куков, если есть
  foreach ($fields as $field => $pattern) {
    $values[$field] = $_COOKIE[$field . '_value'] ?? '';
  }
  // Для languages - кука хранит JSON-массив или строку с разделителем
  if (!empty($_COOKIE['languages_value'])) {
    $values['languages'] = json_decode($_COOKIE['languages_value'], true);
    if (!is_array($values['languages'])) {
      $values['languages'] = [];
    }
  } else {
    $values['languages'] = [];
  }

  // bio
  $values['bio'] = $_COOKIE['bio_value'] ?? '';

  include('form.php');
  exit();
}

// POST - обработка данных формы

$errors = false;

// Проверяем обязательные поля и валидируем
foreach ($fields as $field => $pattern) {
  if (empty($_POST[$field])) {
    setcookie($field . '_error', '1', 0); // сессия
    $errors = true;
  } else {
    if ($pattern && !preg_match($pattern, $_POST[$field])) {
      setcookie($field . '_error', '1', 0);
      $errors = true;
    }
  }
  // Сохраняем значение в куку на 1 месяц (чтобы восстановить в форме)
  setcookie($field . '_value', $_POST[$field] ?? '', time() + 30 * 24 * 60 * 60);
}

// Проверка languages (обязательное, массив)
if (empty($_POST['languages']) || !is_array($_POST['languages']) || count($_POST['languages']) == 0) {
  setcookie('languages_error', '1', 0);
  $errors = true;
} else {
  // Сохраняем в куку JSON-массив на 1 месяц
  setcookie('languages_value', json_encode($_POST['languages']), time() + 30 * 24 * 60 * 60);
}

// bio - необязательное, сохраняем значение
setcookie('bio_value', $_POST['bio'] ?? '', time() + 30 * 24 * 60 * 60);

if ($errors) {
  // При ошибках - редирект на GET, чтобы показать форму с ошибками
  header('Location: index.php');
  exit();
}

// Если ошибок нет - удаляем куки с ошибками
clearErrorCookies();

// Сохраняем значения в куки на 1 год
foreach ($fields as $field => $pattern) {
  setcookie($field . '_value', $_POST[$field], time() + 365 * 24 * 60 * 60);
}
setcookie('languages_value', json_encode($_POST['languages']), time() + 365 * 24 * 60 * 60);
setcookie('bio_value', $_POST['bio'] ?? '', time() + 365 * 24 * 60 * 60);

// Сохраняем заявку в базу
$user = 'u67443';
$pass = '3234547';
try {
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
    'bio' => $_POST['bio'] ?? ''
  ]);

  $app_id = $db->lastInsertId();

  $stmt = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
  foreach ($_POST['languages'] as $lang_id) {
    $stmt->execute([$app_id, $lang_id]);
  }

} catch (PDOException $e) {
  // Для простоты - выводим ошибку
  echo '<div class="error">Ошибка базы данных: ' . htmlspecialchars($e->getMessage()) . '</div>';
  exit();
}

// Сохраняем куку с признаком успешного сохранения
setcookie('save', '1', 0);

// Перенаправляем на GET для отображения формы с сообщением
header('Location: index.php');
exit();
