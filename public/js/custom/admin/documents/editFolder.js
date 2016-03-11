$("#edit-folder").on('click', function(e){

	var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    localStorage.setItem('lastClickedtoTriggerModal', $(this).attr('data-folderId') );

    modalBody.empty();
    var folderEditLink = e.delegateTarget.href;
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(folderEditLink)
        })
        .modal({show:true});
    
    e.preventDefault();
});

$('.cancel-modal').click(function(e) {

	var modalBody = $('#mmmm-modal .modal-content');
	modalBody.empty();
	console.log("empty the modal");
});