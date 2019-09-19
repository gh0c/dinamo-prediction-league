/**
 * @original_author Script47 (https://github.com/Script47/Toast)
 **/
(function ($) {

    $.toast = function (opts) {

        let important = opts['important'] || false,
            html,
            bgHeaderClass = '',
            fgHeaderClass = '',
            title = opts['title'] || 'Error!',
            content = opts['content'] || '',
            type = opts['type'] || 'info',
            delay = opts['delay'] || 5000;

        switch (type) {
            case 'info':
                bgHeaderClass = 'bg-info';
                fgHeaderClass = 'text-white';
                break;

            case 'success':
                bgHeaderClass = 'bg-success';
                fgHeaderClass = 'text-white';
                break;

            case 'warning':
            case 'warn':
                bgHeaderClass = 'bg-warning';
                fgHeaderClass = '';
                break;

            case 'error':
            case 'danger':
                bgHeaderClass = 'bg-danger';
                fgHeaderClass = 'text-white';
                break;
        }

        html = '<div class="toast-header ' + bgHeaderClass + '">'
            + '<span class="mr-auto ' + fgHeaderClass + '">'
            + title
            + '</span>'
            + '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">'
            + '<span aria-hidden="true">&times;</span>'
            + '</button>'
            + '</div>'

            + '<div class="toast-body">'
            + content
            + '</div>';

        if (important === true) {
            html = '<div class="toast bg-light ml-auto mt-3 mr-2" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">' + html + '</div>';
        } else {
            html = '<div class="toast bg-light ml-auto mt-3 mr-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="' + delay + '">' + html + '</div>';
        }

        $('.toasts-container').append(html);
        $('.toasts-container .toast:last').toast('show');
    }

}(jQuery));