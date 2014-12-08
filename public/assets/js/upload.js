$(document).ready(function(){
  Dropzone.autoDiscover = false;
    $("#pikadrop").dropzone({ 
      url: $(this).attr('action'),
      paramName: "img", 
        maxFilesize: 5,
        maxThumbnailFilesize: 2,
        parallelUploads: 10,
        addRemoveLinks: false,
        previewTemplate : "<div class=\"dz-preview dz-file-preview\">\n  <div class=\"dz-details\">\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n    <div class=\"dz-size\" data-dz-size></div>\n    <a href=\"#\" class=\"img-link\"><img data-dz-thumbnail /> </a>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-success-mark\"><span>✔</span></div>\n  <div class=\"dz-error-mark\"><span>✘</span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n</div>",
        acceptedFiles: "image/gif,image/png,image/jpeg",

         success: function(file, response){
          file.previewElement.classList.add("dz-success");
        img_link = file.previewElement.querySelector(".img-link");
        img_link.setAttribute('href', response.link);
          $("#result-list").append("<input class=\"form-control res-link\" type=\"text\" value=\""+ response.link + "\"><br />");
         },
        
  });


  $("#upload-url").click(function(e) {
    e.preventDefault();
    var url = $("#url").val();
    $("#url").val("");
    $("#result-list").empty();
    if(url != "") {
      $.ajax({
          url: $(this).data('url'),
          data: { url: url },
          type: 'GET',
          beforeSend : function() {
            $("#result-list").append("<p> loading...</p>");
          },
          success: function(res) {
            $("#result-list").html("<input class=\"form-control res-link\" type=\"text\" value=\""+ res + "\"><br />");
          }
      });
    }
  });

$(document).on('click','input[type=text]',function(){ this.select(); });

});