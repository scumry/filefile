<?php
$link = mysqli_connect("localhost","root","","sqlllFile.db");
if (mysqli_connect_errno()) {
    echo "Ошибка подключения (".mysqli_connect_errno()."): ". mysqli_connect_error();
    exit();

}
