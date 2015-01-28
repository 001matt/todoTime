<?php
require_once '../../application/init.php';

use todo\DbTable\Tache as DtTache;
use todo\Tache;
var_dump('la',$_GET);

//verifier si le champ hidden id est rempli update ou insert
if(isset($_POST) && !empty($_POST)){
    var_dump('ici',$_POST);
    $tache = new Tache($_POST['id'], $_POST['titre'], $_POST['descritption'], $_POST['echeance'], $_POST['timeRealisation'], $_POST['statut'], $_POST['users']);
    $dtTache = new DtTache($connection);
    $dtTache->add($tache);
    
    //$_SESSION[];
    //http_redirect("relpath", array("name" => "value"), true, HTTP_REDIRECT_PERM);
}