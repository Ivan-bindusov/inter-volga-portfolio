<?php

/**
 * данный файл принимает AJAX запрос с массивом POST, осуществляет серверную валидацию данных
 * и производит добавление новой записи в таблицу countries
*/

include_once __DIR__."/db.php";

$db = \Core\Db::getInstance();

$data = [];
foreach($_POST as $key => $val)
{
    $data[$key] = $val;
}

$messages = [];

/**
 * валидация данных
 */
if(!preg_match("~[а-яa-zё]~ui", $data["name"]))
{
    $messages[] = "Поле имя должно содержать только символы алфавита";
}

if(!preg_match("~[а-яa-zbё]~ui", $data["capital"]))
{
    $messages[] = "Поле столица должно содержать только символы алфавита";
}

if(!preg_match("~[0-9]~i", $data["code"]))
{
    $messages[] = "Поле код страны должно содержать только цифры";
}

/**
 * подготовка к выводу сообщений об ошибках валидации
 */

if(sizeof($messages) > 0)
{
    $string = "";
    $i=0;
    foreach($messages as $message)
    {
        $string .= $message;
        if(isset($messages[++$i])) $string .= "<br>";
    }
    echo json_encode(["result" => "fail", "message" => $string]);
    return false;
}

/**
 * запись данных в таблицу countries
 */

$res = $db->executeQuery("INSERT INTO countries (name, capital, country_code) VALUES (:name, :capital, :code)",
["name" => $data["name"], "capital" => $data["capital"], "code" => $data["code"]]);

if($res){
    echo json_encode(
        ["result" => "success",
        "message" => "Запись успешно добавлена",
        "name" => $data["name"],
        "capital" => $data["capital"],
        "code" => $data["code"]]
    );
}else{
    echo json_encode(["result" => "fail", "message" => "Не удалось добавить запись"]);
}

