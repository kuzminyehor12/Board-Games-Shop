<?php    
    require_once 'config.php';

    function query_to_array($query){
        global $connection;
        $res = mysqli_query($connection, $query);
        $array = array();

        while($row = mysqli_fetch_assoc($res)){
            $array[] = $row;
        }

        return $array;
    }

    function get_categories(){
        $res = query_to_array("SELECT * FROM `categories`");
        return $res;
    }

    function get_goods(){
        $res = query_to_array("SELECT * FROM `goods`");
        return $res;
    }

    function print_to_list($array){
        if(count($array) > 10){
            print('<div style="width:100%; height: 200px; overflow-y: scroll;">');
                print("<ul>");
                
                    for($i = 0; $i < count($array); $i++){
                        print("<li><input class=\"category_box\" type=\"checkbox\" name=\"category[]\" value=\"" . $array[$i]['id'] . "\">  " . $array[$i]['title'] . "</input></li>");
                    }

                print("</ul>");
            print("</div>");
        }
        else{
            print("<ul>");
            for($i = 0; $i < count($array); $i++){
                print("<li><input class=\"category_box\" type=\"checkbox\" name=\"category[]\" value=\"" . $array[$i]['id'] . "\" oncheck=\"isChecked(event)\">  " . $array[$i]['title'] . "</input></li>");
            }
            print("</ul>");
        }
    }

    function print_good_card($array, $rest){
        for($i = 0; $i < count($array); $i++){
            echo " <div class=\"good-card\">
            <div class=\"good-img\">
            <img style = \"width: 100%;height: 100%\" src=\"goods_images/" . $array[$i]['image'] . ".jpg\" alt=\"\">
            </div> <div class=\"good-title\">
            <span>Артикул: " . $array[$i]['vendorCode'] . "</span><br>
            <span class=\"restriction\">" . $rest[$i] . "<br>
            <a href=\"good_page.php?id=". $array[$i]['vendorCode'] . "\">" . $array[$i]['title'] . "</a>
            </div>
            <div class=\"commerce-info\">
            <span style=\"font-size: 20px; font-weight: 700\" class=\"price\">" . $array[$i]['price'] . " грн</span>
            <button class=\"buying-btn\">Купить</button>
            </div>
            </div>";  
        }
    }

    function restrictionFounder($array){
        $restriction = array();

        for($i = 0; $i < count($array); $i++){
            if($array[$i]['quantity'] == 0){
                $restriction[$i] = "Нет в наличии";
            }
            else{
                $restriction[$i] = "Есть в наличии";
            }
        }
        return $restriction;
    }

    function reviewGenerator($array){
        for($i = 0; $i < count($array); $i++){
            print("<div class=\"review-container\"><p style=\"text-transform:none; font-size: 16px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;\">Пользователь: " . $array[$i]['username'] ."</p><br>
            <div  style=\"width: 80% margin: 0 auto; background-color: white; padding: 10px 10px; border: 1px solid black;\">" . $array[$i]['description'] . "</div></div><br>");
        }
    }

    function separate_categories($array, $str){
        $subarr = array();
        for($i = 0; $i < count($array); $i++){
            if($array[$i]['type'] == $str){
                $subarr[] = $array[$i];
            }
        }

        if(!empty($subarr)){
            echo "<p style=\"text-transform: none;
            padding: 5px 10px; font-size: 20px;\">" . $str . ": ";
            for($i = 0; $i < count($subarr); $i++){
                if($i == count($subarr) - 1){
                    echo $subarr[$i]['title'] . "</p";
                    break;
                }
                echo $subarr[$i]['title'] . ", ";
            }
            echo "<br>";
        }
    }

    /*function make_href($str){
        $game = query_to_array("SELECT * FROM `goods` WHERE `title` = '" . $str . "'");
        if(isset($game)){
            echo "<a href=\"good_page.php?id=". $game['vendorCode'] . "\">" . $str . "</a>";
        }
        else{
            echo "<a href=\"#\">" . $str . "</a>";
        }
    }*/
?>