<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        form {
            max-width: 300px;
            margin: auto;
        }
        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 8px;
            font-size: 16px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h2>Вход для редактирования данных</h2>
    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="login" placeholder="Логин" required>
        <input type="password" name="pass" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
