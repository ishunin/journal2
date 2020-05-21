<?php
# Подключаем конфиг
include 'conf.php';
if(isset($_POST['submit']))
{
    $err = array();

    # проверям логин
   if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
     
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
     
    # проверяем, не сущестует ли пользователя с таким именем
  $query = mysql_query("SELECT COUNT(users_id) FROM users WHERE users_login='".mysql_real_escape_string($_POST['login'])."'")or die ("<br>Invalid query: " . mysql_error());
    if(mysql_result($query, 0) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }
 
     
    # Если нет ошибок, то добавляем в БД нового пользователя
   if(count($err) == 0)
    {
         
        $login = $_POST['login'];
         
        # Убераем лишние пробелы и делаем двойное шифрование
       $password = md5(md5(trim($_POST['password'])));
         
        mysql_query("INSERT INTO users SET users_login='".$login."', users_password='".$password."'");
        header("Location: login.php"); exit();
    }
}
?>

  <form method="POST" action="">
  Логин <input type="text" name="login" id="reg_inp" /><br />
  Пароль <input type="password" name="password" id="reg_inp" /><br />
  <input name="submit" type="submit" value="Зарегистрироваться">
  </form>
  <?php
    if (isset($err)) {
      print "<b>При регистрации произошли следующие ошибки:</b><br>";
      foreach($err AS $error)
      {
        print $error."<br>";
      }  
    }
  ?>