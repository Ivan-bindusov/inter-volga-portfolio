<?php

define("BASEDIR", dirname(__FILE__));

include_once BASEDIR."/core/autoload.php";

$db = Core\Db::getInstance();
$repository = new Core\Repository($db);

/**
 * получение списка стран
 */
$countries = $repository->getCountries();

?>

<?php

include BASEDIR."/templates/header.php";

?>
  
<div class="container">
      <div class="row">
          <div class="col-md-12">
                <?php if(sizeof($countries) > 0): ?>

                    <ul class="list-group">

                        <?php foreach($countries as $country): ?>

                            <li class="list-group-item">
                                <b>Страна</b> - <?=htmlspecialchars($country["name"])?>
                                <b>Столица</b> - <?=htmlspecialchars($country["capital"])?>
                                <b>Код страны</b> - <?=htmlspecialchars($country["country_code"])?>
                            </li>

                        <?php endforeach ?>

                    </ul>

                <?php endif ?>
          </div>
      </div>

      <div class="row">

          <div class="col-md-12">

                <button id="add-country" class="btn btn-primary">Добавить страну</button>

          </div>

      </div>

</div>

<?php

include BASEDIR."/templates/footer.php";

?>