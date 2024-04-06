$(document).ready(function(){

    const details = $('#details');

    $('.title').on('mouseenter', showTooltip);
        $('.title').on('mouseleave', hideTooltip);

        function showTooltip(event) {
            var postId = $(this).data('id');
            var slug = $(this).data('slug');
            var cate = $(this).data('cate');
            var readtime = $(this).data('readtime');
            var create = $(this).data('create');
            var role = $(this).data('role');

            details.css('opacity', '1');
            details.css('transition', 'all 0.3s ease');
            if (role == "Admin") {
                details.html('url' + ':' + ' ' + postId + '-' + slug + ' ' + 'Catégorie' + cate + 'Readtime' + readtime + role)
            }

             else {
                details.html('url' + ':' + ' ' + postId + '-' + slug + ' ')
            }



        }

        function hideTooltip() {
            details.css('opacity', '0');
            details.html(''); // Retirer le contenu de l'élément details

        }

        $(document.body).on('mousemove', function(event) {
            details.css('top', event.clientY);
            details.css('left', event.clientX - 650 + 'px');
        });
    });
