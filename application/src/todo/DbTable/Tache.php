<?php

namespace todo\DbTable;

use todo\Tache as todoTache;
use todo\User;
use Ipf\Db\Connection\Pdo;

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
        //foreach utilisateur
        foreach ($tache->getUsers() as $user) {
            
            $sqlInsertAssign = "INSERT INTO assignation
                    VALUES(
                            NULL,
                            ". $tache->getId() .",
                            ". $user->getId() . ",
                            ". $tache->getTimeRealisation() .",
                           '". date('Y-m-d', new \DateTime()) ."',
                           '". date('Y-m-d', new \DateTime()) .")";
        }
        
        $this->getDb()->exec($sqlInsertAssign);
        
        $sql = "INSERT INTO tache
                VALUES(
                    NULL,
                     ". $this->getDb()->quote($tache->getTitre()) .",
                     ". $this->getDb()->quote($tache->getDescription()) . ",
                     ". $tache->getEcheance() .",
                    '". $tache->getTimeRealisation() ."',
                    '". $tache->getStatut() .")";
        
        return $this->getDb()->exec($sql);
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

    public function delete(Tache $tache)
    {
        $sql = "DELETE FROM tache WHERE idTache = ".$tache->getIdUser()."";
            
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
                $user = new User();
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
