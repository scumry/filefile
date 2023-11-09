<?php
require_once ("database.php");  
$stmt = $pdo->query('SELECT * FROM files');
$files = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Список файлов</title>
</head>
<body>
    <h1>Список файлов</h1>
    <table>
        <thead>
            <tr>
                <th>Название файла</th>
                <th>Размер файла</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><a href="<?php echo 'uploads/' . $file['file_name']; ?>" target="_blank"><?php echo $file['file_name']; ?></a></td>
                    <td><?php echo $file['file_size']; ?> байт</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>