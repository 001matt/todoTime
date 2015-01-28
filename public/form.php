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
}else{
    $id = null;
}
include 'header.php'?>

<div class="panel panel-info formulaire">
    <div class="panel-heading">
        <h3>Formulaire de création et de modification de tâches</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="../application/controller/ctrlTache.php" methode="POST">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Titre de la tâche</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="titre" id="titre" value="<?= empty($id) ? '' : $taches->getTitre() ;?>" placeholder="Titre de la tâche">
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description de la tâche</label>
                <div class="col-sm-10">
                    <textarea type="textarea" rows="3" class="form-control" name="description" id="description" placeholder="Description de la tâche"><?= empty($id) ? '' : $taches->getDescription(); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Echéance</label>
                <div class="col-sm-10">
                    <input type="date" id="echeance" name="echeance" class="form-control"  value="<?= empty($id) ? '' : $taches->getEcheance() ;?>" name="echeance" >
                </div>
            </div>

            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Temps prévisionel</label>
                <div class="col-sm-10">
                    <input type="time" class="form-control"  id="timeRealisation" name="timeRealisation" value="<?= empty($id) ? '' : $taches->getTimeRealisation() ;?>" name="echeance" >
                </div>
            </div>
            
            <?php if(!empty($id)): ?>
            <div class="form-group">
                <label for="user" class="col-sm-2 control-label">Utilisateur</label>
                <div class="col-sm-10">
                    <select name="selectedUsers" id="selectUser" class="form-control" multiple>
                        <?php foreach ($taches->getUsers() as $user) : ?>
                        <option value="user1"><?= $user->getName().' '.$user->getFirstname() ;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <?php endif; ?>
            
             <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Ajouter des utilisateurs</label>
                <div class="col-sm-10">
                    <select name="addUser" id="addUser" class="form-control" multiple>
                        <?php foreach ($users as $user) : ?>
                        <option value="user1"><?= $user->getName().' '.$user->getFirstname() ;?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Statut</label>
                <div class="col-sm-10">
                    <select name="statut" id="statut" class="form-control">
                        
                        <?php foreach ($taches->getStatutToString() as $key => $value) : ;?>
                            <option value="<?php echo $key; ?>"><?= $value; ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <input type="hidden" value="<?= $id; ?>">
            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-10">
                    <?php if(empty($id)){ ?>
                    <input type="submit" value="Créer" class="btn btn-primary"/>
                    <?php }else{ ?>
                    <input type="submit" value="Modifier" class="btn btn-primary"/>
                    <?php } ?>
                    <button type="submit" class="btn btn-danger">Annuler</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'?>