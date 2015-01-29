<?php
require_once '../application/init.php';

use todo\DbTable\Tache;
 session_start();
$crudTache = new Tache($connection);
$taches = $crudTache->findAll();
if (isset($_GET['id'])) {

    $crudTache->delete($_GET['id']);
}
include 'header.php';
?>

<div class="panel panel-primary col-sx-12">
    <div class="panel-heading">
        <h3>Listes des tâches <a href="form.php" class="btn btn-primary pull-right">Créez une nouvelle tâche</a></h3>
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
                    <tr <?php if($tache->getStatut() === 3):?>style="active"<?php endif;?>>
                        <td><?= $tache->getTitre(); ?></td>
                        <td><?php if(iconv_strlen($tache->getDescription()) >= 30){
                               echo $description = substr($tache->getDescription(),0, 30) . "...";
                                ?> <a href='#' id='pop' data-toggle='popover' data-trigger='focus' data-content="<?= $tache->getDescription(); ?>" title='Description'>
voir détails</a><?php
                            }else{
                               echo $description = $tache->getDescription();
                            } ?></td>
                        <td><?= $tache->getEcheance(); ?></td>
                        <td><?= $tache->getTimerealisation(); ?></td>
                        <td><?= $tache->getStatutToString($tache->getStatut()); ?></td>
                        <td><?php foreach ($tache->getUsers() as $value) {
                                echo $value->getName() . ' ' . $value->getFirstname() . '<br>';
                            }; ?></td>
                        <td>
                            <a href="form.php?id=<?= $tache->getId(); ?>" class="btn btn-primary"><i class="fa fa-pencil fa-2x"></i></a>
                            <a href="admin.php?id=<?= $tache->getId(); ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-2x"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-backdrop fade in" style="height: 984px;"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Description de la tâche</h4>
                    </div>
                    <div class="modal-body">
                        <h4>Description</h4>
                        <p><?= $tache->getDescription(); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
</div>
<?php include 'footer.php' ?>
