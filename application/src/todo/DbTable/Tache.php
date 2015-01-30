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
        
        $last_id = $this->getDb()->lastInsertId();
        
        foreach ($tache->getUsers() as $key => $user) {
            $sqlInsertAssign = "INSERT INTO assignation
                    VALUES(
                            NULL,
                            ". $last_id .",
                            ". $user . ",
                            '". $tache->getTimeRealisation() ."',
                           '". date("Y-m-d H:i:s") ."',
                           '". date("Y-m-d H:i:s") ."')";
            
            $this->getDb()->exec($sqlInsertAssign);
        }
        return true;
    }

    public function update(todoTache $tache)
    {
         $sql = "UPDATE tache SET
                titre = '".$tache->getTitre() ."',
                description = '" .$tache->getDescription() ."',
                echeance = '" .$tache->getEcheance() ."',
                timeRealisation = '" .$tache->getTimeRealisation() ."',
                statut = " .$tache->getStatut(). "
                WHERE id = " .$tache->getId() ."";
         
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
    
    public function addAssign($idUser, $idTache) {
        $sql = "INSERT INTO assignation
                    VALUES(
                            NULL,
                            ". $idTache .",
                            ". $idUser . ",
                            '". '00:00:00' ."',
                           '". date("Y-m-d H:i:s") ."',
                           '". date("Y-m-d H:i:s") ."')";
            
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
            
            $sqlUser = "SELECT idUser, name, firstname, email, login, password, state FROM user AS u JOIN assignation AS a ON a.idUser = u.id WHERE idTache = ".$row['idTache']."";
            $queryUser = $this->getDb()->query($sqlUser);
            
            foreach ($queryUser->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                $user = new todoUser();
                $user->setId($row['idUser'])
                        ->setName($row['name'])
                        ->setFirstname($row['firstname'])
                        ->setEmail($row['email'])
                        ->setLogin($row['login'])
                        ->setPassword($row['password'])
                        ->setStatut($row['state']);
                
                $tache->setUsers($user);
            }
        }
        return $tache; 
    }

    public function findUserTacheAssign() {
        
        $sql = $this->getSqlTache();
        $sql .= " GROUP BY idUser";
        
        $query    = $this->getDb()->query($sql);
        $result   = $query->fetchAll(\PDO::FETCH_ASSOC);
        
        $users = array();
        foreach ($result as $t) {
            $user = array(
               'idUser' => $t['idUser'],
               'name' => $t['name'],
               'firstname' => $t['firstname'],
               'email' => $t['email'],
               'password' => $t['password'],
               'state' => $t['state'],
                );

                $sqlTache = "SELECT * FROM tache AS t JOIN assignation AS a ON a.idTache = t.id WHERE idUser = ".$t['idUser']."";
                $queryTache = $this->getDb()->query($sqlTache);
                $taches = array();
                foreach ($queryTache->fetchAll(\PDO::FETCH_ASSOC) as $row) {
                        $tache = array(
                   'idTache' => $row['idTache'],
                   'titre' => $row['titre'],
                   'description' => $row['description'],
                   'echeance' => $row['echeance'],
                   'timeRealisation' => $row['timeRealisation'],
                   'statut' => $row['statut'],
                   'reelTime' => $row['reelTime'],
                   'totalTimePre' => $row['reelTime'],
                   'totalTimeReel' => $row['reelTime'],
                    );
                    array_push($taches, $tache);
                }
                /*$date = \DateTime::createFromFormat('H:i:s', $row['timeRealisation']);
                $date = date_format($date, 'H:i:s');*/
                array_push($user, $taches);
                $user['totalTimePre'] = $this->convertirPre();
                $user['totalTimeReel'] = $this->convertirReel($t['idUser']);
                array_push($users, $user);
                
        }
        return $users;
    }
    
    public function convertirPre() {
        
        $monday = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')-date('N')+1, date('Y')));
        $sunday = date('Y-m-d',strtotime('Sunday'));
        
        $sql = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `timeRealisation` ) ) ) AS somme FROM tache WHERE echeance BETWEEN '".$monday."' AND '".$sunday."'";
        $query    = $this->getDb()->query($sql);
        $result   = $query->fetch(\PDO::FETCH_ASSOC);
        $explode = explode(':', $result['somme']);
        if($explode[0]>24){
            $heure = $explode[0]/24;
            if(is_float($heure)){
                $reste = $explode[0]%24;
                return floor($heure).' jours '.$reste.':'.$explode[1].':'.$explode[2];
            }else{
                return $heure.':'.$explode[1].':'.$explode[2];
            }
        }else{
            return $result['somme'];
        }
    }
    
    public function semaine() {
        
        $monday = date('d/m/Y', mktime(0, 0, 0, date('m'), date('d')-date('N')+1, date('Y')));
        $sunday = date('d/m/Y',strtotime('Sunday'));
        
        return " semaine du $monday au $sunday ";
    }
    
    public function convertirReel($idUser) {
        
        $sql = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `reelTime` ) ) ) AS somme FROM assignation WHERE idUser=".$idUser."";
        $query    = $this->getDb()->query($sql);
        $result   = $query->fetch(\PDO::FETCH_ASSOC);
        $explode = explode(':', $result['somme']);
        if($explode[0]>24){
            $heure = $explode[0]/24;
            if(is_float($heure)){
                $reste = $explode[0]%24;
                return floor($heure).' jours '.$reste.':'.$explode[1].':'.$explode[2];
            }else{
                return $heure.':'.$explode[1].':'.$explode[2];
            }
        }else{
            return $result['somme'];
        }
    }
    
    public function UserHaveTache() {
                        
                
        return true;
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
