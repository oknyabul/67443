<?php
// Устанавливаем правильную кодировку
header('Content-Type: text/html; charset=UTF-8');

// Инициализируем переменные для хранения введенных данных
$formData = [
    'fio' => '',
    'phone' => '',
    'email' => '',
    'birthdate' => '',
    'gender' => '',
    'languages' => [],
    'abilities' => [],
    'bio' => '',
    'contract' => false
];

// Обработка GET-запроса (показ формы)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!empty($_GET['save'])) {
        // Сообщение об успешном сохранении
        $successMessage = 'Спасибо, результаты сохранены.';
    }
    
    // Показываем форму (HTML будет ниже)
} 
// Обработка POST-запроса (отправка формы)
else {
    // Сохраняем введенные данные для повторного показа
    $formData = [
        'fio' => $_POST['fio'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'email' => $_POST['email'] ?? '',
        'birthdate' => $_POST['birthdate'] ?? '',
        'gender' => $_POST['gender'] ?? '',
        'languages' => $_POST['languages'] ?? [],
        'abilities' => $_POST['abilities'] ?? [],
        'bio' => $_POST['bio'] ?? '',
        'contract' => isset($_POST['contract'])
    ];
    
    // Валидация данных
    $errors = [];
    
    // ФИО: только буквы и пробелы, не длиннее 150 символов
    if (empty($formData['fio'])) {
        $errors[] = 'Укажите ФИО.';
    } elseif (!preg_match('/^[\p{Cyrillic}\s]+$/u', $formData['fio'])) {
        $errors[] = 'ФИО должно содержать только буквы и пробелы.';
    } elseif (strlen($formData['fio']) > 150) {
        $errors[] = 'ФИО не должно превышать 150 символов.';
    }
    
    // Телефон: проверка формата
    if (empty($formData['phone'])) {
        $errors[] = 'Укажите телефон.';
    } elseif (!preg_match('/^\+?\d{10,15}$/', $formData['phone'])) {
        $errors[] = 'Телефон должен содержать от 10 до 15 цифр, можно с + в начале.';
    }
    
    // Email: проверка формата
    if (empty($formData['email'])) {
        $errors[] = 'Укажите email.';
    } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный email.';
    }
    
    // Дата рождения: проверка что дата в прошлом
    if (empty($formData['birthdate'])) {
        $errors[] = 'Укажите дату рождения.';
    } elseif (strtotime($formData['birthdate']) >= time()) {
        $errors[] = 'Дата рождения должна быть в прошлом.';
    }
    
    // Пол: проверка допустимых значений
    $allowedGenders = ['male', 'female', 'other'];
    if (empty($formData['gender']) || !in_array($formData['gender'], $allowedGenders)) {
        $errors[] = 'Укажите пол.';
    }
    
    // Языки программирования: хотя бы один выбран
    if (empty($formData['languages'])) {
        $errors[] = 'Выберите хотя бы один язык программирования.';
    }
    
    // Биография: необязательное поле
    if (!empty($formData['bio']) && strlen($formData['bio']) > 5000) {
        $errors[] = 'Биография не должна превышать 5000 символов.';
    }
    
    // Чекбокс контракта
    if (!$formData['contract']) {
        $errors[] = 'Вы должны ознакомиться с контрактом.';
    }
    
    // Если ошибок нет - сохраняем в БД
    if (empty($errors)) {
        // Подключение к БД
        $user = 'u67443'; // Заменить на ваш логин
        $pass = '3234547'; // Заменить на пароль
        $db = new PDO('mysql:host=localhost;dbname=u67443', $user, $pass, [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
        try {
            // Начинаем транзакцию
            $db->beginTransaction();
            
            // Вставляем основную информацию о заявке
            $stmt = $db->prepare("
                INSERT INTO applications 
                (fullname, phone, email, birthdate, gender, bio, contract_accepted) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $formData['fio'],
                $formData['phone'],
                $formData['email'],
                $formData['birthdate'],
                $formData['gender'],
                $formData['bio'],
                $formData['contract'] ? 1 : 0
            ]);
            
            // Получаем ID вставленной заявки
            $applicationId = $db->lastInsertId();
            
            // Вставляем выбранные языки программирования
            $stmt = $db->prepare("
                INSERT INTO application_languages (application_id, language_id) 
                VALUES (?, ?)
            ");
            foreach ($formData['languages'] as $languageId) {
                $stmt->execute([$applicationId, $languageId]);
            }
            
            // Вставляем выбранные способности (если есть)
            if (!empty($formData['abilities'])) {
                $stmt = $db->prepare("
                    INSERT INTO application_abilities (application_id, ability_id) 
                    VALUES (?, ?)
                ");
                foreach ($formData['abilities'] as $abilityId) {
                    $stmt->execute([$applicationId, $abilityId]);
                }
            }
            
            // Завершаем транзакцию
            $db->commit();
            
            // Перенаправляем с сообщением об успехе
            header('Location: ?save=1');
            exit();
        } catch (PDOException $e) {
            $db->rollBack();
            $errors[] = 'Ошибка базы данных: ' . $e->getMessage();
        }
    }
}

// HTML-форма начинается здесь
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета разработчика</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .required:after {
            content: " *";
            color: red;
        }
        
        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        
        textarea {
            height: 120px;
            resize: vertical;
        }
        
        .radio-group, .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .radio-option, .checkbox-option {
            display: flex;
            align-items: center;
        }
        
        select[multiple] {
            height: 150px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }
        
        .error {
            color: red;
            margin-top: 5px;
        }
        
        .success {
            color: green;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            width: 100%;
            font-weight: 600;
        }
        
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Анкета разработчика</h1>
        
        <?php if (!empty($successMessage)): ?>
            <div class="success"><?= $successMessage ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <div class="error"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="fio" class="required">ФИО</label>
                <input type="text" id="fio" name="fio" required 
                       value="<?= htmlspecialchars($formData['fio']) ?>">
            </div>
            
            <div class="form-group">
                <label for="phone" class="required">Телефон</label>
                <input type="tel" id="phone" name="phone" required 
                       value="<?= htmlspecialchars($formData['phone']) ?>">
            </div>
            
            <div class="form-group">
                <label for="email" class="required">E-mail</label>
                <input type="email" id="email" name="email" required 
                       value="<?= htmlspecialchars($formData['email']) ?>">
            </div>
            
            <div class="form-group">
                <label for="birthdate" class="required">Дата рождения</label>
                <input type="date" id="birthdate" name="birthdate" required 
                       value="<?= htmlspecialchars($formData['birthdate']) ?>">
            </div>
            
            <div class="form-group">
                <label class="required">Пол</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="male" name="gender" value="male" required
                               <?= $formData['gender'] === 'male' ? 'checked' : '' ?>>
                        <label for="male">Мужской</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="female" name="gender" value="female"
                               <?= $formData['gender'] === 'female' ? 'checked' : '' ?>>
                        <label for="female">Женский</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="other" name="gender" value="other"
                               <?= $formData['gender'] === 'other' ? 'checked' : '' ?>>
                        <label for="other">Другой</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="languages" class="required">Любимый язык программирования</label>
                <select id="languages" name="languages[]" multiple required>
                    <?php
                    $languages = [
                        1 => 'Pascal', 2 => 'C', 3 => 'C++', 4 => 'JavaScript', 
                        5 => 'PHP', 6 => 'Python', 7 => 'Java', 8 => 'Haskel', 
                        9 => 'Clojure', 10 => 'Prolog', 11 => 'Scala', 12 => 'Go'
                    ];
                    foreach ($languages as $id => $lang) {
                        $selected = in_array($id, $formData['languages']) ? 'selected' : '';
                        echo "<option value='$id' $selected>$lang</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="abilities">Способности</label>
                <select id="abilities" name="abilities[]" multiple>
                    <?php
                    $abilities = [
                        1 => 'Бессмертие', 
                        2 => 'Левитация', 
                        3 => 'Прохождение сквозь стены', 
                        4 => 'Огненный шар'
                    ];
                    foreach ($abilities as $id => $ability) {
                        $selected = in_array($id, $formData['abilities']) ? 'selected' : '';
                        echo "<option value='$id' $selected>$ability</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="bio">Биография</label>
                <textarea id="bio" name="bio"><?= htmlspecialchars($formData['bio']) ?></textarea>
            </div>
            
            <div class="checkbox-container">
                <input type="checkbox" id="contract" name="contract" required
                       <?= $formData['contract'] ? 'checked' : '' ?>>
                <label for="contract" class="required">С контрактом ознакомлен(а)</label>
            </div>
            
            <button type="submit">Сохранить</button>
        </form>
    </div>
</body>
</html>
