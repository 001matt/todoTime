$(document).ready(function () {
    $('body').on('dblclick', '#addUser option', function () {
        $('#selectUser').append('<option value=' + $(this).val() + '>' + $(this).html() + '</option>');
        //mettre une cle pour l'ajoute ou la supression
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1/todoTime/application/controller/ctrlTache.php?idUser=2&idTache=2"
        }).done(function (msg) {
            alert("Data Saved: " + msg);
        });
    });

    $('body').on('dblclick', '#selectedUsers option', function () {
        $.ajax({
        type: "POST",
        url: "http://127.0.0.1/todoTime/application/controller/ctrlTache.php?action=removeUser&idUser=2&idTache=2"
        }).done(function( msg ) {
          alert( "Data Saved: " + msg );
        });

        $($(this)).remove();
    });
});