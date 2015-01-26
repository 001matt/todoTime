<?php include'header.php'?>

<div class="panel panel-info formulaire">
    <div class="panel-heading">
        <h3>Formulaire de création et de modification de tâches</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" action="" methode="post">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Titre de la tâche</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" placeholder="Titre de la tâche">
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Description de la tâche</label>
                <div class="col-sm-10">
                    <textarea type="textarea" rows="3" class="form-control" name="description" placeholder="Description de la tâche"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Echéance</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="echeance" >
                </div>
            </div>

            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Temps prévisionel</label>
                <div class="col-sm-10">
                    <input type="time" class="form-control" name="echeance" >
                </div>
            </div>

            <div class="form-group">
                <label for="echeance" class="col-sm-2 control-label">Utilisateur</label>
                <div class="col-sm-10">
                    <select name="user" id="" class="form-control">
                        <option value="user1">Prisca</option>
                        <option value="user1">Matthieu</option>
                        <option value="user1">Murielle</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-9 col-sm-10">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <button type="submit" class="btn btn-danger">Annuler</button>
                </div>
            </div>
            <div class="form-group modif">
                <div class="col-sm-offset-9 col-sm-10">
                    <button type="submit" class="btn btn-primary">Modification</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include'footer.php'?>