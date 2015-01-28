<?php
require_once '../application/init.php';

use todo\DbTable\Tache;
use todo\DbTable\User;

$crudTache = new Tache($connection);
$crudUser = new User($connection);
$users = $crudUser->selectAllUser();
if(isset($_GET['id'])){
    $id =(int) $_GET['id'];
    $taches = $crudTache->findById($id);
} else {
    $id = null;
}
include 'header.php'?>

<div class="panel panel-info formulaire">
    <div class="panel-heading">
        <h3>Formulaire de création et de modification de tâches</h3>
    </div>
    <div class="panel-body">
        <form action="../application/controller/ctrlTache.php" methode="POST">
            <div class="form-group">
                <label for="title">Titre de la tâche</label>

                    <input type="text" class="form-control" name="titre" id="titre" value="<?= empty($id) ? '' : $taches->getTitre() ;?>" placeholder="Titre de la tâche">


            <div class="form-group">
                <label for="description">Description de la tâche</label>

                    <textarea type="textarea" rows="3" class="form-control" name="description" id="description" placeholder="Description de la tâche"><?= empty($id) ? '' : $taches->getDescription(); ?></textarea>


            <div class="form-group">
                <label for="echeance">Echéance</label>

                    <input type="date" id="echeance" name="echeance" class="form-control"  value="<?= empty($id) ? '' : $taches->getEcheance() ;?>" name="echeance" >


            <div class="form-group">
                <label for="echeance" >Temps prévisionel</label>

                    <input type="time" class="form-control"  id="timeRealisation" name="timeRealisation" value="<?= empty($id) ? '' : $taches->getTimeRealisation() ;?>" name="echeance" >

            </div>

            <?php if(!empty($id)): ?>
            <div class="form-group">
                <label for="user">Utilisateur</label>

                    <select name="selectedUsers" id="selectUser" class="form-control" multiple>
                        <?php foreach ($taches->getUsers() as $user) : ?>
                        <option value="user1"><?= $user->getName().' '.$user->getFirstname() ;?></option>
                        <?php endforeach;?>
                    </select>

            </div>
            <?php endif; ?>
            
             <div class="form-group">
                <label for="echeance" >Ajouter des utilisateurs</label>

                    <select name="addUser" id="addUser" class="form-control" multiple>
                        <?php foreach ($users as $user) : ?>
                        <option value="user1"><?= $user->getName().' '.$user->getFirstname() ;?></option>
                        <?php endforeach;?>
                    </select>

            </div>
            
            <div class="form-group">
                <label for="echeance">Statut</label>

                    <select name="statut" id="statut" class="form-control">
                        
                        <?php foreach ($taches->getStatutToString() as $key => $value) : ;?>
                            <option value="<?php echo $key; ?>"><?= $value; ?></option>
                        <?php endforeach;?>
                    </select>

            </div>
            
            <input type="hidden" value="<?= $id; ?>">


                    <?php if(empty($id)){ ?>
                    <input type="submit" value="Créer" class="btn btn-primary"/>
                    <?php }else{ ?>
                    <input type="submit" value="Modifier" class="btn btn-primary"/>
                    <?php } ?>
                    <button type="submit" class="btn btn-danger">Annuler</button>


        </form>

    </div>

<?php include 'footer.php'?>
