$(document).ready(function () {
    $('body').on('dblclick', '#addUsers option', function () {
        $('#selectedUser').append('<option value=' + $(this).val() + '>' + $(this).html() + '</option>');
        $.ajax({
            type: "POST",
            url: "http://127.0.0.1/todoTime/application/controller/ctrlTache.php?action=addAssign&idUser="+$(this).val()+"&idTache="+$('#idTache').val()+""
        }).done(function (msg) {
            alert("Data Saved: " + msg);
        });
    });

    $('body').on('dblclick', '#selectedUsers option', function () {
        $.ajax({
        type: "POST",
        url: "http://127.0.0.1/todoTime/application/controller/ctrlTache.php?action=removeUser&idUser="+$(this).val()+"&idTache="+$('#idTache').val()+""
        }).done(function( msg ) {
          alert( "Data Saved: " + msg );
        });

        $($(this)).remove();
    });
});