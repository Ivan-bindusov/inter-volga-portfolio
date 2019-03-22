<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель добавления стран</title>

    <!-- Bootstrap -->
    <link href="assets/libs/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<div class="overflow">
    <div class="popup">
        <form action="">
                <div class="form-group">
                    <label for="name">Введите название страны:</label>
                    <input id="name" name="name" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for="capital">Введите столицу страны:</label>
                    <input id="capital" name="capital" class="form-control" type="text">
                </div>

                <div class="form-group">
                    <label for="code">Введите код страны:</label>
                    <input id="code" name="code" class="form-control" type="text">
                </div>
                <button id="submit-country" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>