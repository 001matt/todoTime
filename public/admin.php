<?php include 'header.php'?>
<div class="row">
    <div class="">
        <div class="panel panel-primary">
    <div class="panel-heading">
        <h3>Listes des tâches <a href="#" class="btn btn-warning pull-right">Créez une nouvelle tâche</a></h3>

    </div>
    <div class="panel-body tableau">


    <div class="table table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>N°</td>
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
            <tr>
                <td>1</td>
                <td>Réalisation du projet</td>
                <td>Inisialisation du projet</td>
                <td>2015-01-31</td>
                <td>02:00:00</td>
                <td>0</td>
                <td>Prisca</td>
                <td><a href="#" class="btn btn-primary">Modifier</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
            </tr>

            <tr>
                <td class="danger">2</td>
                <td class="danger">Création de la base</td>
                <td class="danger">Avec phpmyadmin</td>
                <td class="danger">2015-01-31</td>
                <td class="danger">02:00:00</td>
                <td class="danger">2</td>
                <td class="danger">Matthieu</td>
                <td><a href="#" class="btn btn-primary">Modifier</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
            </tr>

            <tr>
                <td class="success">3</td>
                <td class="success">Création de la base</td>
                <td class="success">Avec phpmyadmin</td>
                <td class="success">2015-01-31</td>
                <td class="success">02:00:00</td>
                <td class="success">1</td>
                <td class="success">Murielle</td>
                <td><a href="#" class="btn btn-primary">Modifier</a> <a href="#" class="btn btn-danger">Supprimer</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</div>
    </div>
</div>
<?php include 'footer.php'?>