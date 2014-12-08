$(function(){
  $(document).on("click", ".image-id", function () {
     $("#store-comment-tags").data('image-id', $(this).attr('id'));
  });

  $('#store-comment-tags').click(function() {
    var data = $('#data-form').serializeArray();
    data.push({ name: "id", value: $(this).data('image-id') });
    $.ajax ({
          type: 'POST',
          data: data ,
          url: $(this).data('url'),
          success: function(rep) {
            document.location.reload();
          }
    });

  });

  $('#tag').selectize({
    valueField: 'id',
    labelField: 'value',
    searchField: ['value'],
    maxOptions: 10,
    options: [],
    create: true,
    option: function(item, escape) {
            return '<option value="' + item.id +  '">' + item.value + '</option>';
          
        },
    load: function(query, callback) {
        if (query.length < 2 ) return callback();
        $.ajax({
            url: $('#tag').data('url'),
            data: { term: query },
            type: 'POST',
            error: function() {
                callback();
            },
            success: function(res) {
                callback(res);
            }
        });
    }

  });

    $('#search-tag').keyup(function() {
      var val = $(this).val();
      if(val.length > 2 || val.length == 0 ) {
        $.ajax({
            url: $(this).data('url'),
            data: { term: $(this).val() },
            type: 'POST',
             beforeSend : function() {
              $("#merdier").html("<p> loading...</p>");
            },
            success: function(res) {
                $("#merdier").html(res);
            }
        });
      }

  });


  $("#trigger-show").click(function(e) {
    e.preventDefault();
    path = window.location.pathname;
    var tag = null; 
    if($('#search-tag').val() != "") {
        tag = $('#search-tag').val();
    }
    else {
      if(path.lastIndexOf('/') != 0) {
      tag = path.substr(path.lastIndexOf('/') + 1);
      }
    } 
    getRandom(tag);
    yann_tv = setInterval(function() { getRandom(tag); }, (tag == "gif") ? 10000 : 5000 );
  });

  function getRandom(tag) {
      $.ajax({
              url: $("#trigger-show").attr('href'),
              data: { tag: tag },
              type: 'GET',
              success: function(res) {
                if(res != "") {
                  $.colorbox({
                    href: res,
                    opacity: 1,
                    transition: "none",
                    maxWidth: "95%",
                    maxHeight: "95%",
                    scrolling: false,
                    fixed: true,
                    onCleanup: function(){
                      clearTimeout(yann_tv);
                    }
                  });
                }
              }
          });
  }
 
 
 });