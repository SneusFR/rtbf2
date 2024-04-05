
$(document).ready(function(){
    console.log("Script chargé");
    $('[class^="bouton"]').on('click', function(){
        // Récupérer l'URL d'ajout aux favoris et l'ID du post à partir de l'élément de bouton cliqué
        var ajouterFavUrl = $(this).data('ajouter-fav-url');
        var postId = $(this).data('post-id');
        var button = $(this);
        var img = button.find('.star'); // Sélectionner l'élément img à l'intérieur du bouton
        var notif = $("#notification"); // Sélectionner la div avec l'ID notification


        if (button.hasClass('bouton-circulaire-nofav')) {
            button.removeClass('bouton-circulaire-nofav').addClass('bouton-circulaire-fav');
            img.attr('src', '/img/star-filled.svg');
        }

        else {
            button.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
            img.attr('src', '/img/star-empty.png');
            notif.removeClass('alert alert-success').addClass('alert alert-danger').html('Article a bien été retiré des favoris');
            notif.css('display', 'block');
            setTimeout(function(){
                notif.css('display', 'none');
            }, 3000); // 3000 millisecondes = 3 secondes
        }

        // Effectuer la requête AJAX
        $.ajax({
            type: 'POST',
            url: ajouterFavUrl,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post_id: postId
            },
            success: function(data){
                // Afficher un message de succès ou mettre à jour l'interface utilisateur

            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    });
});
