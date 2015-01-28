$( document ).ready(function() {
    
    $('body').on('dblclick','#addUser option', function(){
      console.log($(this).val());
      $('#selectUser').append('<option value='+ $(this).val() +'>'+$(this).html()+'</option>');
      $($(this)).remove();
    });

    $('body').on('dblclick','#selectUser option', function(){
     $($(this)).remove();
    });
});


