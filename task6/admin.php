<?php
// HTTP Basic Authentication
if (!isset($_SERVER['PHP_AUTH_USER']) || 
    !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] !== 'vixa_admin' ||
    $_SERVER['PHP_AUTH_PW'] !== '3234547') {
    header('WWW-Authenticate: Basic realm="Admin Panel"');
    header('HTTP/1.0 401 Unauthorized');
    exit('<h1>401 Доступ запрещен</h1>');
}

// Подключение к БД
try {
    $db = new PDO('mysql:host=localhost;dbname=u67443', 'u67443', '3234547', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die('Ошибка подключения к БД: ' . $e->getMessage());
}

// Получаем список всех языков для формы и статистики
$langs = $db->query("SELECT id, name FROM programming_languages ORDER BY name")->fetchAll(PDO::FETCH_KEY_PAIR);

$error = '';

// Обработка POST-запросов: удаление и обновление
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = (int)$_POST['id'];
        $stmt = $db->prepare("DELETE FROM application WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: admin.php');
        exit();
    } elseif (isset($_POST['update'])) {
        $id = (int)$_POST['id'];
        $fio = trim($_POST['fio']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $birth_date = $_POST['birth_date'];
        $gender = $_POST['gender'];
        $bio = trim($_POST['bio']);
        $languages = $_POST['languages'] ?? [];

        if ($fio === '' || $phone === '' || $email === '' || $birth_date === '' || !in_array($gender, ['male','female','other']) || count($languages) === 0) {
            $error = "Заполните все обязательные поля и выберите хотя бы один язык.";
        } else {
            // Обновляем заявку
            $stmt = $db->prepare("UPDATE application SET fio=?, phone=?, email=?, birth_date=?, gender=?, bio=? WHERE id=?");
            $stmt->execute([$fio, $phone, $email, $birth_date, $gender, $bio, $id]);

            // Обновляем языки
            $db->prepare("DELETE FROM application_languages WHERE app_id = ?")->execute([$id]);
            $stmt = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
            foreach ($languages as $lang_id) {
                $stmt->execute([$id, $lang_id]);
            }

            header('Location: admin.php');
            exit();
        }
    }
}

// Получаем все заявки с языками и их ID
$apps = $db->query("
    SELECT a.*, 
           GROUP_CONCAT(pl.name ORDER BY pl.name SEPARATOR ', ') AS languages,
           GROUP_CONCAT(pl.id ORDER BY pl.name) AS lang_ids
    FROM application a
    LEFT JOIN application_languages al ON a.id = al.app_id
    LEFT JOIN programming_languages pl ON al.lang_id = pl.id
    GROUP BY a.id
    ORDER BY a.id ASC
")->fetchAll();

foreach ($apps as &$app) {
    $app['lang_ids'] = $app['lang_ids'] ? explode(',', $app['lang_ids']) : [];
}
unset($app);

// Получаем статистику по языкам
$stats = $db->query("
    SELECT pl.name, COUNT(al.app_id) AS count
    FROM programming_languages pl
    LEFT JOIN application_languages al ON pl.id = al.lang_id
    GROUP BY pl.id
    ORDER BY pl.name
")->fetchAll();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Админ-панель</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; vertical-align: top; }
        th { background-color: #f0f0f0; }
        form.inline { display: inline; }
        .error { color: red; margin-bottom: 10px; }
        .stats ul { list-style: none; padding-left: 0; }
        .stats li { margin-bottom: 5px; }
        .edit-form { display: none; margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; background: #f9f9f9; }
        label { display: block; margin-top: 10px; }
        input[type=text], input[type=email], input[type=date], select, textarea {
            width: 100%; padding: 6px; box-sizing: border-box;
        }
        button { margin-top: 10px; padding: 8px 15px; }
    </style>
</head>
<body>
    <h1>Админ-панель</h1>

    <section class="stats">
        <h2>Статистика по языкам программирования</h2>
        <ul>
            <?php foreach ($stats as $stat): ?>
                <li><?=htmlspecialchars($stat['name'])?>: <?= $stat['count'] ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <?php if ($error): ?>
        <div class="error"><?=htmlspecialchars($error)?></div>
    <?php endif; ?>

    <h2>Все заявки</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Дата рождения</th>
                <th>Пол</th>
                <th>Языки</th>
                <th>Биография</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($apps as $app): ?>
            <tr>
                <td><?= $app['id'] ?></td>
                <td><?= htmlspecialchars($app['fio']) ?></td>
                <td><?= htmlspecialchars($app['phone']) ?></td>
                <td><?= htmlspecialchars($app['email']) ?></td>
                <td><?= $app['birth_date'] ?></td>
                <td><?= htmlspecialchars($app['gender']) ?></td>
                <td><?= htmlspecialchars($app['languages']) ?></td>
                <td><?= nl2br(htmlspecialchars($app['bio'])) ?></td>
                <td>
                    <form method="POST" class="inline" onsubmit="return confirm('Удалить заявку #<?= $app['id'] ?>?');">
                        <input type="hidden" name="id" value="<?= $app['id'] ?>">
                        <button type="submit" name="delete">Удалить</button>
                    </form>
                    <button onclick="showEditForm(<?= $app['id'] ?>)">Редактировать</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <section id="editSection" class="edit-form">
        <h2>Редактирование заявки</h2>
        <form method="POST" id="editForm">
            <input type="hidden" name="id" id="editId">

            <label>ФИО:
                <input type="text" name="fio" id="editFio" required maxlength="150">
            </label>

            <label>Телефон:
                <input type="text" name="phone" id="editPhone" required maxlength="20">
            </label>

            <label>Email:
                <input type="email" name="email" id="editEmail" required maxlength="100">
            </label>

            <label>Дата рождения:
                <input type="date" name="birth_date" id="editBirthDate" required>
            </label>

            <label>Пол:
                <select name="gender" id="editGender" required>
                    <option value="male">Мужской</option>
                    <option value="female">Женский</option>
                    <option value="other">Другой</option>
                </select>
            </label>

            <label>Языки программирования (выберите один или несколько):</label>
            <div id="editLanguages">
                <?php foreach ($langs as $id => $name): ?>
                    <label style="display:inline-block; margin-right:10px;">
                        <input type="checkbox" name="languages[]" value="<?= $id ?>"> <?= htmlspecialchars($name) ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <label>Биография:
                <textarea name="bio" id="editBio" rows="4"></textarea>
            </label>

            <button type="submit" name="update">Сохранить</button>
            <button type="button" onclick="hideEditForm()">Отмена</button>
        </form>
    </section>

    <script>
        const apps = <?= json_encode($apps, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) ?>;

        function showEditForm(id) {
            const app = apps.find(a => a.id == id);
            if (!app) {
                alert('Заявка не найдена');
                return;
            }

            document.getElementById('editId').value = app.id;
            document.getElementById('editFio').value = app.fio;
            document.getElementById('editPhone').value = app.phone;
            document.getElementById('editEmail').value = app.email;
            document.getElementById('editBirthDate').value = app.birth_date;
            document.getElementById('editGender').value = app.gender;
            document.getElementById('editBio').value = app.bio;

            // Сбросить все чекбоксы
            document.querySelectorAll('#editLanguages input[type=checkbox]').forEach(cb => cb.checked = false);

            // Отметить выбранные языки
            app.lang_ids.forEach(lang_id => {
                const cb = document.querySelector(`#editLanguages input[type=checkbox][value="${lang_id}"]`);
                if (cb) cb.checked = true;
            });

            document.getElementById('editSection').style.display = 'block';
            window.scrollTo(0, document.body.scrollHeight);
        }

        function hideEditForm() {
            document.getElementById('editSection').style.display = 'none';
        }
    </script>
</body>
</html>
