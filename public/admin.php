<?php 
require_once '../application/init.php';

use todo\DbTable\Tache;
 session_start();
$crudTache = new Tache($connection);
$taches = $crudTache->findAll();
include 'header.php';
var_dump($_SESSION);
?>

<div class="panel panel-primary col-sx-12">
    <div class="panel-heading">
        <h3>Listes des tâches <a href="form.php" class="btn btn-success pull-right">Créez une nouvelle tâche</a></h3>
    </div>
    <div class="panel-body tableau">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>Titre</td>
                        <td>Description</td>
                        <td>Echéance</td>
                        <td>Temps prévisionel</td>
                        <td>Statut</td>
                        <td>Utilisateur</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($taches as $tache) : ?>
                    <tr>
                        <td><?= $tache->getTitre(); ?></td>
                        <td><?= $tache->getDescription(); ?></td>
                        <td><?= $tache->getEcheance(); ?></td>
                        <td><?= $tache->getTimerealisation();?></td>
                        <td><?= $tache->getStatutToString($tache->getStatut()); ?></td>
                        <td><?php foreach ($tache->getUsers() as $value) {
                            echo $value->getName().' '.$value->getFirstname().'<br>';
                        }; ?></td>
                        <td><a href="form.php?id=<?= $tache->getId(); ?>" class="btn btn-primary">Modifier</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'?>