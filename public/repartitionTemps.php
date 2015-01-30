<?php
require_once '../application/init.php';

 session_start();

use todo\DbTable\Tache;
use todo\DbTable\User;

$crudTache = new Tache($connection);
$users = $crudTache->findUserTacheAssign();

include 'header.php'?>

<div class="panel panel-primary col-sx-12" xmlns="http://www.w3.org/1999/html">
        <div class="panel-heading">
            <h3>Répartition du temps: <?= $crudTache->semaine() ;?></h3>
        </div>
    <div class="panel-body tableau">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Nom</td>
                    <td>Tâches</td>
                    <td>Total temps réel</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['name']. ' ' .$user['firstname']  ?></td>
                        <td>
                        <?php foreach ($user[0] as  $tache): ?>
                            <?= $tache['idTache']. ' ' .$tache['titre'];?><span style='float: right'><?= $tache['timeRealisation']. ' ' .$tache['reelTime'];?></span><br>
                        <?php endforeach; ?>
                        </td>
                        <td><?= $user['totalTimeReel']; ?></td>
                    </tr>
                    <?php  $totalTimePre = $user['totalTimePre']; ?>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="2"><td>Total temps prévisionnel: <?= $totalTimePre; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>
