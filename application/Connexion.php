<?php
 namespace Application;
 
class Connexion{
    
    private $connexion;
    private $error = array();
    
    public function __construct() {
        $this->connexion = new \Application\PDO();
    }
    
    public function connectUser($login, $mdp) {
        
        $sql= "select * from user where login = ? and password = ?";
        $req = $this->connexion->getPdo()->prepare($sql);
        $req->bindValue(1, $login);
        $req->bindValue(2, $mdp);
        
        //Compiler et exécuter la requête
        $result = $req->execute();
        
        $result = $req->fetch(\PDO::FETCH_ASSOC);
 
        
        if(!$result){
            return $this->error[] = "Login et Mot de passe incorect";
        }
        else {
            return $result;
        }
    }
    
    public function logout() {
        session_destroy();
    }
}
