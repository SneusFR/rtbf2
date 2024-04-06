$(document).ready(function(){

    const details = $('#details');
    const idText = $('#idText');
    const createdAtText = $('#createdAtText');
    const readtimeText = $('#readtimeText');
    const cateText = $('#cateText');
    const lengthText = $('#lengthText');
    const roleText = $('#roleText');


    $('.title').on('mouseenter', showTooltip);
    $('.title').on('mouseleave', hideTooltip);

        function showTooltip(event) {
            var idPos = $(this).data('id');
            var slugPos = $(this).data('slug');
            var createdAtPos = $(this).data('create');
            var readtimePos = $(this).data('readtime');
            var catePos = $(this).data('cate');
            var lengthPos = $(this).data('length');
            var rolePos = $(this).data('role');

            details.css('opacity', '1');
            details.css('transition', 'all 0.3s ease');
            if (rolePos == "Admin") {
                idText.append(idPos);
                createdAtText.append(createdAtPos);
                readtimeText.append(readtimePos + ' min');
                cateText.append(catePos);
                lengthText.append(lengthPos + ' Characters');
                roleText.append(rolePos);
            }
             else {
                createdAtText.append(createdAtPos);
                readtimeText.append(readtimePos + ' min');
                cateText.append(catePos);
             }
        }

        function hideTooltip() {
            details.css('opacity', '0');
            idText.empty();
            createdAtText.empty();
            readtimeText.empty();
            cateText.empty();
            lengthText.empty();
            roleText.empty();
        }

        $(document.body).on('mousemove', function(event) {
            details.css('top', event.clientY - 100 + 'px');
            details.css('left', event.clientX - 350 + 'px');
        });
    });
