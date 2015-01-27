<?php

namespace todo;


class User {
    
    private $id;
    private $name;
    private $firstname;
    private $email;
    private $login;
    private $password;
    private $statut;
    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getFirstname() {
        return $this->firstname;
    }

    function getEmail() {
        return $this->email;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getStatut() {
        return $this->statut;
    }
    
    function getStatutToString($statut) {
        $tab = array(0=>'Utilisateur', 1=>'Administrateur');
        return $tab[$statut];
    }

    function setId($id) {
        $this->id = (int) $id;
        return $this;
    }

    function setName($name) {
        $this->name = (string) $name;
        return $this;
    }

    function setFirstname($firstname) {
        $this->firstname = (string) $firstname;
        return $this;
    }

    function setEmail($email) {
        $this->email = (string) $email;
        return $this;
    }

    function setLogin($login) {
        $this->login = (string) $login;
        return $this;
    }

    function setPassword($password) {
        $this->password = (string) $password;
        return $this;
    }

    function setStatut($statut) {
        $this->statut = (int) $statut;
        return $this;
    }


}
