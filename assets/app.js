/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

require('select2');

// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
/*    $('select[data-select="true"]').select2({
        theme: 'bootstrap4',
    });*/
    let $associationVille = $('#association_ville');
    $associationVille.change(function() {
        let $form = $(this).closest('form');
        let data = {};
        data[$associationVille.attr('name')] = $associationVille.val();
      $.ajax({
            url : $form.attr('action'),
            type: $form.attr('method'),
            data : data,
            success: function(html) {
                $('#association_localisation').replaceWith(
                    $(html).find('#association_localisation')
                );
                //$('#ville_group_form').hide('fade');
            }
        });
    });
});