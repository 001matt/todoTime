<?php

require_once '../init.php';
use todo\DbTable\Tache;

$action = $_REQUEST['action'];
switch($action){
    case 'enregistrerTemps': 
    {
        if(!empty($_POST['time'])){
            
            $tache = new Tache($connection);
            
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
}

