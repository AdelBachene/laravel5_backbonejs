var root = document.querySelector('body').dataset.yarakuzenurl.replace('://', '');
if(!root.endsWith('/')) {
    root += '/';
}
var i = root.indexOf('/');
root = (i !== -1 && i+1 < root.length) ? root.substr(i) : root = '/';

require.config({
    baseUrl: root+'js',
    deps: ['app'],

    // DON'T USE CASH FOR DEV.
    urlArgs: "t=" + (new Date()).getTime(),

    paths: {
        jquery:     'node_modules/jquery/dist/jquery.min',
        lodash:     'node_modules/lodash/lodash.min',
        backbone:   'node_modules/backbone/backbone-min',
        toastr:     'node_modules/toastr/build/toastr.min'
    },
    map: {
        "*": {
            "underscore": "lodash"
        }
    }
});