$(function(){
  $('body').on('click', '.box', function() {
      $(".box").colorbox({
        rel:"gal1",
        maxWidth: "95%",
        maxHeight: "95%",
        transition: "none",
        scrolling: false,
        fixed: true,
        title: function() {
          var url = $(this).attr('title');
            return '<a href="' + url + '" target="_blank">View</a>';
        }
      });
  });

  $(".tags-list").colorbox({  transition: "none", width:"80%", height:"80%" });
 });


