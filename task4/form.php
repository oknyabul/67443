<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Анкета разработчика</title>
  <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f5f7fa;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    .container {
        max-width: 600px;
        margin: 0 auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin: 15px 0 5px;
        font-weight: bold;
        color: #34495e;
    }

    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="date"],
    select,
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
    }

    select[multiple] {
        height: 120px;
    }
    
    .radio-group, .checkbox-group {
        margin: 10px 0;
    }

    .radio-group label, .checkbox-group label {
        display: inline-block;
        margin-right: 15px;
        font-weight: normal;
    }

    button {
        background: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 20px;
        transition: background 0.3s;
    }

    button:hover {
        background: #2980b9;
    }

    .error {
        color: #e74c3c;
        margin: 5px 0;
        font-size: 14px;
    }

    .success {
        color: #27ae60;
        text-align: center;
        margin: 20px 0;
        font-weight: bold;
    }

    .error-field {
        border-color: #e74c3c !important;
    }

    #messages {
        margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Анкета разработчика</h1>
    
    <div id="messages">
        <?php
        if (!empty($messages)) {
            foreach ($messages as $message) {
                echo $message;
            }
        }
        ?>
    </div>

    <form action="" method="POST">
        <label>ФИО*:</label>
        <input type="text" name="fio" class="<?php if ($errors['fio']) echo 'error-field'; ?>" 
               value="<?php echo htmlspecialchars($values['fio'] ?? ''); ?>" required>
        <?php if ($errors['fio']): ?>
            <div class="error">ФИО должно содержать только буквы и пробелы (макс. 150 символов)</div>
        <?php endif; ?>

        <label>Телефон*:</label>
        <input type="tel" name="phone" class="<?php if ($errors['phone']) echo 'error-field'; ?>" 
               value="<?php echo htmlspecialchars($values['phone'] ?? ''); ?>" required>
        <?php if ($errors['phone']): ?>
            <div class="error">Телефон должен содержать только цифры, пробелы, + и - (5-20 символов)</div>
        <?php endif; ?>

        <label>Email*:</label>
        <input type="email" name="email" class="<?php if ($errors['email']) echo 'error-field'; ?>" 
               value="<?php echo htmlspecialchars($values['email'] ?? ''); ?>" required>
        <?php if ($errors['email']): ?>
            <div class="error">Введите корректный email</div>
        <?php endif; ?>

        <label>Дата рождения*:</label>
        <input type="date" name="birth_date" class="<?php if ($errors['birth_date']) echo 'error-field'; ?>" 
               value="<?php echo htmlspecialchars($values['birth_date'] ?? ''); ?>" required>
        <?php if ($errors['birth_date']): ?>
            <div class="error">Введите дату в формате ГГГГ-ММ-ДД</div>
        <?php endif; ?>

        <label>Пол*:</label>
        <div class="radio-group">
            <label><input type="radio" name="gender" value="male" 
                <?php if (($values['gender'] ?? '') == 'male') echo 'checked'; ?> required> Мужской</label>
            <label><input type="radio" name="gender" value="female" 
                <?php if (($values['gender'] ?? '') == 'female') echo 'checked'; ?>> Женский</label>
            <label><input type="radio" name="gender" value="other" 
                <?php if (($values['gender'] ?? '') == 'other') echo 'checked'; ?>> Другой</label>
        </div>
        <?php if ($errors['gender']): ?>
            <div class="error">Выберите пол</div>
        <?php endif; ?>

        <label>Любимый язык программирования* (выберите один или несколько):</label>
        <select name="languages[]" multiple="multiple" class="<?php if ($errors['languages']) echo 'error-field'; ?>" required>
            <?php
            $selectedLangs = !empty($_COOKIE['languages_value']) ? unserialize($_COOKIE['languages_value']) : [];
            ?>
            <option value="1" <?php if (in_array('1', $selectedLangs)) echo 'selected'; ?>>Pascal</option>
            <option value="2" <?php if (in_array('2', $selectedLangs)) echo 'selected'; ?>>C</option>
            <option value="3" <?php if (in_array('3', $selectedLangs)) echo 'selected'; ?>>C++</option>
            <option value="4" <?php if (in_array('4', $selectedLangs)) echo 'selected'; ?>>JavaScript</option>
            <option value="5" <?php if (in_array('5', $selectedLangs)) echo 'selected'; ?>>PHP</option>
            <option value="6" <?php if (in_array('6', $selectedLangs)) echo 'selected'; ?>>Python</option>
            <option value="7" <?php if (in_array('7', $selectedLangs)) echo 'selected'; ?>>Java</option>
            <option value="8" <?php if (in_array('8', $selectedLangs)) echo 'selected'; ?>>Haskell</option>
            <option value="9" <?php if (in_array('9', $selectedLangs)) echo 'selected'; ?>>Clojure</option>
            <option value="10" <?php if (in_array('10', $selectedLangs)) echo 'selected'; ?>>Prolog</option>
            <option value="11" <?php if (in_array('11', $selectedLangs)) echo 'selected'; ?>>Scala</option>
            <option value="12" <?php if (in_array('12', $selectedLangs)) echo 'selected'; ?>>Go</option>
        </select>
        <?php if ($errors['languages']): ?>
            <div class="error">Выберите хотя бы один язык программирования</div>
        <?php endif; ?>

        <label>Биография:</label>
        <textarea name="bio" rows="5"><?php echo htmlspecialchars($values['bio'] ?? ''); ?></textarea>

        <label>
            <input type="checkbox" name="agree" <?php if (!empty($values['agree'])) echo 'checked'; ?> required>
            С контрактом ознакомлен(а)*
        </label>
        <?php if ($errors['agree']): ?>
            <div class="error">Необходимо согласие с контрактом</div>
        <?php endif; ?>

        <button type="submit">Сохранить</button>
    </form>
  </div>
</body>
</html>