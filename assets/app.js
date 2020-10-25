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
require('./js/membres')
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $('select[data-select="true"]').select2({
        theme: 'bootstrap4',
    });
    $('.alert').alert()

    //let $associationVille = $('#association_ville');
    let $associationLocalisation=$('#association_localisation');
    $associationLocalisation.select2({
        theme: 'bootstrap4',
        ajax: {
            url: "https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=100&polygon_svg=1",
            delay: 250,
            dataType: 'json',
            data: function (term) {
                var query = {
                    city: term.term
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.display_name+'-->'+item.place_id,
                            text: item.display_name,
                        }
                    })
                };
            }
        },
        minimumInputLength: 1,
        placeholder: 'Saisir une ville',
    });
});