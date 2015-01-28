<?php

namespace todo\DbTable;

use DateTime;
use Ipf\Db\Connection\Pdo;
use todo\Tache as todoTache;
use todo\User as todoUser;

class Tache {
    
    private $db;

    public function __construct(Pdo $db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db->getDb();
    }

    public function add(todoTache $tache)
    {
        $sql = "INSERT INTO tache
                VALUES(
                    NULL,
                    '". $tache->getTitre() ."',
                    '". $tache->getDescription() . "',
                    '". $tache->getEcheance() ."',
                    '". $tache->getTimeRealisation() ."',
                    ". $tache->getStatut() .")";
        
        $this->getDb()->exec($sql);
        
        foreach ($tache->getUsers() as $user) {
            
            $sqlInsertAssign = "INSERT INTO assignation
                    VALUES(
                            NULL,
                            ". $this->getDb()->lastInsertId() .",
                            ". $user[0] . ",
                            '". $tache->getTimeRealisation() ."',
                           '". date_format(new DateTime, 'Y-m-d H:i:s') ."',
                           '". date_format(new DateTime, 'Y-m-d H:i:s') ."')";
            
            $this->getDb()->exec($sqlInsertAssign);
        }
        return true;
    }

    public function update(todoTache $tache)
    {
         $sql = "UPDATE tache SET titre =
                titre = ".$tache->getTitre() .",
                description = " .$tache->getDescription() .",
                echeance = " .$tache->getEcheance() .",
                timeRealisation = " .$tache->getTimeRealisation() ."
                statut = " .$tache->getStatut()." WHERE idTache = " .$tache->getIdTache() ."";
         
        return $this->getDb()->exec($sql);
    }

    public function findAll($id = null)
    {
        $sql = $this->getSqlTache();
        if (!empty($id)) {
            $sql .= " WHERE idUser=" . (int) $id;
        }
        $sql .= " GROUP BY idTache";

        $query    = $this->getDb()->query($sql);
        $result   = $query->fetchAll(\PDO::FETCH_ASSOC);
        $taches = array();

        foreach ($result as $t) {
            $taches[] = $this->rowToObject($t);
        }
        return $taches;
    }

    public function findById($id)
    {
        $sql  = $this->getSqlTache();
        $sql .= " WHERE idTache=" . (int) $id;
        $sql .= " GROUP BY idTache";

        $query = $this->getDb()->query($sql);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            return $this->rowToObject($result);
        }

        return null;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tache WHERE id = " . $id . "";
        $sqlAssignation = "DELETE FROM assignation WHERE idTache = " . $id . "";
        $this->getDb()->exec($sql);
        return $this->getDb()->exec($sqlAssignation);

    }
    
    public function removeAssign($idUser, $idTache) {
        $sql = "DELETE FROM assignation WHERE idUser = ".$idUser." AND idTache= ".$idTache."";
            
        return $this->getDb()->exec($sql);
    }
    
    public function addTimeExecution(Tache $tache) {
        
        $sql = "UPDATE assignation SET timeExecution=".$tache->getTimeExecution()." WHERE idTache = ".$tache->getIdTache()." and id_user=".$tache->getIdUser();
         
        return $this->getDb()->exec($sql);
    }
    
    public function rowToObject(array $row)
    {
        $tache = new todoTache();
        $tache->setId($row['idTache'])
                ->setTitre($row['titre'])
                ->setDescription($row['description'])
                ->setEcheance($row['echeance'])
                ->setTimeRealisation($row['timeRealisation'])
                ->setStatut($row['statut']);
        if (isset($row['idUser'])) {
            
            $sqlUser = "SELECT idUser, name, firstname, email, login, password, statut FROM user AS u JOIN assignation AS a ON a.idUser = u.id WHERE idTache = ".$row['idTache']."";
            $queryUser = $this->getDb()->query($sqlUser);
            
            foreach ($queryUser->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $user = new todoUser();
                $user->setId($row['idUser'])
                        ->setName($row['name'])
                        ->setFirstname($row['firstname'])
                        ->setEmail($row['email'])
                        ->setLogin($row['login'])
                        ->setPassword($row['password'])
                        ->setStatut($row['statut']);
                
                $tache->setUsers($user);
            }
        }
       
        return $tache; 
    }

    protected function getSqlTache()
    {
        $sql = "SELECT *
                FROM assignation AS a
                JOIN tache AS t
                ON a.idTache = t.id
                JOIN user AS u
                ON a.idUser = u.id";

        return $sql;
    }
}
