$(document).ready(function(){
    gestionnaireClicBoutons();

    $('input[type=radio][name=choice]').change(function() {
        if (this.value === 'form') {
            // Changer le comportement pour utiliser un formulaire
            $('.bouton-circulaire-fav').prop('type', 'submit');
            $('.bouton-circulaire-nofav').prop('type', 'submit');
            $('.bouton-circulaire-fav').off();
            $('.bouton-circulaire-nofav').off();
        } else if (this.value === 'jquery') {
            // Revenir au comportement jQuery/Ajax
            $('.bouton-circulaire-fav').prop('type', 'button');
            $('.bouton-circulaire-nofav').prop('type', 'button');
            gestionnaireClicBoutons();
        }
    });
    // Fonction pour gérer l'ajout ou le retrait d'un favori
    function toggleFavorite(ajouterFavUrl,removeAll, postId) {
        $.ajax({
            type: 'POST',
            url: ajouterFavUrl,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post_id: postId,
                removeAll : removeAll
            },
            success: function (response){

                if (removeAll === "true"){
                    var notif = $("#notification");
                    notif.removeClass('alert alert-success').addClass('alert alert-danger').html('Tous les articles ont été retirés de vos favoris');
                    notif.css('display', 'block');
                    setTimeout(function(){
                        notif.css('display', 'none');
                    }, 5000);

                    $.each($('.bouton-circulaire-fav'), function(index, button) {
                        var buttonElement = $(button);
                        var img = buttonElement.find('.star');

                        buttonElement.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
                        img.attr('src', '/img/star-empty.png');
                    });
                }
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    }

    // Fonction pour retirer un favori
    function removeFavorite(button) {
        var removeAll = button.attr('data-removeAll');
        var retirerFavUrl = button.data('ajouter-fav-url');
        var postId = button.data('post-id');
        // Appel AJAX pour retirer le favori
        toggleFavorite(retirerFavUrl, removeAll, postId);
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
                $('#favWindow').css('display', 'none');
                $('#favWindowWrapper').empty();
                // Afficher les favoris
                $.each(favoritePosts, function(index, favoritePost) {
                    var postId = favoritePost.id_pos;
                    $('#favWindowWrapper').append('<div id="favWindowPost'+ postId +'" class="favWindowPost"></div>');
                    $('#favWindowPost'+ postId).append('<p>' + favoritePost.title_pos + '</p>');
                    var slug = favoritePost.slug_pos;
                    var ajouterFavUrl = "/article/" + slug + "-" + postId;
                    var buttonHtml = '<button class="bouton favWindowButtons" data-ajouter-fav-url="' + ajouterFavUrl + '" data-post-id="'+ postId + '" >RETIRER</button>';
                    $('#favWindowPost'+ postId).append(buttonHtml);
                });

                // Afficher le nombre de favoris
                $('#favWindowWrapper').append('<p class="m-0" style="font-weight: bold"> Vous avez ' + favoritePosts.length + ' article(s) en favoris<p/>');

                //Création du bouton retirer tous les favoris
                var retirerTout = '<button class="bouton favWindowButtons mb-3" data-removeAll="true">RETIRER TOUS LES FAVORIS </button>';
                $('#favWindowWrapper').append(retirerTout);

                // Attacher l'événement de clic aux nouveaux boutons ajoutés
                $('#favWindowWrapper .bouton').on('click', function() {
                    removeFavorite($(this));
                });

                if (favoritePosts.length !== 0) {
                    $('#favWindow').css('display', 'block');
                }
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
    }

    // Gérer l'événement de clic sur les boutons
    // Définir une fonction pour gérer l'événement de clic sur les boutons
    function gestionnaireClicBoutons() {
        $('[class^="bouton-circulaire"]').on('click', function () {
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
                setTimeout(function () {
                    notif.css('display', 'none');
                }, 3000);
            } else if (button.hasClass('bouton-circulaire-fav')) {
                button.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
                img.attr('src', '/img/star-empty.png');
                notif.removeClass('alert alert-success').addClass('alert alert-danger').html('Article a bien été retiré des favoris');
                notif.css('display', 'block');
                setTimeout(function () {
                    notif.css('display', 'none');
                }, 3000); // 3000 millisecondes = 3 secondes
            }

            // Effectuer l'ajout ou le retrait du favori
            toggleFavorite(ajouterFavUrl, false, postId);

            // Afficher les favoris après l'ajout ou le retrait
            displayFavorites();
        });
    };

});
