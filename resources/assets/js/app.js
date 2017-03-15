$(function() {
    $('option').mousedown(function(e) {
        e.preventDefault();
        $(this).prop('selected', $(this).prop('selected') ? false : true);
        return false;
    });
});


$(document).ready(function() {
    /* qTip2 call below will grab this JSON and use the firstName as the content */
    $('.qtip-articles').qtip({
        style: { classes: '.panel'},
        content: {
            text: function(event, api) {
                $.ajax ({
                    url: '/pagearticles/' + $(this).attr('id') // URL to the JSON script
                })
                    .then (function (content) {
                        api.set('content.text', content);
                    }, function(xhr, status, error) {
                        api.set('content.text', status + ": " + error);
                    });

                return 'Loading...';
            }
        }
    });
});
