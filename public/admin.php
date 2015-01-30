<?php
session_start();
require_once '../application/init.php';

use todo\DbTable\Tache;

$crudTache = new Tache($connection);
$taches = $crudTache->findAll();
if (isset($_GET['id'])) {

    $crudTache->delete($_GET['id']);
}
include 'header.php';
?>

<div class="panel panel-primary col-sx-12">
    <div class="panel-heading">
        <h3>Listes des tâches <a href="form.php" class="btn btn-primary pull-right"><span class="fa fa-plus fa-2x"></span></a></h3>
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
                               echo $description = substr($tache->getDescription(),0, 30) . "...";?>
                            <a href='#' id='pop' data-toggle='popover' data-trigger='focus' data-content="
                                <?= $tache->getDescription(); ?>" title='Description'>voir détails </a>
                            <?php
                            }else{
                               echo $description = $tache->getDescription();
                            } ?></td>
                        <td><?php echo date("d-m-Y", strtotime($tache->getEcheance())); ?></td>
                        <td><?= $tache->getTimerealisation(); ?></td>
                        <td><?= $tache->getStatutToString($tache->getStatut()); ?></td>
                        <td><?php foreach ($tache->getUsers() as $value) {
                                echo $value->getName() . ' ' . $value->getFirstname() . '<br>';
                            }; ?></td>
                        <td>
                            <a href="form.php?id=<?= $tache->getId(); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <a href="admin.php?id=<?= $tache->getId(); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

    </div>
</div>
<?php include 'footer.php' ?>
