<?php
//Если переменная Name передана

if (isset($_POST["Content"])) {
    //Если это запрос на обновление, то обновляем
    if (isset($_GET['red_id'])) {
        #`Jira_num`, `Content`, `Action`, `Author`, `Destination`
        $sql = mysqli_query($link, "UPDATE `list` SET `Jira_num` = '{$_POST['Jira_num']}',`Content` = '{$_POST['Content']}',`Action` = '{$_POST['Action']}',`Author` = '{$_POST['Author']}',`Destination` = '{$_POST['Destination']}'  WHERE `ID`={$_GET['red_id']}");
    } else {
        //Иначе вставляем данные, подставляя их в запрос
        $sql = mysqli_query($link, "INSERT INTO `list` (`Jira_num`, `Content`, `Action`, `Author`, `Destination`, `Edit_date`, `Create_date`) VALUES 
        ('{$_POST['Jira_num']}', '{$_POST['Content']}', '{$_POST['Action']}','{$_POST['Author']}','{$_POST['Destination']}',123,123)");
    }

    //Если вставка прошла успешно
    if ($sql) {
      echo '<p>Успешно!</p>';
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }

  if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
    //удаляем строку из таблицы
    $sql = mysqli_query($link, "DELETE FROM `list` WHERE `ID` = {$_GET['del_id']}");
    if ($sql) {
      echo "<p>Запись удалена.</p>";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
  }

  //Если передана переменная red_id, то надо обновлять данные. Для начала достанем их из БД
  
  if (isset($_GET['red_id'])) {
    $sql = mysqli_query($link, "SELECT `Jira_num`, `Content`, `Action`, `Author`, `Destination` FROM `list` WHERE `ID`={$_GET['red_id']}");
    $product = mysqli_fetch_array($sql);
  }

 # include "list_form.php";
  ?>

<form action="" method="post">
  <table id="example1" class="table table-bordered table-striped">
    <tr>

      <td>INM:</td>
      <td><input type="text" name="Jira_num" value="<?= isset($_GET['red_id']) ? $product['Jira_num'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Содержание:</td>
      <td><input type="text" name="Content" size="50" value="<?= isset($_GET['red_id']) ? $product['Content'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Действие:</td>
      <td><input type="text" name="Action" size="50" value="<?= isset($_GET['red_id']) ? $product['Action'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Автор:</td>
      <td><input type="text" name="Author" size="20" value="<?= isset($_GET['red_id']) ? $product['Author'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>Расположение:</td>
      <td><input type="text" name="Destination" size="10" value="<?= isset($_GET['red_id']) ? $product['Destination'] : ''; ?>"></td>
    </tr>

    <tr>
      <td colspan="2"><input type="submit" value="OK"></td>
    </tr>
  </table>
</form>


<table id="example1" class="table table-bordered table-striped">
<thead>
  <tr>
  <th class="snorting">ID</th>
  <th class="snorting">№</th>
  <th class="snorting">Содержание инцидента</th>
  <th class="snorting">Выполненные действия</th>
  <th class="snorting">Автор</th>
  <th class="snorting">Расположение</th>
    <th class="snorting">Отред.</th>
    <th class="snorting">Создано</th>
    <th class="snorting">Удаление</th>
    <th class="snorting">Редактирование</th>
  </tr>
</thead>
  <?php
    $sql = mysqli_query($link, 'SELECT `ID`, `ID_shift`, `Jira_num`, `Content`, `Action`, `Author`,`Destination`,`Edit_date`,`Create_date`  FROM `list`');
    echo '<tbody>';
    while ($result = mysqli_fetch_array($sql)) {
      echo '<tr>' .
           "<td>{$result['ID']}</td>" .
           "<td>{$result['Jira_num']}</td>" .
           "<td>{$result['Content']}</td>" .
           "<td>{$result['Action']}</td>" .
           "<td>{$result['Author']}</td>" .
           "<td>{$result['Destination']}</td>" .
           "<td>{$result['Edit_date']}</td>" .
           "<td>{$result['Create_date']}</td>" .
           "<td><a href='?del_id={$result['ID']}'>Удалить</a></td>" .
           "<td><a href='?red_id={$result['ID']}'>Изменить</a></td>" .
           '</tr> 

           ';
    }
   echo ' </tbody> <tfoot>
           <tr>
             <th>Идентификатор</th>
  <th>№</th>
  <th>Содержание инцидента</th>
  <th>Выполненные действия</th>
  <th>Автор</th>
  <th>Расположение</th>
    <th>Отредактировано</th>
    <th>Создано</th>
    <th>Удаление</th>
    <th>Редактирование</th>
           </tr>
           </tfoot>';
              ?>
              </table>
<p><a href="?add=new">Добавить новый товар</a></p>