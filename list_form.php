<?php
<<<HERE
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
HERE;
?>
