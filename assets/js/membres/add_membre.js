import $ from 'jquery';
let $collectionHolder;

// setup an "add a tag" link
let $addMembreButton = $('<button type="button" class="add_memebre btn btn-primary rounded-pill mt-2"> <i class="fa fa-user-plus"></i> </button>');
let $newMembreTr = $('<tr></tr>').append($addMembreButton);

$(document).ready(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('tbody.membres');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newMembreTr);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find('input').length);

    $addMembreButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addMembreForm($collectionHolder, $newMembreTr);
    });
    $collectionHolder.on('click', '.js-remove-membre', function(e) {
        e.preventDefault();
        $(this).closest('.js-membre-item')
            .fadeOut()
            .remove();
    });

    $collectionHolder.on('click', '.js-edit-membre', function(e) {
        e.preventDefault();
        let line=$(this).closest('.js-membre-item');
            line.find('input').each(function (){
                $(this).removeAttr( "disabled" );
            });
    });
});
function addMembreForm($collectionHolder, $newMembreTr) {
    // Get the data-prototype explained earlier
    let prototype = $collectionHolder.data('prototype');

    // get the new index
    let index = $collectionHolder.data('index');

    let newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
     //newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    // Display the form in the page in an li, before the "Add a tag" link li
    let $newFormTr = $('<tr></tr>').append(newForm);
    $newMembreTr.before($newFormTr);
}