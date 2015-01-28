<?php include 'header.php';
 session_start();
?>

    <div class="panel panel-primary col-sx-12">
        <div class="panel-heading">
            <h3>Listes des tâches de : Matthieu Pringuez</h3>

        </div>
        <div class="panel-body tableau">


            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>N°</td>
                        <td>Titre</td>
                        <td>Description</td>
                        <td>Echéance</td>
                        <td>Temps prévisionel</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Réalisation du projet</td>
                        <td>Inisialisation du projet</td>
                        <td>2015-01-31</td>
                        <td>02:00:00</td>
                        <td><a href="#" class="btn btn-primary">Démmarez la tâche</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php'?>