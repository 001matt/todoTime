<?php
require_once '../init.php';
use todo\DbTable\Connexion;

$action = $_REQUEST['action'];
switch($action){
    case 'login': 
    {
        if(!empty($_POST['email']) && !empty($_POST['password'])){
            //On récupère les données postés
            $email = $_POST['email'];
            $mdp = $_POST['password'];
            
                //on créer un objet connexion et execute la requete
                $connexion = new connexion($connection);
                $user = $connexion->connectUser($email, $mdp);
                //Si la requête retourne un tableau tableau
                if(is_array($user)) {
                    session_start();
                    $_SESSION['idUser'] = $user['id'] ;
                    $_SESSION['nom']   = $user['name'];
                    $_SESSION['prenom']   = $user['firstname'];
                    $_SESSION['state']   = $user['state'];

                    if($user['state'] === '1'){
                        //include('../../public/admin.php');
                        header('Location: ../../public/admin.php');
                    }
                    else {
                       // include("../public/users.php");
                        header('Location: ../../public/users.php');
                    }
                } 
                else{
                    header('Location: http://localhost/todoTime/public/login.php');
                } 
        }
        else{
                    header('Location: http://localhost/todoTime/public/login.php');
        }  
	 break;
       }
   case 'logout' : {
                session_start();
		session_destroy();
		header('Location: http://localhost/todoTime/public/login.php');
    }    
}
