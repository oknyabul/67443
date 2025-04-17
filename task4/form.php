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

    .success {
        color: #27ae60;
        text-align: center;
        margin: 20px 0;
        font-weight: bold;
    }

    .error {
        border: 2px solid red;
    }

    .error-message {
        color: red;
        font-size: 0.8em;
        margin-top: 5px;
    }
    
    .messages {
        margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Анкета разработчика</h1>
    
    <?php if (!empty($messages)): ?>
      <div class="messages">
        <?php foreach ($messages as $message): ?>
          <?php echo $message; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="index.php" method="POST">
      <label>ФИО*:</label>
      <input type="text" name="fio" value="<?php echo htmlspecialchars($values['fio']); ?>" <?php if ($errors['fio']) echo 'class="error"'; ?>>
      <?php if ($errors['fio']): ?>
        <div class="error-message"><?php echo $errorMessages['fio']; ?></div>
      <?php endif; ?>

      <label>Телефон*:</label>
      <input type="tel" name="phone" value="<?php echo htmlspecialchars($values['phone']); ?>" <?php if ($errors['phone']) echo 'class="error"'; ?>>
      <?php if ($errors['phone']): ?>
        <div class="error-message"><?php echo $errorMessages['phone']; ?></div>
      <?php endif; ?>

      <label>Email*:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($values['email']); ?>" <?php if ($errors['email']) echo 'class="error"'; ?>>
      <?php if ($errors['email']): ?>
        <div class="error-message"><?php echo $errorMessages['email']; ?></div>
      <?php endif; ?>

      <label>Дата рождения*:</label>
      <input type="date" name="birth_date" value="<?php echo htmlspecialchars($values['birth_date']); ?>" <?php if ($errors['birth_date']) echo 'class="error"'; ?>>
      <?php if ($errors['birth_date']): ?>
        <div class="error-message"><?php echo $errorMessages['birth_date']; ?></div>
      <?php endif; ?>

      <label>Пол*:</label>
      <div>
        <label><input type="radio" name="gender" value="male" <?php echo ($values['gender'] == 'male') ? 'checked' : ''; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>> Мужской</label>
        <label><input type="radio" name="gender" value="female" <?php echo ($values['gender'] == 'female') ? 'checked' : ''; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>> Женский</label>
        <label><input type="radio" name="gender" value="other" <?php echo ($values['gender'] == 'other') ? 'checked' : ''; ?> <?php if ($errors['gender']) echo 'class="error"'; ?>> Другой</label>
      </div>
      <?php if ($errors['gender']): ?>
        <div class="error-message"><?php echo $errorMessages['gender']; ?></div>
      <?php endif; ?>

      <label>Любимый язык программирования*:</label>
      <select name="languages[]" multiple <?php if ($errors['languages']) echo 'class="error"'; ?>>
        <?php 
        $selectedLangs = !empty($values['languages']) ? explode(',', $values['languages']) : [];
        $allLangs = [
          1 => 'Pascal', 2 => 'C', 3 => 'C++', 4 => 'JavaScript',
          5 => 'PHP', 6 => 'Python', 7 => 'Java', 8 => 'Haskell',
          9 => 'Clojure', 10 => 'Prolog', 11 => 'Scala', 12 => 'Go'
        ];
        foreach ($allLangs as $id => $lang): ?>
          <option value="<?php echo $id; ?>" <?php echo in_array($id, $selectedLangs) ? 'selected' : ''; ?>>
            <?php echo $lang; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if ($errors['languages']): ?>
        <div class="error-message"><?php echo $errorMessages['languages']; ?></div>
      <?php endif; ?>

      <label>Биография:</label>
      <textarea name="bio" rows="5" <?php if ($errors['bio']) echo 'class="error"'; ?>><?php echo htmlspecialchars($values['bio']); ?></textarea>
      <?php if ($errors['bio']): ?>
        <div class="error-message"><?php echo $errorMessages['bio']; ?></div>
      <?php endif; ?>

      <label>
        <input type="checkbox" name="agree" <?php echo $values['agree']; ?> <?php if ($errors['agree']) echo 'class="error"'; ?>>
        С контрактом ознакомлен(а)*
      </label>
      <?php if ($errors['agree']): ?>
        <div class="error-message"><?php echo $errorMessages['agree']; ?></div>
      <?php endif; ?>

      <button type="submit">Сохранить</button>
    </form>
  </div>
</body>
</html>