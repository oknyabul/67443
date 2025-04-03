<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Анкета разработчика</title>
    <style>
        /* Ваши стили из предыдущего примера */
        .error { color: red; }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Анкета разработчика</h1>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="fio" class="required">ФИО</label>
                <input type="text" id="fio" name="fio" required 
                       value="<?= htmlspecialchars($_POST['fio'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="phone" class="required">Телефон</label>
                <input type="tel" id="phone" name="phone" required 
                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="email" class="required">E-mail</label>
                <input type="email" id="email" name="email" required 
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="birthdate" class="required">Дата рождения</label>
                <input type="date" id="birthdate" name="birthdate" required 
                       value="<?= htmlspecialchars($_POST['birthdate'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label class="required">Пол</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="male" name="gender" value="male" required
                               <?= ($_POST['gender'] ?? '') === 'male' ? 'checked' : '' ?>>
                        <label for="male">Мужской</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="female" name="gender" value="female"
                               <?= ($_POST['gender'] ?? '') === 'female' ? 'checked' : '' ?>>
                        <label for="female">Женский</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="other" name="gender" value="other"
                               <?= ($_POST['gender'] ?? '') === 'other' ? 'checked' : '' ?>>
                        <label for="other">Другой</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="languages" class="required">Любимый язык программирования</label>
                <select id="languages" name="languages[]" multiple required>
                    <?php
                    $languages = [
                        'Pascal', 'C', 'C++', 'JavaScript', 'PHP', 
                        'Python', 'Java', 'Haskel', 'Clojure', 'Prolog', 
                        'Scala', 'Go'
                    ];
                    foreach ($languages as $id => $lang) {
                        $selected = in_array($id+1, $_POST['languages'] ?? []) ? 'selected' : '';
                        echo "<option value='" . ($id+1) . "' $selected>$lang</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="abilities">Способности</label>
                <select id="abilities" name="abilities[]" multiple>
                    <?php
                    $abilities = [
                        'Бессмертие', 'Левитация', 
                        'Прохождение сквозь стены', 'Огненный шар'
                    ];
                    foreach ($abilities as $id => $ability) {
                        $selected = in_array($id+1, $_POST['abilities'] ?? []) ? 'selected' : '';
                        echo "<option value='" . ($id+1) . "' $selected>$ability</option>";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="bio">Биография</label>
                <textarea id="bio" name="bio"><?= htmlspecialchars($_POST['bio'] ?? '') ?></textarea>
            </div>
            
            <div class="checkbox-container">
                <input type="checkbox" id="contract" name="contract" required
                       <?= !empty($_POST['contract']) ? 'checked' : '' ?>>
                <label for="contract" class="required">С контрактом ознакомлен(а)</label>
            </div>
            
            <button type="submit">Сохранить</button>
        </form>
    </div>
</body>
</html>
