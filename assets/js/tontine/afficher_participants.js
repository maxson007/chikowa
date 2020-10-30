import $ from "jquery";

let $buttonModal=$('#modal-afficher-participants-tontine');
$buttonModal.on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget) // Button that triggered the modal
    let association = button.data('association') // Extract info from data-* attributes
    let associationLibelle = button.data('association-libelle') // Extract info from data-* attributes
    let tontine = button.data('tontine') // Extract info from data-* attributes
    let tontineLibelle = button.data('tontine-libelle') // Extract info from data-* attributes
    let url = button.data('url') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    fetch(url,{
        method: 'GET'
    }).then(function (response){
        return response.json()
    }).then(function (json){
        console.log(json)
    })
    let modal = $(this)
    console.log(url);
    modal.find('.modal-title').text(tontineLibelle+' : Participants')
    modal.find('.modal-body input').val(tontine)
})