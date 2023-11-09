<?php
$allowed_extensions = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'rar', 'zip'); // Разрешенные расширения файлов
$max_size = 10485760; // Максимальный размер файла (10 МБ)
$upload_dir = 'uploads/'; // Папка для загрузки файлов
$error = null;

// Обрабатываем загрузку файла 
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Проверяем тип и размер файла
    if (!in_array(strtolower(pathinfo($file['name'], PATHINFO_EXTENSION)), $allowed_extensions)) {
        $error = 'Запрещенный тип файла';
    } elseif ($file['size'] > $max_size) {
        $error = 'Файл слишком большой';
    } else {
        // Загружаем файл на сервер
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $filename = time() . '_' . $file['name'];
        move_uploaded_file($file['tmp_name'], $upload_dir . $filename);

        // Сохраняем информацию о файле в базе данных
        $pdo = new PDO('mysql:host=localhost;dbname=your_database_name;charset=utf8', 'your_database_username', 'your_database_password');
        $stmt = $pdo->prepare('INSERT INTO files (file_name, file_size) VALUES (?, ?)');
        $stmt->execute(array($filename, $file['size']));
        
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Загрузка файла</title>
</head>
<body>
    <h1>Загрузка файла</h1>
    <?php if ($error): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <br><br>
        <input type="submit" value="Загрузить">
    </form>
</body>
</html>