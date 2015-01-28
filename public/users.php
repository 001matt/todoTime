<?php
require_once '../application/init.php';

use todo\DbTable\Tache;

$crudTache = new Tache($connection);
$taches = $crudTache->findAll(2);
include 'header.php'
?>

    <div class="panel panel-primary col-sx-12" xmlns="http://www.w3.org/1999/html">
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
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Démmarez</button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="opac">
    <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-backdrop fade in" style="height: 984px;"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Chronomètre</h4>
                </div>
                <div class="modal-body">
                    <h2 class="text-center" id="chronotime">0:00:00:00</h2>
                    <form class="text-center" name="chronoForm">
                        <button class="btn btn-info" type="button" name="startstop" value="start!" onClick="chronoStart()" ><i class="fa fa-play"></i></button>
                        <button class="btn btn-info" type="button" name="reset" value="reset!" onClick="chronoReset()" ><i class="fa fa-refresh"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php' ?>