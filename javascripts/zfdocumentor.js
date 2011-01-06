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
    $(".col2").load('toc.html', function() {
        $(".col2 dl dl dl").toggle();
        $(".col2 dl dl dl a").click(function (event) {
            event.stopPropagation();
        });
        $(".col2 dl dt").click(function () {
            $(this).next().children('dl').toggle();
            return false;
        });
        var url=window.location.pathname;
        if (url.lastIndexOf('/') !=-1) {
            firstpos = url.lastIndexOf('/')+1;
            file = url.substring(firstpos);
            toggled = false;
            $("a[href*="+file+"]").each(function() {
                if ($(this).parent().parent().parent().parent().parent().parent().get(0).tagName == 'DIV') {
                    if (!toggled) {
                        $(this).parent().parent().next().children('dl').toggle();
                        toggled = true
                    }
                    $(this).addClass('active');
                } else {
                    if (!toggled) {
                        $(this).parent().parent().parent().toggle();
                        toggled = true
                    }
                    $(this).parent().parent().parent().parent().prev().children('span').children('a').addClass('active');
                    $(this).addClass('active');
                }
            });
        }
    });
});