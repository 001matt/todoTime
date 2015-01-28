<?php

namespace todo\DbTable;

use Ipf\Db\Connection\Pdo;
use todo\User as modelUser;

class User {
    
    private $db;

    public function __construct(Pdo $db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db->getDb();
    }
    
    public function selectAllUser() {
        $sql = $this->getSqlUser();
        $sql .= " ORDER BY name";
        
        $query    = $this->getDb()->query($sql);
        $result   = $query->fetchAll(\PDO::FETCH_ASSOC);
        $users = array();

        foreach ($result as $u) {
            $users[] = $this->rowToObject($u);
        }
        
        return $users;
    }
    
    public function selectById($id) {
        $sql = $this->getSqlUser();
        $sql .= " WHERE idUser=" . (int) $id;
        
        $query    = $this->getDb()->query($sql);
        $result   = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($result) {
            return $this->rowToObject($result);
        }

        return null;
    }
    
    public function rowToObject(array $row)
    {
        $user = new modelUser();
        $user->setId($row['id'])
                ->setName($row['name'])
                ->setFirstname($row['firstname'])
                ->setEmail($row['email'])
                ->setLogin($row['login'])
                ->setPassword($row['password'])
                ->setStatut($row['statut']);
        
        return $user; 
    }
    
    protected function getSqlUser()
    {
        $sql = "SELECT *
                FROM user AS u";

        return $sql;
    }
}
