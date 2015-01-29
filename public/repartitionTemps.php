<?php
require_once '../application/init.php';

 session_start();

use todo\DbTable\Tache;
use todo\DbTable\User;

$crudTache = new Tache($connection);

$taches = $crudTache->findUserTacheAssign();
var_dump($taches);
include 'header.php'?>

<div class="panel panel-primary col-sx-12" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading">
            <h3>Répartition du temps</h3>
        </div>
    <div class="panel-body tableau">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Tâches</td>
                    <td>Total temps prévisionnel</td>
                    <td>Total temps réel</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($taches as $tache): ?>

                    <tr>
                        <td><?= $tache->getTitre(); ?></td>
                        <td><?= $tache->getDescription(); ?></td>
                        <td><?= $tache->getEcheance(); ?></td>
                        <td><?= $tache->getTimerealisation(); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
