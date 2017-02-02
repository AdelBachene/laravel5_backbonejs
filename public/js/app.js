define([
        'jquery', 'backbone', 'toastr', 'routers/book'
    ],
    function($, Backbone, toastr, BooksRouter) {
        var yarakuzenUrl = document.querySelector('body').dataset.yarakuzenurl;
        if (!yarakuzenUrl.endsWith('/')) {
            yarakuzenUrl += '/';
        }

        var root = yarakuzenUrl.replace('://', '');
        var i = root.indexOf('/');
        root = (i !== -1 && i + 1 < root.length) ? root.substr(i) : root = '/';
        var getRelativeUrl = function (url, yarakuzenUrl) {
            var i = url.indexOf(yarakuzenUrl);
            return (i > -1 ? url.substr(i + yarakuzenUrl.length) : url);
        };

        Backbone.history.start({
            pushState: true,
            silent: false,
            root: root
        });
        
        $(document).on('click', 'a:not([data-bypass])', function (e) {
            var href = $(this).attr('href');
            if (href.length && href.substr(0, 1) != '#') {
                e.preventDefault();
                href = href.replace(/^.*\/\/[^\/]+/, '');
                BooksRouter.navigate(getRelativeUrl(href, root), {trigger: true});
            }
        });

        // detect correct link in case of redirect.
        var xhr;
        var _orgAjax = jQuery.ajaxSettings.xhr;
        jQuery.ajaxSettings.xhr = function () {
            xhr = _orgAjax();
            return xhr;
        };

        $(document).on('submit', 'form:not([data-bypass])', function (e) {
            var $form = $(this);
            var href = $form.attr('action');

            if (href.length && href.substr(0, 1) != '#') {
                e.preventDefault();

                $.ajax({
                    type: $form.attr('method'),
                    url: Backbone.history.root + getRelativeUrl(href, root),
                    data: $form.serialize(),
                    error:function(jqXHR, textStatus, errorThrown) {
                        if(jqXHR.status == 422) { // in case of validation error Laravel sends back a 422 error.
                            $form.find('.has-error').removeClass('has-error');
                            var errors = jqXHR.responseJSON;
                            var errorsToDisplay = [];
                            $.each(errors, function(k, v) {
                                $form.find('label[for='+k+']').parents('.form-group').addClass('has-error');
                                errorsToDisplay.push(v[0] || v);
                            });
                            toastr.error(errorsToDisplay.join('<br />'), 'Validation errors', {timeOut: 3000});
                        }
                        else {
                            toastr.error('Code: '+jqXHR.status, 'Error', {timeOut: 3000});
                        }
                    },
                    success:function(data) {
                        document.querySelector('#page-content').innerHTML = data;
                        BooksRouter.navigate(getRelativeUrl(xhr.responseURL, root));
                    },
                });
            }

            return false;
        });
    });