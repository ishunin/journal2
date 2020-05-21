<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Журнал ЭТИ№1 - Главная</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/main.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="dist/css/fonts.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Журнал Дежурных ЭТИ!</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Авторизуйтесь для работы с системой</p>
      



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
  include 'scripts/conf.php';

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

      echo "<br>".$_COOKIE['id'];
      setcookie("hash", $hash, time()+60*60*24*30);
     echo "<br>".$_COOKIE['hash'];
       
      # Переадресовываем браузер на страницу проверки нашего скрипта
      header("Location: index.php"); exit();
    }
    else
    {
      echo '
      <div class="info-box mb-3 bg-danger">
              

              <div class="info-box-content">
              Неверный логин / пароль
                <span class="info-box-number"></span>
              </div>
              <!-- /.info-box-content -->
            </div>
          ';
    }
  }
?>
      <form method="POST">
        <div class="input-group mb-3">
          <input name="login" type="login" class="form-control" placeholder="логин">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input name="password" type="password" class="form-control" placeholder="пароль">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Запомнить меня
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button name="submit" type="submit" class="btn btn-primary btn-block">Войти</button>
            
          </div>
          <!-- /.col -->
        </div>
      </form>
      <?php
  # Проверяем наличие в куках номера ошибки
  if (isset($errors)) {print '<h4>'.$errors.'</h4>';}

  ?>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
