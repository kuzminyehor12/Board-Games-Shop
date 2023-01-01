<?php 
    require_once "config.php";
    require_once "functions.php";
    
    $keyword = htmlspecialchars($_GET['text']);

    $search_goods = query_to_array("SELECT * FROM `goods` WHERE `title` LIKE '%" . $keyword . "%'");
    print_good_card($search_goods, restrictionFounder($search_goods));
?>