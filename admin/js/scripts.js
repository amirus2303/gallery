$(document).ready(function(){
    /*Activer Editeur de text Tinymce*/
    tinymce.init({ selector:'textarea' });


    /*Affichage renseignements d'une image */
    var $user_id;
    var $image_id;
    var $image_name;
    $('.modal_thumbnails').click(function(){
        $('#set_user_image').prop('disabled', false);
        $image_id = $(this).attr('data-image-id');
        $image_name = $(this).attr('data-image-name');

        $.ajax({
           url : 'includes/ajax_photo_info.php',
           type : 'POST',
           data : {image_id: $image_id},
           dataType : 'json',
           success : function(data, statut){ // success est toujours en place, bien sûr !
            $('.filename').html(data['filename']);
            $('.type').html(data['type']);
            $('.size').html(data['size']);
           },

           error : function(resultat, statut, erreur){

           }

        });
    });

    /*Recupere User_id */
    $user_id = $('.img-thumbnail').attr('data-id');

    $('#set_user_image').click(function(){
        $.ajax({
           url : 'includes/ajax_code.php',
           type : 'POST',
           data : {user_id: $user_id, image_name: $image_name},
           dataType : 'html',
           success : function(data, statut){ // success est toujours en place, bien sûr !
               $('.img-thumbnail').attr('src', 'images/' + data);
           },

           error : function(resultat, statut, erreur){
           }

        });
    })

/*Dropdown photo informations*/
    $('body').on('click','.info-box-header.slideup',function(){

        $(this).find('.glyphicon').removeClass('glyphicon-menu-up').addClass('glyphicon-menu-down');
        $(this).removeClass('slideup').addClass('slidedown');
        $('.inside').slideUp();

    });

    $('body').on('click','.info-box-header.slidedown',function(){
        console.log('oui');
        $(this).find('.glyphicon').removeClass('glyphicon-menu-down').addClass('glyphicon-menu-up');
        $(this).removeClass('slidedown').addClass('slideup');
        $('.inside').slideDown();

    })


/*Delete confirm */
$('.delete_link').click(function(){
    return confirm("Are you sure ?");
})
    
});





