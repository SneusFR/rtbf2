$(document).ready(function(){

    // Fonction pour gérer l'ajout ou le retrait d'un favori
    function toggleFavorite(ajouterFavUrl, postId) {
        $.ajax({
            type: 'POST',
            url: ajouterFavUrl,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post_id: postId
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    }

    // Fonction pour retirer un favori
    function removeFavorite(button) {
        var retirerFavUrl = button.data('ajouter-fav-url');
        var postId = button.data('post-id');
        // Appel AJAX pour retirer le favori
        toggleFavorite(retirerFavUrl, postId);
        // Actualiser les favoris affichés
        displayFavorites();

        var button = $('#' + postId);
        var img = button.find('.star');

        if (button.hasClass('bouton-circulaire-nofav')) {
            button.removeClass('bouton-circulaire-nofav').addClass('bouton-circulaire-fav');
            img.attr('src', '/img/star-filled.svg');
        }
        else if (button.hasClass('bouton-circulaire-fav')) {
            button.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
            img.attr('src', '/img/star-empty.png');
        }
    }

    // Fonction pour récupérer les favoris et les afficher
    function displayFavorites() {
        $.ajax({
            type: 'GET',
            url: '/getFavorite',
            success: function (favoritePosts) {
                $('#favWindow').empty();
                // Afficher les favoris
                $.each(favoritePosts, function(index, favoritePost) {
                    $('#favWindow').append('<p>' + favoritePost.title_pos + '</p>');
                    var slug = favoritePost.slug_pos;
                    var postId = favoritePost.id_pos;
                    var ajouterFavUrl = "/article/" + slug + "-" + postId;
                    var buttonHtml = '<button class="bouton" data-ajouter-fav-url="' + ajouterFavUrl + '" data-post-id="'+ postId + '" >retirer</button>';
                    $('#favWindow').append(buttonHtml);
                });
                // Attacher l'événement de clic aux nouveaux boutons ajoutés
                $('#favWindow .bouton').on('click', function() {
                    removeFavorite($(this));
                });

            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    }

    // Gérer l'événement de clic sur les boutons
    $('[class^="bouton-circulaire"]').on('click', function(){
        var ajouterFavUrl = $(this).data('ajouter-fav-url');
        var postId = $(this).data('post-id');
        var button = $(this);
        var img = button.find('.star');
        var notif = $("#notification");

        if (button.hasClass('bouton-circulaire-nofav')) {
            button.removeClass('bouton-circulaire-nofav').addClass('bouton-circulaire-fav');
            img.attr('src', '/img/star-filled.svg');
            notif.removeClass('alert alert-danger').addClass('alert alert-success').html('Article ajouté aux favoris avec succès');
            notif.css('display', 'block');
            setTimeout(function(){
                notif.css('display', 'none');
            }, 3000); // 3000 millisecondes = 3 secondes
        }
        else if (button.hasClass('bouton-circulaire-fav')) {
            button.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
            img.attr('src', '/img/star-empty.png');
            notif.removeClass('alert alert-success').addClass('alert alert-danger').html('Article a bien été retiré des favoris');
            notif.css('display', 'block');
            setTimeout(function(){
                notif.css('display', 'none');
            }, 3000); // 3000 millisecondes = 3 secondes
        }

        // Effectuer l'ajout ou le retrait du favori
        toggleFavorite(ajouterFavUrl, postId);

        // Afficher les favoris après l'ajout ou le retrait
        displayFavorites();
    });

});
