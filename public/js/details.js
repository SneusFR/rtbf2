$(document).ready(function(){

    const details = $('#details');

    $('.title').on('mouseenter', showTooltip);
        $('.title').on('mouseleave', hideTooltip);

        function showTooltip(event) {
            var postId = $(this).data('details');
            details.css('opacity', '1');
            details.css('transition', 'all 0.3s ease');
            details.html(postId)
        }

        function hideTooltip() {
            details.css('opacity', '0');
        }

        $(document.body).on('mousemove', function(event) {
            details.css('top', event.clientY);
            details.css('left', event.clientX - 650 + 'px');
        });
    });
