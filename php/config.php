<?php
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "orange-games-database");

$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("Нет соединение с базой данных!");
mysqli_set_charset($connection, "utf8") or die("Проблема с кодировкой");
?>