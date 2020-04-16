var featuredExists = businessExists = false;
var featuredCropper;
var businessCropper;
var featuredRemove;
var businessRemove;
var fieldImage;
var fieldCropper;
var limitOff = true;
var FEATURE_MIN_WIDTH  = 372,
    FEATURE_MIN_HEIGHT = 248;

var cropperDefaults = {
    movable: false,
    scalable: false,
    zoomable: false,
    rotatable: false,
    viewMode: 1,
    autoCropArea: 1,
    minContainerWidth: 300
};

function getFileExtention(file) {
    var extension = file.substr( (file.lastIndexOf('.') +1) );
    switch(extension) {
        case 'jpg':
        case 'jpeg':
        case 'jpg':
            return 'jpeg';
        break;
        case 'png':
            return 'png';
        break;
        default:
            return false;
    }
};

function cropProcess(field) {
  if(jQuery('#'+field+'-crop-wrap').css('visibility') == 'hidden'){
      jQuery('#'+field+'-crop-wrap').css({'position':'static','visibility':'visible'});
      jQuery('#'+field+'-crop-button').html('Done');
  }else{
      jQuery('#'+field+'-crop-wrap').css({'visibility':'hidden','position':'absolute'});
      if (field == 'featured') {
        fieldCropper = featuredCropper;
      }
      if (field == 'business') {
        fieldCropper = businessCropper;
      }
      fieldCropper.getCroppedCanvas().toBlob(function (blob) {
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(blob);
          jQuery('#'+field+'-image-upload img').attr("src", imageUrl);
      });
      if (field == 'featured') {
        featuredCropper = fieldCropper;
      }
      if (field == 'business') {
        businessCropper = fieldCropper;
      }

      jQuery('#'+field+'-crop-button').html('Crop');
  }
}

function switchDZ(field,status) {
  if (status == 'show') {
    jQuery('#'+field+'-image-upload .dz-default').css("display", "block").addClass("dz-clickable");
  } else if (status == 'hide') {
    jQuery('#'+field+'-image-upload .dz-default').css("display", "none").removeClass("dz-clickable");
  }

}

function createMockFile(fileURL) {
  var ext = getFileExtention(fileURL);
  var mockFile = {
      name: "mock.jpg",
      size: 12345,
      type: 'image/' + ext,
      status: Dropzone.ADDED,
      url: fileURL
  };
  return mockFile;
}

function loadCropper(file, dz, field) {
  file.previewElement.classList.add("dz-success");
  jQuery('#'+field+'-crop').replaceWith('<img id="'+field+'-crop" src="' + jQuery('#'+field+'-image-upload img').attr("src") + '">');
  fieldImage = document.getElementById(field+'-crop');
  var cropperOptions = cropperDefaults;
  if (field == 'featured') {
    // Lock aspect ratio
    cropperOptions.aspectRatio = 4 / 3;
    // Limit size
    cropperOptions.crop = function(event){
      if(event.detail.width < FEATURE_MIN_WIDTH && limitOff) {
        limitOff = false;
        var curImg = featuredCropper.getCropBoxData();
        featuredCropper.setData({
          width: FEATURE_MIN_WIDTH
        });
      } else {
        limitOff = true;
      }
    };
  } else {
    delete cropperOptions.aspectRatio;
    delete cropperOptions.crop;
  }

  fieldCropper = new Cropper(fieldImage,cropperOptions);

  if (field == 'featured') {
    featuredCropper = fieldCropper;
    featuredExists = true;
  }
  if (field == 'business') {
    businessCropper = fieldCropper;
    businessExists = true;
  }
  jQuery('#'+field+'-crop-button').css({'visbility':'visible','display':'block'});
  jQuery('#'+field+'-remove-image').css('display', 'block');
  jQuery('#'+field+'-remove-image').click(function(){
      dz.removeAllFiles(true);
      switchDZ(field,'show');
      //fieldCropper.destroy();
      if (field == 'featured') {
        featuredCropper.destroy();
        featuredExists = false;
        featuredRemove = true;
      }
      if (field == 'business') {
        businessCropper.destroy();
        businessExists = false;
        businessRemove = true;
      }
      jQuery('#'+field+'-crop-wrap').css({'visibility':'hidden','position':'absolute'});
      jQuery('#'+field+'-crop-button').css({'visbility':'hidden','display':'none'}).html('Crop');
      jQuery('#'+field+'-remove-image').css("display", "none");
      jQuery('#'+field+'-crop').replaceWith('<div id="'+field+'-crop"></div>');
  });
}

jQuery(document).ready(function(){
    if(jQuery("#featured-image-upload").length){
        jQuery('#featured-crop-button').click(function(){
          cropProcess('featured');
        });

        jQuery('#business-crop-button').click(function(){
          cropProcess('business');
        });

        Dropzone.options.featuredImageUpload = {
            paramName: "file",
            maxFilesize: 2, // MB
            acceptedFiles: "image/*",
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: false,
            thumbnailWidth: null,
            thumbnailHeight: null,
            parallelUploads: 1,
            url: "#",
            success: function (file, response) {

            },
            init: function() {
              // Add Button to dropzone
              jQuery("#featured-image-upload .dz-default").append('<a class="jFiler-input-choose-btn blue">Browse Files</a>');

              // Edit Listing: check for existing featured image
              if (jQuery("#placeholder-featured").length) {
                var featuredImageVal = jQuery('#placeholder-featured').attr('src');
                if (featuredImageVal.length) {
                  switchDZ('featured','hide');
                  var mockFile = createMockFile(featuredImageVal);

                  this.emit("addedfile", mockFile);
                  this.emit("thumbnail", mockFile, featuredImageVal);
                  this.files.push(mockFile);

                  loadCropper(mockFile,this,'featured');
                }
              }

              this.on("maxfilesexceeded", function(file) {
                  this.removeAllFiles();
                  this.addFile(file);
              });

              this.on("maxfilesreached", function(){
                switchDZ('featured','hide');
              });

              this.on('thumbnail', function (file) {
                loadCropper(file,this,'featured');
              });
            }
        };
    }

    if(jQuery("#business-image-upload").length){
        Dropzone.options.businessImageUpload = {
            paramName: "file",
            maxFilesize: 2, // MB
            acceptedFiles: "image/*",
            maxFiles: 1,
            addRemoveLinks: true,
            autoProcessQueue: false,
            thumbnailWidth: null,
            thumbnailHeight: null,
            parallelUploads: 1,
            url: "#",
            success: function (file, response) {
            },
            init: function() {
              // Add Button to dropzone
              jQuery("#business-image-upload .dz-default").append('<a class="jFiler-input-choose-btn blue">Browse Files</a>');

              // Edit Listing: check for existing featured image
              if (jQuery("#placeholder-business").length) {
                var businessImageVal = jQuery('#placeholder-business').attr('src');
                if (businessImageVal.length) {
                  switchDZ('business','hide');
                  var mockFile = createMockFile(businessImageVal);

                  this.emit("addedfile", mockFile);
                  this.emit("thumbnail", mockFile, businessImageVal);
                  this.files.push(mockFile);

                  loadCropper(mockFile,this,'business');
                }
              }

              this.on("maxfilesexceeded", function(file) {
                  this.removeAllFiles();
                  this.addFile(file);
              });

              this.on("maxfilesreached", function(){
                switchDZ('business','hide');
              });

              this.on('thumbnail', function (file) {
                loadCropper(file,this,'business');
              });
            }
        };
    }
});
