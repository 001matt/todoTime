<?php
require_once '../../application/init.php';

use todo\DbTable\Tache as DtTache;
use todo\Tache;
//verifier si le champ hidden id est rempli update ou insert
if(isset($_POST) && !empty($_POST)){
    if(!empty($_POST['id'])){
        $tache = new Tache($_POST['id'], $_POST['titre'], $_POST['description'], $_POST['echeance'], $_POST['timeRealisation'], $_POST['statut'], $_POST['selectedUsers']);
        $dtTache = new DtTache($connection);
        $dtTache->add($tache);
    }else{
        $tache = new Tache($_POST['id'], $_POST['titre'], $_POST['description'], $_POST['echeance'], $_POST['timeRealisation'], $_POST['statut'], $_POST['addUsers']);
        $dtTache = new DtTache($connection);
        $dtTache->add($tache);
    }
    
    
    //$_SESSION[];
    //http_redirect("relpath", array("name" => "value"), true, HTTP_REDIRECT_PERM);
}
if(isset($_GET['idTache']) && !empty($_GET['idTache'])){
    $dtTache = new DtTache($connection);
    $dtTache->removeAssign($_GET['idUser'], $_GET['idTache']);
}