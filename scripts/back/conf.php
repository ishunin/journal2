<?php
define ('DB_HOST', '192.168.43.3');
define ('DB_LOGIN', 'admin');
define ('DB_PASSWORD', 'admin');
define ('DB_NAME', 'admin');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if (mysqli_query($link, "set names utf8")) {
    printf("кодировка utf-8 установлена");
}
else {
    echo "кодировка utf-8 НЕ установлена";
}

if (mysqli_select_db($link, DB_NAME)) {
echo "база ".DB_NAME." выбрана";
}



echo "Соединение с MySQL установлено!" . PHP_EOL;
echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;


?>