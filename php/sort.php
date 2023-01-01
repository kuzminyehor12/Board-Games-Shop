<?php 
    require_once "config.php";
    require_once "functions.php";

    if(isset($_POST['sort_type'])){
        $sort_type = $_POST['sort_type'];
        $sorted_goods = array();

        if($sort_type == 0){
            $sorted_goods = query_to_array("SELECT * FROM `goods` ORDER BY `title` ASC");
        }
        else if($sort_type == 1){
            $sorted_goods = query_to_array("SELECT * FROM `goods` ORDER BY `price` ASC");
        }
        else{
            $sorted_goods = query_to_array("SELECT * FROM `goods`");
        }
        print_good_card($sorted_goods, restrictionFounder($sorted_goods));
        exit();
    }
    else{
        $goods = get_goods();
        exit();
    }

?>