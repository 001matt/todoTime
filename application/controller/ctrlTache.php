<?php
require_once '../init.php';
use todo\DbTable\Tache as DtTache;
use todo\Tache;

$action = $_REQUEST['action'];
switch($action){
    case 'enregistrerTemps': 
    {
        if(!empty($_POST['time'])){
            
            $tache = new DtTache($connection);
            
           $sql = "UPDATE assignation SET timeExecution='".$_POST['time']."' WHERE id=3 and idUser=3";
         
            try{
                $tache->getDb()->exec($sql);
                echo json_encode('ok');
            } catch (Exception $ex) {
               echo  json_encode('non');
            }
        }
	 break;
    }
   case 'logout' : {
                session_start();
		session_destroy();
		header('Location: http://localhost/todoTime/public/login.php');
    }  
    case 'enregistrerTache':
    {
        if(isset($_POST) && !empty($_POST)){
            if(!empty($_POST['idTache']) && $_POST['idTache'] !== null && $_POST['idTache'] != 0){
                $dtTache = new DtTache($connection);
                $tache = new Tache($_POST['idTache'], $_POST['titre'], $_POST['description'], $_POST['echeance'], $_POST['timeRealisation'], $_POST['statut']);
                $dtTache->update($tache);
            }else{
                $tache = new Tache($_POST['idTache'], $_POST['titre'], $_POST['description'], $_POST['echeance'], $_POST['timeRealisation'], $_POST['statut'], $_POST['addUsers']);
                $dtTache = new DtTache($connection);
                $dtTache->add($tache);
            }
        //$_SESSION[];
        //http_redirect("relpath", array("name" => "value"), true, HTTP_REDIRECT_PERM);
            header('Location: http://localhost/todoTime/public/admin.php');
        }
        break;
    }
    case 'removeUser' :
    {
        if(isset($_GET['idTache']) && !empty($_GET['idTache'])){
            $dtTache = new DtTache($connection);
            $dtTache->removeAssign($_GET['idUser'], $_GET['idTache']);
        }
        break;
    }
    case 'addAssign' :
    {
        if(isset($_GET['idTache']) && !empty($_GET['idTache']) && isset($_GET['idUser']) && !empty($_GET['idUser'])){
            $dtTache = new DtTache($connection);
            $dtTache->addAssign($_GET['idUser'], $_GET['idTache']);
        }
        break;
    }
}

