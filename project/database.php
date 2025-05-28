<?php
$user = 'u67443';
$pass = '3234547';

try {
    $db = new PDO(
        'mysql:host=localhost;dbname=u67443;charset=utf8mb4',
        $user,
        $pass,
        [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
