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
$(function() {$(".col2").load('toc.html');});
SyntaxHighlighter.autoloader(
  'plain text txt ini apache dos dosini yaml output lighttpd json conf ../../scripts/shBrushPlain.js',
  'js jscript javascript  ../../scripts/shBrushJScript.js',
  'php                    ../../scripts/shBrushPhp.js',
  'bash shell sh          ../../scripts/shBrushBash.js',
  'sql SQL querystring    ../../scripts/shBrushSql.js',
  'xml xhtml xslt html xhtml ../../scripts/shBrushXml.js',
  'as ActionScript        ../../scripts/shBrushAS3.js',
  'java                   ../../scripts/shBrushJava.js',
  'css                    ../../scripts/shBrushCss.js'
);
SyntaxHighlighter.all();