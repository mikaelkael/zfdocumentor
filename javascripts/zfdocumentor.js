$(".version img").click(function(){
  window.location=$(this).parent().parent().attr('href') + $(this).attr('title') + '/index.html';
  return false;
});
$(".version").click(function(){
  window.location=$(this).attr('href') + 'en/index.html';
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