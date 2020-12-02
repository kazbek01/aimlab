CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
    config.extraPlugins = 'base64image';
    //config.extraPlugins = 'mathjax';
    //config.mathJaxLib = '//cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML';
    config.mathJaxLib = '/custom/js/MathJax.js?config=TeX-AMS_HTML';

    config.toolbar = 'MyToolbar';
    config.height = '100px';
    //config.removePlugins = 'easyimage, cloudservices';
    config.toolbar_MyToolbar =
        [
            [ 'Bold', 'Italic', 'Underline', 'TextColor', 'NumberedList',
                'BulletedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock','Maximize','Undo', 'Redo','PasteFromWord',
                'Link', 'UnLink', 'Table',  'Font', 'FontSize','base64image',  'Mathjax','Iframe',
            ]
        ];
};