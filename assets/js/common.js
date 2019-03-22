$(document).ready(function(){

    var host = "http://inter-volga";

    $("#add-country").click(function(){ //всплывающая форма добавления страны
        $(".overflow").fadeIn();
    });

    $(".overflow").click(function(){ //скрытие формы
        $(this).fadeOut();
    });

    $(".popup").click(function(e){
        e.stopPropagation();
    });

    function alertDanger(message){ //сообщение об ошибке
        $(".alert").remove();
        $("<div class='alert alert-danger'>"+message+"</div>").hide().prependTo(".popup").fadeIn();
    }

    function alertSuccess(message){ //сообщение об успехе
        $(".alert").remove();
        $("<div class='alert alert-success'>"+message+"</div>").hide().prependTo(".popup").fadeIn();
    }

    function liItem(data){ //html код для добавления пункта
        return '<li class="list-group-item"><b>Страна</b> - '
            + escape(data.name) +
            ' <b>Столица</b> - '
            + escape(data.capital) +
            ' <b>Код страны</b> - '
            + escape(data.code) +
        '</li>';
    }

    function escape(string){ //экранирование потенциально опасных символов
        var escapes = {      //при выводе вновь добавленных записей
            '&': 'amp',
            '<': '*',
            '>': '*',
            '"': '*',
            "'": '*'
        };
        return string.replace(/[&<>"']/g, function(match){
            return escapes[match];
        });
    }

    $("body, .popup").click(function(){ //закрыть окно предупреждения при клике мышью
        $(".alert").fadeOut(300, function(){
            $(this).remove();
        });
    });

    $("#submit-country").click(function(e){ //получаем данные из формы, первичная валидация на клиенте
        e.preventDefault();                 //и отправка на сервер
        e.stopPropagation();
        var form = $(this).parent("form");
        var name = form.find("input[name=name]").val();
        var capital = form.find("input[name=capital]").val();
        var code = form.find("input[name=code]").val();
        if(name === "" || capital === "" || code === ""){
            alertDanger("Заполните все поля");
        }else{
            $.ajax({
                method: "POST",
                data: form.serialize(),
                cache: false,
                url: host+"/core/add_country.php",
                success: function(data){
                    data = JSON.parse(data);
                    if(data.result == "success"){
                        $(".list-group").append(liItem(data));
                        alertSuccess(data.message);
                    }else{
                        alertDanger(data.message);
                    }
                }
            });
        }
    });
});