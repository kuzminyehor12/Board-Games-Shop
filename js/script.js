$(document).ready(function() {
    $("#login_ref").on("click", e =>{
        e.preventDefault();
        $(".popup-login").removeClass("hidden");
    })

    $("#reg_ref").on("click", e =>{
        e.preventDefault();
        $(".popup-register").removeClass("hidden");
    })

    $(".close_btn").on("click", e =>{
        e.preventDefault();
        $(".popup-register").addClass("hidden");
        $(".popup-login").addClass("hidden");
        $(".popup-insert").addClass("hidden");
        $(".popup-update").addClass("hidden");
        $(".popup-delete").addClass("hidden");

        $(".popup-register").reset();
        $(".popup-login").reset();
        $(".popup-insert").reset();
        $(".popup-update").reset();
        $(".popup-delete").reset();
        $("form p").addClass("hidden");
        $("form input").removeClass("success");
        $("form input").removeClass("error");
    })

    let error = 0;
    let authorize = false;

    $("#register").on("submit", function() {
		event.preventDefault();
        let email = $("#reg_email").val();
        let username = $("#username").val();
        let phone = $("#phone").val();
        let age = $("#age").val();
        let pass = $("#reg_pass").val();
        let confirm = $("#confirm").val();
        $.ajax({
            url: "php/registration.php",
            type: "POST",
            data:{"email":email, "telephone_number": phone, "username" : username
            , "age": age, "password": pass,
            "confirm" : confirm},
			dataType: "json",
            success: function(data) {
                if(data.result == "success"){
					document.location.reload();
                }
                else{
					$("#email").addClass("success");
                    $("#username").addClass("success");
                    $("#age").addClass("success");
                    $("#phone").addClass("success");
                    $("#reg_pass").addClass("success");
                    $("#confirm").addClass("success");
                    for(var i in data.error_number){
						
                        if(i == 0){
                            $(".email-error-message").removeClass("hidden");
                            $("#reg_email").addClass("error");
                            $("#reg_email").removeClass("success");
                        }
                        if(i == 1){
							$(".age-error-message").removeClass("hidden");
                            $("#age").addClass("error");
							$("#age").removeClass("success");
                        }
						
                        if(i == 2){
                            $("#username").addClass("error");
							$("#username").removeClass("success");
                        }
    
                        if(i == 3){
                            $(".tel-error-message").removeClass("hidden");
                            $("#phone").addClass("error");
                            $("#phone").removeClass("success");
                        }
                        if(i == 4){
                            $(".password-error-message").removeClass("hidden");
                            $("#reg_pass").addClass("error");
                            $("#reg_pass").removeClass("success");
                            $("#confirm").addClass("error");
                            $("#confirm").removeClass("success");
                        }
                    }
                }

                
            },
            error: function() {
                alert("Fail!");
            }
        })
        return false;
    })

    $("#login").on("submit", function(){
		event.preventDefault();
        let email = $("#log_email").val();
        let pass = $("#log_password").val();
        $.ajax({
            url: "php/signup.php",
            type: "POST",
            data:{"email":email, "password": pass},
			dataType: "json",
            success: function(data){
                if(data.result == "success"){
					document.location.reload();
                    $(".popup-login").addClass("hidden");
                    $(".unauth").addClass("hidden");
                    //$(".header-top-right span").toggleClass("hidden");
                    $("#login").reset();
                    authorize = true;
					
                }
                else{
                    $(".log-error-message").removeClass("hidden");
                }
            },
            error: function(){
                alert("Fail!");
            }
        })
        return false;
    })

    $(".exit_btn").on("click", e => {
        e.preventDefault();
        $(".unauth").removeClass("hidden");
        $.get("php/clearsession.php");
		document.location.reload();
        //$(".header-top-right span").toggleClass("hidden");
    })

    $(".reload-btn").on("click", e =>{
        e.preventDefault();
        $("form").reset();
        $("form").removeClass("hidden");
    })

    $("#loginIn").on("click", e =>{
        e.preventDefault();
        loginIn();
    })

    $("#createAccount").on("click", e =>{
        e.preventDefault();
        createAccount();
    })

    $("#sort").on("change", function() {
        let sort_type = $(this).val();

        $.ajax({
            url: "php/sort.php",
            type: "POST",
            data: {"sort_type": sort_type},
            success: function(data){
                $(".content").html(data);
            },
            error: function(){
                alert("Fail");
            }
        })
    })

    $(".category_box").on("change", function(){
		let iter = 0;
		let request = '';
		$('.category_box:checked').each(function(){
			if (iter == 0) {
				request += $(this).val();
			} else {
				request += ',' + $(this).val();
			}
			iter++;
		});

        $.ajax({
            url: "php/filter.php",
            type: "POST",
            data: {"category": request},
            success: function(data) {
                $(".content").html(data);
            },
            error: function(){
                alert("Fail!");
            }
        });
    })

    /*$(".category_box").on("change", function(){
        let category = $(this).attr("value");

        $.ajax({
            url: "php/filter.php",
            type: "POST",
            data: {"category": category},
            success: function(data) {
                $(".content").html(data);
            },
            error: function(){
                alert("Fail!");
            }
        });
    })*/

    $("#insertion_link").on("click", function(e){
        e.preventDefault();
        $(".popup-insert").removeClass("hidden");
    })

    $("#update_link").on("click", function(e){
        e.preventDefault();
        $(".popup-update").removeClass("hidden");
    })

    $("#update_selection").on("change", function(){
        let update_type = $(this).val();

        if(update_type == 0){
            $("#selected_option").html('<div class="form-input_group"><input class="form-input" type="text" name="selected_option" placeholder="Введите новое название товара"></div>');
        }
        else if(update_type == 1){
            $("#selected_option").html('<div class="form-input_group"><label for="image">Вставьте новое картинку товара</label><input class="form-input" name="selected_option"  type="file"></div>');
        }
        else if(update_type == 2){
            $("#selected_option").html('<div class="form-input_group"><input class="form-input" name="selected_option"  type="text" placeholder="Введите новую цену товара(в гривнах)"></div>'); 
        }
        else{
            $("#selected_option").html('<div class="form-input_group"><input class="form-input" type="text" name="selected_option"  placeholder="Введите новое количество товара"></div>'); 
        }
    })

    $("#deletion_link").on("click", function(e){
        e.preventDefault();
        $(".popup-delete").removeClass("hidden");
    })
    
    function loginIn() {
        $(".popup-login").removeClass("hidden");
        $(".popup-register").addClass("hidden");
    }

    function createAccount() {
        $(".popup-login").addClass("hidden");
        $(".popup-register").removeClass("hidden");
    }
})