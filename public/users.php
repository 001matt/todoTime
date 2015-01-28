<?php 
require_once '../application/init.php';

use todo\DbTable\Tache;
use todo\DbTable\User;

$crudTache = new Tache($connection);
$taches = $crudTache->findAll('2');
    
include 'header.php'?>

    <div class="panel panel-primary col-sx-12">
        <div class="panel-heading">
            <h3>Listes des tâches de : Matthieu Pringuez</h3>

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
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($taches as $tache): ?>

                        <tr>
                            <td><?= $tache->getTitre(); ?></td>
                            <td><?= $tache->getDescription(); ?></td>
                            <td><?= $tache->getEcheance(); ?></td>
                            <td><?= $tache->getTimerealisation(); ?></td>
                            <td><a href="#" class="btn btn-primary btn-sm">Démmarez la tâche</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>
