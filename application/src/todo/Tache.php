<?php
namespace todo;

class Tache {
    
    const STATUS_ASSIGNEE = 1;
    const STATUS_ENCOURS = 2;
    const STATUS_TERMINEE = 3;
    private $id;
    private $titre;
    private $description;
    private $echeance;
    private $timeRealisation;
    private $statut;
    private $users=array();
    
    public function __construct($id = null, $titre = null, $description = null, $echeance = null , $timeRealisation = null, $statut = null, $users = null) {
        $this->setId($id);
        $this->setTitre($titre);
        $this->setDescription($description);
        $this->setEcheance($echeance);
        $this->setTimeRealisation($timeRealisation);
        $this->setStatut($statut);
        $this->setUsers($users);
    }

    
    function getUsers() {
        return $this->users;
    }

    function setUsers($users) {
        if(null !== $users){
            $this->users[] = $users;
            return $this;
        }
    }

    function getTitre() {
        return $this->titre;
    }

    function getDescription() {
        return $this->description;
    }

    function getEcheance() {
        return $this->echeance;
    }

    function getTimeRealisation() {
        return $this->timeRealisation;
    }

    function getStatut() {
        return $this->statut;
        
    }
    
    public function getStatutToString($statut = null) {
        $tab = array(1 => 'Assignée', 2 => 'En cours', 3 => 'Terminée');
        if(!empty($statut)){
            return $tab[$statut];
        }else{
            return $tab;
        }
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = (int) $id;
        return $this;
    }
    
    function setTitre($titre) {
        $this->titre = $titre;
        return $this;
    }

    function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    function setEcheance($echeance) {
        $this->echeance = $echeance;
        return $this;
    }

    function setTimeRealisation($timeRealisation) {
        $this->timeRealisation = $timeRealisation;
        return $this;
    }

    function setStatut($statut) {
        $this->statut = (int) $statut;
        return $this;
    }
    
    /**
     * Assugne une tâche a un utilisateur
     * 
     * @param type $idUser
     */
    public function assignTo($idUser) {
        $sql = "";
    }

}
