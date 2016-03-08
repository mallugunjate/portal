$("#add-folder").on('click', function(e){

	var modal = $('#mmmm-modal');
    var modalBody = $('#mmmm-modal .modal-content');
    localStorage.setItem('lastClickedtoTriggerModal', $(this).attr('data-folderId') );

    modalBody.empty();
    var folderCreateLink = e.delegateTarget.href;
    console.log(folderCreateLink);
    
    modal
        .on('show.bs.modal', function() {
            modalBody.load(folderCreateLink)
        })
        .modal({show:true});
    
    e.preventDefault();
});

$('.cancel-modal').click(function(e) {

	var modalBody = $('#mmmm-modal .modal-content');
	modalBody.empty();
	console.log("empty the modal");
});