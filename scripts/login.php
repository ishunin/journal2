<?php
  # Функция для генерации случайной строки
  function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;
  }
 
  # Если есть куки с ошибкой то выводим их в переменную и удаляем куки
  if (isset($_COOKIE['errors'])){
      $errors = $_COOKIE['errors'];
      setcookie('errors', '', time() - 60*24*30*12, '/');
  }

  # Подключаем конфиг
  include 'conf.php';

  if(isset($_POST['submit']))
  {
   
    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $data = mysqli_fetch_assoc(mysqli_query($link,"SELECT users_id, users_password FROM `users` WHERE `users_login`='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1"));
     
    # Соавниваем пароли
    #if($data['users_password'] === md5(md5($_POST['password'])))
    if($data['users_password'] === ($_POST['password']))
    {
      # Генерируем случайное число и шифруем его
      $hash = md5(generateCode(10));
           
      # Записываем в БД новый хеш авторизации и IP
      mysqli_query($link,"UPDATE users SET users_hash='".$hash."' WHERE users_id='".$data['users_id']."'") or die("MySQL Error: " . mysqli_error($link));
       
      # Ставим куки
      setcookie("id", $data['users_id'], time()+60*60*24*30);
      echo "sadas";

      echo "<br>".$_COOKIE['id'];
      setcookie("hash", $hash, time()+60*60*24*30);
     echo "<br>".$_COOKIE['hash'];
       
      # Переадресовываем браузер на страницу проверки нашего скрипта
      header("Location: index.php"); exit();
    }
    else
    {
      print "Вы ввели неправильный логин/пароль<br>";
    }
  }
?>
  <form method="POST">
  Логин <input name="login" type="text"><br>
  Пароль <input name="password" type="password"><br>
  <input name="submit" type="submit" value="Войти">
  </form>
  <?php
  # Проверяем наличие в куках номера ошибки
  if (isset($errors)) {print '<h4>'.$errors.'</h4>';}

  ?>