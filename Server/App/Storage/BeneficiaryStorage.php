<?php
namespace Src\Server\App\Storage;

use App\Entity\Beneficiary;
use \PDO;
use \PDOException;

class BeneficiaryStorage{

    
    private static $connection;
    private const TABLENAME = 'Beneficiary';

    public function __construct(){
        self::$connection = DataBaseConnection::connect();
        
    }

    public function save(ContactModel $contact){

        $query = "INSERT INTO ".self::TABLENAME."(name, email, telefone) VALUES (?, ?, ?)";
        try {
           return self::$connection->prepare($query)->execute(array($contact->name, $contact->email, $contact->telefone));
        } catch (PDOException $e) {
            return $e->getMessage();
        }
        
        $telefone = $_GET['telefone'];
        if(!is_numeric($telefone)){
        echo "Preencha o telefone somente com números.";
        }

    }

    public function getAll(){   

        $stmt = self::$connection->query(" SELECT * FROM ".self::TABLENAME);       
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ContactModel');
        return $stmt->fetchAll();       
    }

    public function getByID(int $id){ 
         
        $stmt = self::$connection->prepare(" SELECT * FROM ".self::TABLENAME." WHERE contact_id = :id");       
        $stmt->execute(array(":id" => $id));
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'ContactModel');
        return $stmt->fetch();   

    }

    public function update(ContactModel $contact){ 
        
        $query = "UPDATE contact SET name = ? , email =  ? ,telefone = ? WHERE contact_id =  ?";
        try {
           return self::$connection->prepare($query)->execute(array($contact->name, $contact->email, $contact->telefone, $contact->contact_id));
        } catch (PDOException $e) {
            return $e->getMessage();
        }


    }

    public function delete($id){
        $query = "DELETE FROM ".self::TABLENAME." WHERE contact_id = :id";
        $binds = [":id" => $id];
        return self::$connection->prepare($query)->execute($binds);      

    }

}



?>