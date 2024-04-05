
$(document).ready(function(){
    console.log("Script chargé");
    $('.bouton-circulaire-nofav').click(function(){
        // Récupérer l'URL d'ajout aux favoris et l'ID du post à partir de l'élément de bouton cliqué
        var ajouterFavUrl = $(this).data('ajouter-fav-url');
        var postId = $(this).data('post-id');
        var button = $(this);

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
                alert('Article ajouté aux favoris avec succès');
                button.removeClass('bouton-circulaire-nofav').addClass('bouton-circulaire-fav');
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    });

    $('.bouton-circulaire-fav').click(function(){
        // Récupérer l'URL d'ajout aux favoris et l'ID du post à partir de l'élément de bouton cliqué
        var ajouterFavUrl = $(this).data('ajouter-fav-url');
        var postId = $(this).data('post-id');
        var button = $(this);

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
                alert('Article retiré des favoris avec succès');
                button.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    });
});
