<?php

namespace todo\DbTable;
use Ipf\Db\Connection\Pdo;

class Connexion {
    
    private $db;
    
    public function __construct(Pdo $db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db->getDb();
    }
    
    public function connectUser($email, $password) {
        
        $sql= "select * from user where email='".$email."' and password='".$password."'";
        
        echo $sql;
        //Compiler et exécuter la requête
        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);
        
        return $result;
    }
    
}
