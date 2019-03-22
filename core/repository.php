<?php
namespace Core;

use \Core\Db;

/**
 * класс для работы с таблицей countries
 * принимает в коструктор зависимость - объект класса Db
 */

class Repository
{
    /**
     * @var object объект класса Db
     */
    protected $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    /**
     * получение списка всех стран
     * @return array
     */

    public function getCountries()
    {
        return $this->db->getRows("SELECT name, capital, country_code FROM countries");
    }
}