$(document).ready(function(){

    gestionnaireClicBoutons();

    var roleValue = $('main').data('role');

    // Gérer l'événement de clic sur les boutons
    // Définir une méthode pour gérer l'événement de clic sur les boutons

    function gestionnaireClicBoutons() {
        $('[class^="bouton-circulaire"]').off().on('click', function () {
            var button = $(this);
            var roleValue = $('main').data('role');

            if (roleValue === 'invite') {
                afficherNotification('alert-danger', 'Vous devez vous connecter');
                return;
            }
            afficherNotification(button.hasClass('bouton-circulaire-nofav') ? 'alert-success' : 'alert-danger', button.hasClass('bouton-circulaire-nofav') ? 'Article ajouté aux favoris avec succès' : 'Article a bien été retiré des favoris');
            toggleFavorite(button);
            displayFavorites();
        });
    };

    //Gérer la notif qui s'affichera lors de la suppression ou du rajout d'un favoris
    function afficherNotification(type, message) {
        var notif = $("#notification");
        notif.removeClass('alert alert-danger alert-success').addClass('alert ' + type).html(message).css('display', 'block');
        setTimeout(function () {
            notif.css('display', 'none');
        }, 3000);
    }

    //Mettre un événément d'écoute on change sur les radio button
    $('input[type=radio][name=choice]').change(function() {
        if (this.value === 'form') {
            // Changer le comportement pour utiliser un formulaire
            $('.bouton-circulaire-fav').prop('type', 'submit');
            $('.bouton-circulaire-nofav').prop('type', 'submit');
            $('.bouton-circulaire-fav').off();
            $('.bouton-circulaire-nofav').off();

        }
        else if (this.value === 'jquery') {
            // Revenir au comportement jQuery/Ajax
            $('.bouton-circulaire-fav').prop('type', 'button');
            $('.bouton-circulaire-nofav').prop('type', 'button');
            gestionnaireClicBoutons();
        }
    });

    // Fonction pour gérer l'ajout ou le retrait d'un favori
    function toggleFavorite(button) {
        var removeAll = button.attr('data-removeAll');
        var retirerFavUrl = button.data('ajouter-fav-url');
        var postId = button.data('post-id');

        $.ajax({
            type: 'POST',
            url: retirerFavUrl,
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                post_id: postId,
                removeAll : removeAll
            },
            success: function (response){
                if (removeAll === "true") afficherNotification('alert-danger', 'Tous les articles ont été retirés de vos favoris');
            },
            error: function(xhr, status, error) {
                alert('La requête AJAX a échoué : ' + error);
            }
        });
        displayFavorites();
    }

    //Gérer l'affichage des favoris
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

                var testbouton = $('.bouton-circulaire-fav');
                testbouton.removeClass('bouton-circulaire-fav').addClass('bouton-circulaire-nofav');
                testbouton.find('.star').attr('src', '/img/star-empty.png');

                // Parcourir les favoris
                $.each(favoritePosts, function(index, favoritePost) {
                    var postId = favoritePost.id_pos;
                    var button = $('#' + postId); // Sélectionnez le bouton correspondant à l'ID du favori
                    var img = button.find('.star');

                    img.attr('src', '/img/star-filled.svg');
                    button.removeClass('bouton-circulaire-nofav').addClass('bouton-circulaire-fav');
                });

                // Afficher le nombre de favoris
                $('#favWindowWrapper').append('<p class="m-0" style="font-weight: bold"> Vous avez ' + favoritePosts.length + ' article(s) en favoris<p/>');

                //Création du bouton retirer tous les favoris
                var retirerTout = '<button class="bouton favWindowButtons mb-3" data-removeAll="true">RETIRER TOUS LES FAVORIS </button>';
                $('#favWindowWrapper').append(retirerTout);

                // Attacher l'événement de clic aux nouveaux boutons ajoutés
                $('#favWindowWrapper .bouton').on('click', function() {
                    toggleFavorite($(this));
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
});
