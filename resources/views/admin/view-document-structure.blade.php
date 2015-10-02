<html>
<head>
	<title></title>
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/tree.css">
	<link rel="stylesheet" type="text/css" href="/css/dz.css">
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">
	<link rel="stylesheet" type="text/css" href="/css/document-upload.css">


</head>
<body>
  <div id="admin-container" class= "col-md-10 ">
    <div class="row">
          <select id="banner_id" name="banner_id">
              <option > Choose Banner</option>
              <option value="1">Sportchek</option>
              <option value="2">Atmosphere</option>
          </select>    
    </div>
  	<div class="row">
  		<div class="col-md-3">
  			@include('admin.view-folder-structure', ['navigation'=>$navigation])
  		</div>
  		<div class="col-md-9">
  			<div id="file-container">
  				@include('admin.view-documents')
  			</div>
  			<div id="file-uploader">
  				@include('admin.document-upload')
  			</div>

  		</div>

  	</div>
  </div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" src= "/js/underscore-1.8.3.js"></script>
<script type="text/javascript" src="/js/tree.js"></script>
<script type="text/javascript" src="/js/folderStructure.js" ></script>
<script src="/js/dropzone.js"></script>


<script>
	$(document).ready(function() {
		$(".tree").treed({openedClass : 'glyphicon glyphicon-folder-open', closedClass : 'glyphicon glyphicon-folder-close'});

		$("#banner_id").on("change", function() {
        var banner_id = $("#banner_id option:selected").val();
        window.location = "/admin/home?banner_id=" + banner_id;
    });
	});
	// HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
    
      // Get the template HTML and remove it from the doument
      var previewNode = document.querySelector("#template");
      previewNode.id = "";
      var previewTemplate = previewNode.parentNode.innerHTML;
      previewNode.parentNode.removeChild(previewNode);

        var titles = $('.title');
        var descriptions = $('.description');
        var titleArray = [];
        var descArray = [];

      var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/admin/document/create", // Set the url
        paramName: "document",
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        addRemoveLinks: false,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        accept: function(file, done) {
            // TODO: Image upload validation
            done();
        },
        sending: function(file, xhr, formData) {
        	console.log($('#folder-title').attr('data-folderid'));
            // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
            formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
            formData.append("folder_id", $('#folder-title').attr('data-folderid')); 
            formData.append("upload_package_id", $('[name=upload_package_id').val()); 
            
            
        },
        init: function() {

            this.on("success", function(file, response) {
                
            });
        }

      });

      myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
      });

      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
      });

      myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
      });

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0";

        //var metadatalink = document.createElement("a");
        var metadatalink = $("<a class='button' href='/admin/document/add-meta-data?package={{ $packageHash }}'>Add Title and Description for these Files</a>");
        $(metadatalink).appendTo("#file-uploader #container");

      });

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
      };
      document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true);
      };

    

</script>
</html>

