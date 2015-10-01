<html>

<head>
    <title>File Upload</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/css/dz.css">
    <link rel="stylesheet" type="text/css" href="/css/dropzone.css">




    <style>
    html, body {
      height: 100%;
    }
    #actions {
      margin: 2em 0;
    }


    /* Mimic table appearance */
    div.table {
      display: table;
    }
    div.table .file-row {
      display: table-row;
    }
    div.table .file-row > div {
      display: table-cell;
      vertical-align: top;
      border-top: 1px solid #ddd;
      padding: 8px;
    }
    div.table .file-row:nth-child(odd) {
      background: #f9f9f9;
    }



    /* The total progress gets shown by event listeners */
    #total-progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the progress bar when finished */
    #previews .file-row.dz-success .progress {
      opacity: 0;
      transition: opacity 0.3s linear;
    }

    /* Hide the delete button initially */
    #previews .file-row .delete {
      display: none;
    }

    /* Hide the start and cancel buttons and show the delete button */

    #previews .file-row.dz-success .start,
    #previews .file-row.dz-success .cancel {
      display: none;
    }
    #previews .file-row.dz-success .delete {
      display: block;
    }

    </style>

    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="/js/dropzone.js"></script>

</head>


<body>

<div class="container" id="container">
   <div id="actions" class="row">
    {!! csrf_field() !!}
    <input type="hidden" name="upload_package_id" value="{{ $packageHash }}" />
    <input type="hidden" name="folder_id" value="3" />

      <div class="col-lg-7">
        <!-- The fileinput-button span is used to style the file input field as button -->
        <span class="btn btn-success fileinput-button dz-clickable">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Add files...</span>
        </span>
        <button type="submit" class="btn btn-primary start">
            <i class="glyphicon glyphicon-upload"></i>
            <span>Start upload</span>
        </button>
        <button type="reset" class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span>Cancel upload</span>
        </button>
      </div>

      <div class="col-lg-5">
        <!-- The global file processing state -->
        <span class="fileupload-process">
          <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="opacity: 0;">
            <div class="progress-bar progress-bar-success" style="width: 100%;" data-dz-uploadprogress=""></div>
          </div>
        </span>
      </div>

    </div>

    <div class="table table-striped" id="previews">

        <div id="template" class="file-row">
        <!-- This is used as the file preview template -->
            <div>
                <span class="preview"><img data-dz-thumbnail /></span>
            </div>

            <div>
                <p class="name" data-dz-name></p>
{{--                 <input type="text" name="title[]" />
                <input type="text" name="description[]" /> --}}
                <strong class="error text-danger" data-dz-errormessage></strong>
            </div>

            <div>
                <p class="size" data-dz-size></p>
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                  <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </div>

            <div>
              <button class="btn btn-primary start">
                  <i class="glyphicon glyphicon-upload"></i>
                  <span>Start</span>
              </button>
              <button data-dz-remove class="btn btn-warning cancel">
                  <i class="glyphicon glyphicon-ban-circle"></i>
                  <span>Cancel</span>
              </button>
              <button data-dz-remove class="btn btn-danger delete">
                <i class="glyphicon glyphicon-trash"></i>
                <span>Delete</span>
              </button>
            </div>
      </div>

    </div>
</div>


<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
    <script>
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
            // Pass token. You can use the same method to pass any other values as well such as a id to associate the image with for example.
            formData.append("_token", $('[name=_token').val()); // Laravel expect the token post value to be named _token by default
            formData.append("folder_id", $('[name=folder_id').val()); 
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
        $(metadatalink).appendTo("body");

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
</body>

</html>