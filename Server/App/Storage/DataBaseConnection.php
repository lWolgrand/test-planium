<?php


//No meu composer Json eu defino que este caminho é um namespace e que "App\\":"app/"
namespace Src\Server\App\Storage;;

//Aqui são dois imports da extensão PDO do PHP
use \PDO;
use PDOException;

//Esta é minha classe de conexão com banco
class DataBaseConnection{

    //Meus atributos
    private static $host;
    private static $dbName;
    private static $user;
    private static $password;

    //Essa é minha função inicializadora do banco
    private static function init($host = "db", $dbName = "contact", $user = "root", $password = "root"){

        //dentro da minha função, tenho minhas variáveis estáticas e privadas recebendo parâmetros.
        self::$host = $host;
        self::$dbName = $dbName;
        self::$user = $user;
        self::$password = $password;
    }

    //Essa é minha função de conexão com o banco onde é chamada a função init
    public static function connect(){
        self::init();
        $connection = NULL;
        try {
            $connection = new PDO("pgsql:host=".self::$host.";dbname=".self::$dbName, self::$user, self::$password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        

        } catch (PDOException $e) {
           $connection = $e->getMessage();
        }
        return $connection;

    }

}


?>