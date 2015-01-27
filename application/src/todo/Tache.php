<?php

namespace todo;

class Tache {
    
    const STATUS_ASSIGNEE = 0;
    const STATUS_ENCOURS = 1;
    const STATUS_TERMINEE = 2;
    private $id;
    private $titre;
    private $description;
    private $echeance;
    private $timeRealisation;
    private $statut;
    private $users=array();
    
    function getUsers() {
        return $this->users;
    }

    function setUsers(User $users) {
        array_push($this->users, $users);
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
    
    public function getStatutToString($statut) {
        $tab = array(0 => 'Assignée', 1 => 'En cours', 2 => 'Terminée');
        return $tab[$statut];
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
        $this->statut = $statut;
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
