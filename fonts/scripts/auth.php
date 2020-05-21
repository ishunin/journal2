<?php
$res = mysqli_connect("localhost", "root", 12345, 3306);
if ($res) {
    echo "ok";
}
else {

    echo "Problem with connect to db"
}
?>