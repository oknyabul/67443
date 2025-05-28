<?php
ob_start();
$db;
include ('database.php');
session_start();

$messages = ['success' => '', 'info' => ''];
$errors = [];
$values = [];
$languages = [];
$log = !empty($_SESSION['login']);
$error = false;

$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($is_ajax) {
    header('Content-Type: application/json; charset=UTF-8');
} else header("Content-Type: text/html; charset=UTF-8");

$error = false;
$log = !empty($_SESSION['login']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fio = isset($_POST['fio']) ? $_POST['fio'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $birth_date = isset($_POST['birth_date']) ? $_POST['birth_date'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $language = isset($_POST['language']) ? $_POST['language'] : [];
    $bio = isset($_POST['bio']) ? $_POST['bio'] : '';
    $agree = isset($_POST['agree']) ? $_POST['agree'] : '';

    $action = $_POST['action'] ?? '';

    if ($action === 'logout') {
        if (isset($_POST['logout']) && $_POST['logout'] == '1') {
            $cookies = ['fio_value', 'phone_value', 'email_value', 'birth_date_value', 'gender_value', 
                       'language_value', 'bio_value', 'agree_value', 'login', 'pass'];
            foreach ($cookies as $name) {
                setcookie($name, '', time() - 3600, '/');
            }
            
            $_SESSION = [];
            
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        
            if ($is_ajax) {
                echo json_encode([
                    'logout' => true,
                    'log' => false,
                    'messages' => ['success' => 'Вы успешно вышли из системы']
                ]);
                exit();
            }
            header('Location: index.php');
            exit();
        }
    }
        
    $error = false;
    $messages = [];
    $errors = [];

    function validate_field($fieldName, $errorMessage, $condition) {
        global $errors, $messages, $error;
        
        if ($condition) {
            $errors[$fieldName] = true;
            $messages[$fieldName] = $errorMessage;
            $error = true;
            return true;
        }
        return false;
    }

    if (validate_field('fio', 'Это поле пустое', empty($fio))) {
    } else {
        validate_field('fio', 'Неправильный формат: Имя Фамилия, только кириллица', !preg_match('/^[а-яёА-ЯЁ]+(?:[- ][а-яёА-ЯЁ]+)*$/iu', $fio));
    }

    if (validate_field('phone', 'Это поле пустое', empty($phone))) {
    } else {
        validate_field('phone', 'Поле должно содержать 11 цифр, начиная с 8', strlen($phone) != 11 || substr($phone, 0, 1) != '8');
    }

    if (validate_field('email', 'Это поле пустое', empty($email))) {
    } else {
        validate_field('email', 'Неправильный формат email', !filter_var($email, FILTER_VALIDATE_EMAIL));
    }
    if (validate_field('birth_date', 'Это поле пустое', empty($birth_date))) {
    } else {
        validate_field('birth_date', 'Неверная дата', strtotime($birth_date) > time());
    }

    validate_field('gender', "Не выбран пол", empty($gender) || !in_array($gender, ['male', 'female', 'other']));

    validate_field('language', 'Не выбран язык', empty($language));

   /* if (validate_field('bio', 'Это поле пустое', empty($bio))) {
    } else {
        validate_field('bio', 'Слишком длинная биография', strlen($bio) > 65535);
    }*/

    validate_field('agree', 'Не ознакомлены с контрактом', empty($agree));

    if (!$error) {
        if ($log && $action === 'update') {
            $languages = isset($_POST['language']) ? $_POST['language'] : [];
            
            try {
                $db->beginTransaction();
        
                $stmt = $db->prepare("UPDATE application SET fio = ?, phone = ?, email = ?, birth_date = ?, gender = ?, bio = ?, agree = ? WHERE id = ?");
                $stmt->execute([$fio, $phone, $email, $birth_date, $gender, $bio, $agree, $_SESSION['application_id']]);
        
                $stmt = $db->prepare("DELETE FROM application_languages WHERE app_id = ?");
                $stmt->execute([$_SESSION['application_id']]);
        
                $stmt1 = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
                foreach ($languages as $lang) {
                    $stmtLang = $db->prepare("SELECT id FROM programming_languages WHERE name = ?");
                    $stmtLang->execute([$lang]);
                    $langId = $stmtLang->fetchColumn();
                    if ($langId) {
                        $stmt1->execute([$_SESSION['application_id'], $langId]);
                    }
                }
        
                $db->commit();
        
                $response = [
                    'messages' => ['success' => 'Данные успешно обновлены!'],
                    'log' => $log,
                    'success' => true
                ];
                
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                exit();
        
            } catch (PDOException $e) {
                $db->rollBack();
                $response = [
                    'messages' => ['error' => 'Ошибка при обновлении данных'],
                    'success' => false
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                exit();
            }
        } else {
            $login = uniqid();
            $pass = uniqid();
            $mpass = md5($pass);

            try {
                $db->beginTransaction();

                $stmt = $db->prepare("INSERT INTO application (fio, phone, email, birth_date, gender, bio, agree) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$fio, $phone, $email, $birth_date, $gender, $bio, $agree]);
                $application_id = $db->lastInsertId();

                $stmt = $db->prepare("INSERT INTO users (login, pass_hash, application_id) VALUES (?, ?, ?)");
                $stmt->execute([$login, $mpass, $application_id]);
                $user_id = $db->lastInsertId();

                $stmt1 = $db->prepare("INSERT INTO application_languages (app_id, lang_id) VALUES (?, ?)");
                foreach ($languages as $lang) {
                    $stmtLang = $db->prepare("SELECT id FROM programming_languages WHERE name = ?");
                    $stmtLang->execute([$lang]);
                    $langId = $stmtLang->fetchColumn();
                    if ($langId) {
                        $stmt1->execute([$application_id, $langId]);
                    }
                }

                $db->commit();

                setcookie('login', $login, time() + 3600 * 24 * 30, '/');
                setcookie('pass', $pass, time() + 3600 * 24 * 30, '/');

                $response = [
                    'messages' => [
                        'success' => 'Спасибо, результаты сохранены.',
                        'info' => sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong> и паролем <strong>%s</strong> для изменения данных.', $login, $pass)
                    ],
                    'generated' => [
                        'login' => $login,
                        'pass' => $pass
                    ],
                    'log' => false,
                    'success' => true
                ];

            } catch (PDOException $e) {
                $db->rollBack();
                $response = [
                    'messages' => [
                        'error' => 'Ошибка при сохранении данных'
                    ],
                    'success' => false
                ];
            }
        }
        
        if (!empty($language)) {
            try {
                $inQuery = implode(',', array_fill(0, count($language), '?'));
                $dbLangs = $db->prepare("SELECT id, name FROM programming_languages WHERE name IN ($inQuery)");
                foreach ($language as $key => $value) {
                    $dbLangs->bindValue(($key + 1), $value);
                }
                $dbLangs->execute();
                $languages = $dbLangs->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $response = [
                    'messages' => ['error' => 'Ошибка при обработке языков'],
                    'success' => false
                ];
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
    } else {
        $response = [
            'messages' => $messages,
            'errors' => $errors,
            'success' => false
        ];
    }

    if ($is_ajax) {
        header('Content-Type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        if (isset($response['messages']['success'])) {
            $_SESSION['success_message'] = $response['messages']['success'];
        }
        if (isset($response['messages']['info'])) {
            $_SESSION['info_message'] = $response['messages']['info'];
        }
        header('Location: index.php');
        exit();
    }
} else {
    $fio = !empty($_COOKIE['fio_error']) ? $_COOKIE['fio_error'] : '';
    $phone = !empty($_COOKIE['phone_error']) ? $_COOKIE['phone_error'] : '';
    $email = !empty($_COOKIE['email_error']) ? $_COOKIE['email_error'] : '';
    $birth_date = !empty($_COOKIE['birth_date_error']) ? $_COOKIE['birth_date_error'] : '';
    $gender = !empty($_COOKIE['gender_error']) ? $_COOKIE['gender_error'] : '';
    $language = !empty($_COOKIE['language_error']) ? $_COOKIE['language_error'] : '';
    $agree = !empty($_COOKIE['agree_error']) ? $_COOKIE['agree_error'] : '';

    $errors = array();
    $messages = array();
    $values = array();
    $error = true;

    function set_val($str, $pole) {
        global $values;
        $values[$str] = empty($pole) ? '' : strip_tags($pole);
    }

    function check_field($str, $pole) {
        global $errors, $messages, $values, $error;
        if ($error)
            $error = empty($_COOKIE[$str . '_error']);
        $errors[$str] = !empty($_COOKIE[$str . '_error']);
        $messages[$str] = "<div class=\"error\">$pole</div>";
        $values[$str] = empty($_COOKIE[$str . '_value']) ? '' : strip_tags($_COOKIE[$str . '_value']);
        setcookie($str . '_error', '', time() - 30 * 24 * 60 * 60);
        return;
    }
    
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', 100000);
        setcookie('login', '', 100000);
        setcookie('pass', '', 100000);
        $messages['success'] = 'Спасибо, результаты сохранены.';
    }

    check_field('fio', $fio);
    check_field('phone', $phone);
    check_field('email', $email);
    check_field('birth_date', $birth_date);
    check_field('gender', $gender);
    check_field('language', $language);
    /*check_field('bio', $bio);*/
    check_field('agree', $agree);

    $languages = explode(',', $values['language']);
    if ($error && !empty($_SESSION['login'])) {
        try {
            $dbUser = $db->prepare("SELECT u.*, a.* FROM users u 
                                  JOIN application a ON a.id = u.application_id 
                                  WHERE u.id = ?");
            $dbUser->execute([$_SESSION['user_id']]);
            $user_inf = $dbUser->fetchAll(PDO::FETCH_ASSOC)[0];

            $application_id = $user_inf['application_id'];
            $_SESSION['application_id'] = $application_id;

            $dbL = $db->prepare("SELECT pl.name FROM application_languages al
                                JOIN programming_languages pl ON pl.id = al.lang_id
                                WHERE al.app_id = ?");

            $dbL->execute([$application_id]);

            $languages = [];
            foreach ($dbL->fetchAll(PDO::FETCH_ASSOC) as $item)
                $languages[] = $item['name'];

            if ($error && !empty($_SESSION['login'])) {
                set_val('fio', $user_inf['fio']);
                set_val('phone', $user_inf['phone']);
                set_val('email', $user_inf['email']);
                set_val('birth_date', $user_inf['birth_date']);
                set_val('gender', $user_inf['gender']);
                set_val('language', $languages);
                set_val('bio', $user_inf['bio']);
                set_val('agree', $user_inf['agree']);
            } else {
                foreach ($values as $key => $val) {
                    $values[$key] = !empty($_COOKIE[$key.'_value']) ? $_COOKIE[$key.'_value'] : '';
                }
            }
        } catch (PDOException $e) {
            exit();
        }
    }

    if ($is_ajax) {
        ob_end_clean();
        header('Content-Type: application/json');
        
        $response = [
            'messages' => $messages,
            'errors' => $errors,
            'values' => $values,
            'languages' => $languages,
            'log' => $log,
            'success' => !$error
        ];
        
        if (!$error && isset($generated)) {
            $response['generated'] = $generated;
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        include('form.php');
    }
}
?>