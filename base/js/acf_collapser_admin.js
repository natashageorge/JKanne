jQuery(document).ready(function($) {
    'use strict';

    function acfCollapserInit() {
        var $collapseAllButton = '<button type="button" role="button" class="button field-repeater-toggle field-repeater-toggle-all">'+ acf_collapser_admin.expandCollapseRows + '</button>';

        if($('.acf-field-flexible-content').length > 0) {
            $('.acf-field-flexible-content>.acf-label').append($collapseAllButton);

            if ($(".acf-flexible-content>.values>.layout.-collapsed").length == $(".acf-flexible-content>.values>.layout").length) {

            }

            $( '.field-repeater-toggle-all' ).on('click', function() {
                if ($(".acf-flexible-content>.values>.layout.-collapsed").length == $(".acf-flexible-content>.values>.layout").length) {
                    $(".acf-flexible-content>.values>.layout.-collapsed .acf-icon.-collapse").trigger('click');
                }else{
                    $(".acf-flexible-content>.values>.layout").not(".-collapsed").find('.acf-icon.-collapse').trigger('click');
                }

            })
        }
    }

    acfCollapserInit();
});