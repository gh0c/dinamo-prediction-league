function ajaxCall(url, params) {

    return new Promise((resolve) => {
        $.ajax({
            url: url,
            method: 'POST',
            data: params
        }).done(response => {

            resolve(response);

        }).fail(jqXHR => {

            if (jqXHR['responseJSON'] && jqXHR['responseJSON']['error']) {
                handleAjaxError(jqXHR['responseJSON']['error']);
            }

        });
    });

}

function handleAjaxError(error) {
    if (typeof error === 'string') {

        $.toast({
            type: 'error',
            important: true,
            title: 'Error',
            content: error
        });

    } else if (typeof error === 'object') {

        for (let i = 0; i < error.length; i++) {
            (function (i) {
                setTimeout(function () {
                    $.toast({
                        type: 'error',
                        important: true,
                        title: 'Error',
                        content: error[i]
                    });
                }, 600 * i);
            }(i));
        }

    }
}

window.ajaxCall = ajaxCall;
