<?php
require_once '../application/init.php';

use todo\DbTable\Tache;
use todo\DbTable\User;

$crudUser = new User($connection);
$users = $crudUser->selectAllUser();
$crudTache = new Tache($connection);
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $taches = $crudTache->findById($id);
} else {
    $id = null;
    $taches = new \todo\Tache();
}
$usersTache = $taches->getUsers();
include 'header.php'?>

<div class="panel panel-info formulaire">
    <div class="panel-heading">
        <h3>Formulaire de création et de modification de tâches</h3>
    </div>
    <div class="panel-body">
        <form action="http://127.0.0.1/todoTime/application/controller/ctrlTache.php?action=enregistrerTache" method="POST">
            <div class="form-group">
                <label for="title" class="control-label">Titre de la tâche</label>
                <input type="text" class="form-control" name="titre" id="titre" value="<?= empty($id) ? '' : $taches->getTitre() ;?>" placeholder="Titre de la tâche">


                <div class="form-group">
                <label for="description">Description de la tâche</label>
                <textarea type="textarea" rows="3" class="form-control" name="description" id="description"
                      placeholder="Description de la tâche"><?= empty($id) ? '' : $taches->getDescription(); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="echeance">Echéance</label>
                    <input type="datetime" id="echeance" name="echeance" class="datepicker form-control" value="<?= empty($id) ? '' : $taches->getEcheance(); ?>">
                </div>

                <div class="form-group input-append bootstrap-timepicker">
                    <label for="echeance">Temps prévisionel</label>
                    <input type="text" class="timepicker2 input-small form-control" id="timeRealisation" name="timeRealisation"
                           value="<?= empty($id) ? '' : $taches->getTimeRealisation(); ?>" >
                </div>

                 <?php if (!empty($id)): ?>
                <div class="form-group">
                    <label for="selectedUsers">Utilisateur</label>
                    <select name="selectedUsers" id="selectedUsers" class="form-control" multiple>
                        <?php if(!empty($usersTache)) { ?>
                            <?php foreach ($taches->getUsers() as $user) : ?>
                            <option value="<?= $user->getId();?>"><?= $user->getName().' '.$user->getFirstname() ;?></option>
                            <?php endforeach;?>
                        <?php };?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="addUsers">Ajouter des utilisateurs</label>
                    <select name="addUsers[]" id="addUsers[]" class="form-control" multiple>
                        <?php foreach ($users as $user) : ?>
                            <option
                                value="<?= $user->getId(); ?>"><?= $user->getName() . ' ' . $user->getFirstname(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut" class="form-control">
                        <?php foreach ($taches->getStatutToString() as $key => $value) : ; ?>
                            <option value="<?php echo $key; ?>"><?= $value; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="idTache" value="<?= $id; ?>">
                </div>
                <div class="form-group">
                    <?php if (empty($id)) { ?>
                        <input type="submit" value="Créer" class="btn btn-primary"/>
                    <?php } else { ?>
                        <input type="submit" value="Modifier" class="btn btn-primary"/>
                    <?php } ?>
                    <button type="submit" class="btn btn-danger">Annuler</button>
                </div>
            </form>
    </div>
</div>

    <?php include 'footer.php' ?>
