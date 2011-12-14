$(".version img").click(function(){
  var url=window.location.pathname;
  url = url.substring(url.lastIndexOf('/')+1);
  window.location=$(this).parent().parent().attr('href') + $(this).attr('title') + '/' + url;
  return false;
});
$(".version").click(function(){
  var url=window.location.pathname;
  url = url.substring(url.lastIndexOf('/')+1);
  window.location=$(this).attr('href') + 'en/' + url;
  return false;
});
$(function() {
    $(".col2 dl dl dl a").click(function (event) {
        event.stopPropagation();
    });
    $(".col2 dl dt").click(function () {
        if ($(this).next().children('dl').is(":visible") == true) {
            return true;
        }
        $(this).next().children('dl').toggle();
        return false;
    });
});
