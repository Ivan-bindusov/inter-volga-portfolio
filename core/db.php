<?php
namespace Core;

/**
 * класс соединения с БД
 * реализован паттерном singlton
 */

class Db
{
    /**
     * @var self объект текущего класса
     */
    private static $instance;

    /**
     * @var объект класса pdo
     */
    private static $pdo;

    private static $host = "127.0.0.1";
    private static $db_name = "portfolio";
    private static $user_name = "root";
    private static $password = "";
    private static $charset = "utf8";
    private static $settings = [
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
    ];

    private function __clone(){}

    private function __construct()
    {
        $dsn = "mysql:host=".self::$host.";dbname=".self::$db_name.";charset=".self::$charset;
        self::$pdo = new \PDO($dsn, self::$user_name, self::$password, self::$settings);
    }

    /**
     * возвращает объект данного класса
     */
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * получение нескольких строк из таблицы БД
     * @return array
     */

    public function getRows($sql, $param=null)
    {
        $stmt = self::$pdo->prepare($sql);
        $res = $stmt->execute($param);
        if($res){
            return $stmt->fetchAll();
        }
        return false;
    }

    /**
     * получение одной строки из БД
     * @return array
     */
    
    public function getRow($sql, $param)
    {
        $stmt = self::$pdo->prepare($sql);
        $res = $stmt->execute($param);
        if($res){
            return $stmt->fetch();
        }
        return false;
    }

    /**
     * выполнение запросов INSERT, UPDATE, DELETE и т.д.
     * @return boolean
     */
    
    public function executeQuery($sql, $param)
    {
        $stmt = self::$pdo->prepare($sql);
        if($stmt->execute($param)){
            return true;
        }
        return false;
    }
}
