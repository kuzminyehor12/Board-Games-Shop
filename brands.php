<?php
    session_start();
    require_once "php/config.php";
    require_once "php/functions.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orange-Games</title>
    <link rel="shortcut icon" href="images/925871db899c05172adae868b7ca93c0-orange-color-icon.png">
    <link rel="stylesheet" href="css/style_brands.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <header>
            <div class="header-top">
                <div class="header-wrapper">
                    <nav class="header-nav"> 
                            <div class="header-top-left">
                                <ul>
                                    <li><a href="catalog.php">Каталог</a></li>
                                    <li><a href="#">Новости</a></li>
                                    <li><a href="#">Форум</a></li>
                                    <li><a href="brands.php">Бренды</a></li>
                                    <li><a href="reviews.php">Отзывы</a></li>
                                    <li><a href="#contacts">Контакты</a></li>
                                    <li><a href="#">Корзина</a></li>
                                </ul>  
                            </div>
                            <?php $isLogged = isset($_SESSION) && !empty($_SESSION['email']) && !empty($_SESSION['username']) && !empty($_SESSION['phone']) && !empty($_SESSION['priority']); ?>
                            <div class="header-top-right">
								<?php if (!$isLogged){ ?>
                                <span class="unauth"><img src="images/488165.png" alt="" class="auth-image">
                                </span>
                                <span class="unauth"><a id="login_ref" name="reg" href="#">Вход</a>|<a href="#" id="reg_ref">Регистрация</a></span>
							<?php } ?>
                                <?php if ($isLogged){
                                if(isset($_SESSION) && in_array( 'user', $_SESSION['priority']))
                                    echo "<span class=\"user_icon\"><img src=\"images/userIcon.png\" class=\"user_pict\" alt=\"\"></span>
                                    <span class=\"exit_btn\">Выйти из аккаунта</span>";
                                else{
                                    echo "<span class=\"user_icon\"><img src=\"images/Group 8.png\" class=\"user_pict\" alt=\"\"></span>
                                    <span class=\"exit_btn\">Выйти из аккаунта</span>";
                                }
                            }
                     ?>
                     </div>
                    </nav>            
                </div>
            </div>
            <div class="header-middle">
                <div class="header-wrapper">
                    <a href="index.php">
                        <div class="logo">
                            <img id="logo_image"style="width: 150%;" src="images/Logo_orange.png" alt=""> 
                            <span class="logo-name">Orange-<br>Games</span>      
                    </div>
                    </a>
                <form class="search-bar">
                    <input class="search_input" name="text" name="q" placeholder="поиск товаров" autocomplete="off" value="">
                    <button class="search-btn" name="submit" disabled><img src="images/Search_Icon.svg" class="icon-search"></button>
                </form>
            <div class="basket">
                <img src="images/bag-basket-buy-shopping-ecommerce-icon.svg" alt="" style="width: 25px; margin-right: 10px;">
                <a id="commerce" style="vertical-align: middle; color: #FC6E08; text-transform: none; font-weight: 700;">Корзинка</a>
            </div>
                 </div>
            </div>
            <div class="header-bottom">
                <div class="header-wrapper">
                    <div class="banners">
                        <div class="wide-banner">
                            <img style="width: 100%; height:  100%;" src="images/bottom2-min.png" alt="">
                        </div>
                            <div class="short-banner">
                                <img style="width: 100%; height:  100%;" src="new_goods/photo1.jpg" alt="">
                            </div>
                        </div>
                        <div class="menu">
                                <ul>
                                    <li><a href="catalog.php">Каталог</a>
                                    <?php
                                     if(isset($_SESSION) && !empty($_SESSION['priority'])&& in_array('admin', $_SESSION['priority'])){
                                        ?>
                                                <ul>
                                                <li><a id="insertion_link" href="#">Добавить товар</a></li>
                                                <li><a id="update_link" href="#">Изменить товар</a></li>
                                                <li><a id="deletion_link" href="#">Удалить товар</a></li>
                                                </ul>
                                           <?php 
                                        } ?></li>
                                    <li><a href="#">Хиты продаж</a>
                                    <ul>
                                    <li><a href="good_page.php?id=7">UNO</a></li>
                                        <li><a href="#">Свинтус</a></li>
                                        <li><a href="#">Каркассон</a></li>
                                        <li><a href="#">Имаджинариум</a></li>
                                        <li><a href="good_page.php?id=8">Мафия</a></li>
                                    </ul>
                                </li>
                                    <li><a href="#">Серии игор</a>
                                    <ul>
                                        <li><a href="#">
                                            Манчкин
                                        </a></li>
                                        <li><a href="#">
                                            Кодовые имена
                                        </a></li>
                                        <li><a href="#">
                                            Magic: The Gathering
                                        </a></li>
                                        <li><a href="good_page.php?id=2">
                                        Бэнг
                                    </a></li>
                                    <li><a href="good_page.php?id=5">Диксит</a></li>
                                    </ul>
                                    </li>
                                    <li><a href="#">Аксессуары</a>
                                    <ul>
                                        <li><a href="#">Протекторы для карт</a></li>
                                        <li><a href="#">Коробки для карт</a></li>
                                        <li><a href="#">Кубики</a></li>
                                        <li><a href="#">Фишки и жетоны</a></li>
                                        <li><a href="#">Башни для кубов</a></li>
                                    </ul></li>
                                    <li><a href="#">Форум</a></li>
                                </ul>
                        </div>
                    </div>
            </div>
    </header>
    <main>
        <div class="header-wrapper">
            <h1 style="text-transform:none">Бренды</h1>
            <div class="brand-container">
                <?php 
                    $brands = query_to_array("SELECT * FROM `brands`");
                    print("Бренды, с которыми мы ведём сотрудничество: ");
                    for($i = 0; $i < count($brands); $i++){
                        if($i == count($brands) - 1){
                            print($brands[$i]['title']);
                            break;
                        }
                        print($brands[$i]['title'] . ", ");
                    }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-container">
                <div class="footer-pict">
                    <img src="images/Orange- Games.png" alt="">
                    <div class="footer_info">
                        <p>&#169 2021</p>
                        <p>Orange-Games — магазин настольных игор</p>
                    </div>
                </div>
                <div class="clients">
                    <ul><p><b>Клиентам:</b></p>
                        <li><a href="index.php">Главная</a></li>
                        <li><a href="catalog.php">Каталог</a></li>
                        <li><a href="#reg">Вход</a></li>
                        <li><a href="#">Корзина</a></li>
                        <li><a href="#">Форум</a></li>
                        <li><a href="#">Новости</a></li> 
                    </ul>
                </div>
                <div class="social">
                    <ul><p><b>Сети:</b></p>
                        <li><img style="width: 20px; height: 17px;" src="images/Group 4.png" alt=""><span><a name="contacts" href="#">orange-games@gmail.com</a></span></li>
                        <li><img style="width: 20px; height: 20px;" src="images/Group 5.png" alt=""><span><a href="#">@mushroom_eye</a></li></span>
                        <li><img style="width: 20px; height: 20px;" src="images/Group 6.png" alt=""><span><a href="#">mushroom_eye</a></span></li>
                        <li>
                            <img style="width: 20px; height: 20px;" src="images/Group 7.png" alt=""><span><a href="#">(+38) 099-099-06-72</a></span>
                        </li>
                </div>
            </ul>
        </div>
    </footer>
    <?php if (!$isLogged){ ?>
    <div class="popup-login hidden">
        <div class="popup_content">
            <span class="close_btn">X</span>
            <form class="form" name="log" id="login" action="php/signup.php" method="post">
                <h1 class="form_title">Вход</h1>
                <hr>
                <p class="log-error-message hidden">Данные введены неправильно, либо такого аккаунта ещё не существует</p>
                <div class="form-input_group">
                    <input id = "log_email" name="email" class="form-input" autofocus placeholder="Электронная почта">
                </div>
                <div class="form-input_group">
                    <input id = "log_password" name="password" class="form-input" autofocus placeholder="Пароль">
                </div>
                <button class="form_button" name="submit">Продолжить</button>
                <p class="form-text">
                    <a href="#" class="forgot_link">Забыли пароль?</a>
                </p>
                <p class="form-text">
                    <a class="regist_link" href="#" id="createAccount" >Нету аккаунта? Зарегистрироваться!</a>
                </p>
            </form>
        </div>
    </div>
    <div class="popup-register hidden">
        <div class="popup_content">
            <span class="close_btn">X</span>
            <form class="form" action="php/registration.php" method="post" name="reg" id="register">
                <h1 class="form_title">Регистрация</h1>
                <hr>
                <div class="form-input_group">
                    <p class="email-error-message hidden">Не соответствующий формат эл. почты</p>
                    <input name="email" id="reg_email" type="email" class="form-input" autofocus placeholder="Электронная почта">
                </div>
                <div class="form-input_group">
                    <input name="username" id="username" type="text" class="form-input" autofocus placeholder="Имя пользователя">
                </div>
                <p class="age-error-message hidden">Нельзя ввести данный возраст</p>
                <div class="form-input_group" style="display: inline;">
                    <input name="age" id = "age" class="form-input" autofocus placeholder="Возраст">
                </div>
                <p class="state-error-message hidden">Не выбран пол</p>
                <div class="form-input_group state">
                    <span style="font-size: 20px; color:black;">Пол:</span>
                    <div class="form_radio">
                        <input type="radio" name="radio-group" id="stateM" class="form-input"><label for="stateM">Мужчина</label>
                    </div>
                   <div class="form_radio">
                        <input type="radio" name="radio-group" id="stateF" class="form-input"><label for="stateF">Женщина</label>
                   </div>
                </div>
                <p class="tel-error-message hidden">Не соответствующий формат номера телефона</p>
                <div class="form-input_group">
                    <input type="tel"  id = "phone" name="telephone_number" class="form-input" autofocus placeholder="Телефон">
                </div>
                <p class="password-error-message hidden">Пароль слишком простой или не совпадает с повторным вводом!</p>
                <div class="form-input_group">
                    <input name="password" id = "reg_pass" type="password"  class="form-input" autofocus placeholder="Пароль">
                </div>
                <div class="form-input_group">
                    <input name="confirm" id="confirm" type="password" class="form-input" autofocus placeholder="Подтверждение пароля">
                </div>
                <p class="account-error-message hidden">Такой аккаунт уже существует!</p>
                <button class="form_button" id="register_btn" type="submit">Зарегистрироваться</button>
                <p class="form-text">
                    <a class="login_link" href="./" id="loginIn" >Уже есть аккаунт? Зайдите в него!</a>
                </p>
                <button class="reload_btn" type="reset" name="reload"></button>
            </form>
        </div>
    </div>
<?php } ?>
    <div class="popup-insert hidden">
      <div class="popup_content">
        <span class="close_btn">X</span>
        <form class="form" id="good_insertion" action="php/insert.php" method="post">
            <h1 class="form_title">Добавление товара</h1>
            <hr>
            <div class="form-input_group">
                <input class="form-input" id="title" name="id" type="text" placeholder="Введите артикул товара">
            </div>
            <div class="form-input_group">
                <input class="form-input" id="title" name="title" type="text" placeholder="Введите название товара">
            </div>
            <div class="form-input_group">
            <input class="form-input" id="image" name="image" type="text" placeholder="Введите название файла">
            </div>
            <div class="form-input_group">
                <textarea class="form-input" id="short_desc" name="short_desc" placeholder="Введите краткое описание товара"></textarea>
            </div>
            <div class="form-input_group">
                <textarea class="form-input" id="long_desc" name="long_desc" placeholder="Введите  подробное описание товара"></textarea>
            </div>
            <div class="form-input_group">
                <input class="form-input" type="text" id="price" name="price" placeholder="Введите цену товара(в гривнах)">
            </div>
            <div class="form-input_group">
                <input class="form-input " type="text" id="quantity" name="quantity" placeholder="Введите количество товара на складе">
            </div>
            <div class="form-input_group">
                <input class="form-input" type="text" id="brand" name="brand" placeholder="Номер бренда">
            </div>
            <button class="form_button" id="insert_btn" type="submit">Утвердить товар</button>
            <button class="reload_btn" type="reset" name="reload"></button>
        </form>
      </div>
    </div>
    <div class="popup-update hidden">
        <div class="popup_content">
            <span class="close_btn">X</span>
            <form class="form" id="good_update" action="php/update.php" method="post" enctype="multipart/form-data">
            <h1 class="form_title">Изменение товара</h1>
            <hr>
            <div class="form-input_group">
                <input class="form-input" type="text" id="code" name="vendorCode" placeholder="Введите артикул товара">
            </div>
            <div class="form-input_group">
                <select name="update" id="update_selection">
                    <option value="0">Изменить название</option>
                    <option value="1">Изменить картинку</option>
                    <option value="2">Изменить цену</option>
                    <option value="3">Изменить количество</option>
                </select>
            </div>
            <div class="form-input_group" id="selected_option" ></div>
            <button class="form_button" id="update_btn" type="submit">Утвердить товар</button>
            <button class="reload_btn" type="reset" name="reload"></button>
            </form>
        </div>
    </div>
    <div class="popup-delete hidden">
        <div class="popup_content">
            <span class="close_btn">X</span>
            <form class="form" action="php/delete.php" method="post" id="good_deletion">
            <h1 class="form_title">Удаление товара</h1>
            <div class="form-input_group">
                <input class="form-input" type="text" id="code" name="vendorCode" placeholder="Введите артикул товара">
            </div>
            <button class="form_button" id="delete_btn" type="submit">Удалить товар</button>
            <button class="reload_btn" type="reset" name="reload"></button>
            </form>
        </div>
    </div>
</body>
</html>