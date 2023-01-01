<?php
require_once "config.php";
require_once "functions.php";

if(isset($_POST)){
    if(!empty($_POST['category'])){
        $filtered_goods = query_to_array("SELECT DISTINCT * FROM goods LEFT OUTER JOIN goodsncat ON goodsncat.vendorCode = goods.vendorCode WHERE goodsncat.categoryID IN (" . $_POST['category'] . ")");
        print_good_card($filtered_goods, restrictionFounder($filtered_goods));
    }
    else{
        print_good_card(get_goods(), restrictionFounder(get_goods()));
        exit();
    }
}


/*
if(isset($_POST) && !empty($_POST['category'])){
    $cats = $_POST['category'];

    $string = "";
    for($i = 0; $i < count($cats); $i++){
        if($i == 0){
            $string .= $cats[$i];
        }
        else    {
            $string .= ',' . $cats[$i];
        }

        $filtered_goods = query_to_array("SELECT * FROM goods LEFT OUTER JOIN goodsncat ON goodsncat.vendorCode = goods.vendorCode WHERE goodsncat.categoryID IN ($string)");
        print_good_card($filtered_goods, restrictionFounder($filtered_goods));
        exit();
    }    
}
else{
    print_good_card(get_goods(), restrictionFounder(get_goods()));
    exit();
}*/
?>