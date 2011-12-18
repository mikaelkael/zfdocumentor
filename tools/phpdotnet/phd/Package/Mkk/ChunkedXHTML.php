<?php
namespace phpdotnet\phd;

class Package_Mkk_ChunkedXHTML extends Package_Generic_ChunkedXHTML
{

    private $minorZf = '1.11';
    private $revisionZf = '1.11.11';

    private $myelementmap = array();
    private $replaceElementMap = array(
        'funcparams'        => 'code_funcparams',
        'interface'         => array(
            'span',
            'ooclass'  => array(
                'classsynopsisinfo' => 'format_classsynopsisinfo_ooclass_classname',
            ),
        ),
        'classname'         => 'format_classname',
        'subtitle'          => 'format_note_title',
        'programlisting'    => 'format_programlisting');
    private $mergeElementMap = array(
        'title'                 => array(
            'info'              => array(
                /* DEFAULT */      'h1',
                'section'       => array(
                    /* DEFAULT */      'h2',
                    'section'       => array(
                        /* DEFAULT */      'h3',
                        'section'       => array(
                            /* DEFAULT */      'h4',
                        ),
                    ),
                ),
            ),
        )
    );
    protected $zfOutputDir = null;


    public function __construct()
    {
        parent::__construct();
        $this->zfOutputDir = Config::output_dir();
        $this->registerFormatName("Mkk-Chunked-XHTML");
        $this->myelementmap = array_merge(
            parent::getDefaultElementMap(),
            $this->replaceElementMap
        );
        $this->myelementmap = array_merge_recursive(
            $this->myelementmap,
            $this->mergeElementMap
        );
    }

    public function postConstruct()
    {
        $this->setOutputDir($this->zfOutputDir);
        parent::postConstruct();
    }

    public function getDefaultElementMap()
    {
        return $this->myelementmap;
    }

    public function code_funcparams($open, $name, $attrs, $props)
    {
        if ($open) {
            return '<code class="funcparams">';
        }
        return '</code>';
    }

    public function format_programlisting($open, $name, $attrs)
    {
        if ($open) {
            $tag = '<pre class="programlisting';
            if (isset($attrs[Reader::XMLNS_DOCBOOK]["language"])) {
                $this->role = $attrs[Reader::XMLNS_DOCBOOK]["language"];
                $tag .= ' brush: ' . $this->role;
            } else {
                $this->role = false;
            }

            $tag .= '">';
            return $tag;
        }
        $this->role = false;
        return "</pre>\n";
    }

    public function format_classname($open, $name, $attrs)
    {
        if ($open) {
            return '<code class="classname">';
        }
        return '</code>';
    }

    public function CDATA($str) {
        switch($this->role) {
        case '':
            return '<div class="cdata"><pre>'
                . htmlspecialchars($str, ENT_QUOTES, "UTF-8")
                . '</pre></div>';
        default:
            return trim($str);
        }
    }

    public function getNavData($id)
    {
        $root = Format::getRootIndex();
        $prev = $next = $parent = array("href" => null, "desc" => null);

        if ($parentId = $this->getParent($id)) {
            $parent = array("href" => $this->getFilename($parentId) . $this->getExt(),
                "desc" => $this->getShortDescription($parentId));
        }
        if ($prevId = Format::getPrevious($id)) {
            $prev = array("href" => Format::getFilename($prevId) . $this->getExt(),
                "desc" => $this->getShortDescription($prevId));
        }
        if ($nextId = Format::getNext($id)) {
            $next = array("href" => Format::getFilename($nextId) . $this->getExt(),
                "desc" => $this->getShortDescription($nextId));
        }
        return array(
            'prevId'   => $prevId,
            'prev'     => $prev,
            'nextId'   => $nextId,
            'next'     => $next,
            'parentId' => $parentId,
            'parent'   => $parent,
            'root'     => $root,
        );
    }


    public function header($id)
    {
        $title = $this->getLongDescription($id);
        $nav = $this->getNavData($id);

        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Zend Framework ' . $this->revisionZf . ' - ' . $title . '</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link type="text/css" rel="stylesheet" href="/styles/shCoreMidnight.css"/>
  <link rel="stylesheet" href="/styles/zfdocumentor.css" type="text/css"></link>
  <meta name="generator" content="zfdocumentor - https://github.com/mikaelkael/zfdocumentor" />
  <meta name="author" content="Mickael Perraud" />
</head>
<body>

<div id="header">
  <h1>Zend Framework ' . $this->revisionZf . ' Manual</h1>

  <form action="/search.php" id="searchZf">
    <input type="hidden" name="zf_version" value="' . $this->minorZf . '" />
    <input type="hidden" name="lang" value="{lang}" />
    <input type="text" id="query_search" name="query_search" value="Search..."  onfocus="javascript:if(this.value==\'Search...\') {this.value=\'\'}" onblur="javascript:if(this.value==\'\') {this.value=\'Search...\'}" />
  </form>

  <div id="alternateDoc" style="position: absolute;top: 10px; right:10px;">
    <a href="/docs/Zend_Framework_{shortVersion}.x_{lang}.zip"><img src="/images/zip.png" alt="Downloadable version of this documentation" title="Downloadable version of this documentation" /></a>
    <a style="{alternateDoc}" href="/docs/Zend_Framework_{shortVersion}.x_{LANG}.pdf"><img src="/images/pdf.png" alt="PDF version of this documentation" title="PDF version of this documentation" /></a>
    <a style="{alternateDoc}" href="/docs/Zend_Framework_{shortVersion}.x_{LANG}.chm"><img src="/images/chm.png" alt="CHM version of this documentation" title="CHM version of this documentation" /></a>
  </div>

  <ul class="editions">
' . $this->generateVersion() . '
  </ul>
</div>
<div class="colmask leftmenu">
  <div class="colleft">
    <div class="col1">
      <table border="0" width="100%">
        <tr>
          <td align="left">
          '.($nav['prevId'] ? '<a accesskey="p" href="' .$nav['prev']["href"] . '"><img alt="Previous" src="../../images/prev.png" style="border:0" /></a>' : '') . '
          </td>
          <td align="right">
          '.($nav['nextId'] ? '<a accesskey="n" href="' .$nav['next']["href"] . '"><img alt="Next" src="../../images/next.png" style="border:0" /></a>' : '') . '
          </td>
        </tr>
      </table>';
    }

    public function footer($id)
    {
        $nav = $this->getNavData($id);
        return '<table border="0" width="100%">
        <tr>
          <td align="left">
          '.($nav['prevId'] ? '<a accesskey="p" href="' .$nav['prev']["href"] . '"><img alt="Previous" src="../../images/prev.png" style="border:0" /></a>' : '') . '
          </td>
          <td align="right">
          '.($nav['nextId'] ? '<a accesskey="n" href="' .$nav['next']["href"] . '"><img alt="Next" src="../../images/next.png" style="border:0" /></a>' : '') . '
          </td>
        </tr>
      </table>
    </div>
    <div class="col2">
	' . $this->createNavBar($id) . '
    </div>
  </div>
</div>
<div id="footer">
  <p><a href="appendixes.copyright.html">Copyright</a> &copy; 2005-2010 <a href="http://zend.com/"> Zend Technologies Inc</a> (compiled by <a href="http://mikaelkael.fr">mikaelkael</a> with <a href="https://github.com/mikaelkael/zfdocumentor">ZFDocumentor</a> - SVN {revsvn}).</p>
</div>
<script src="/scripts/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="/scripts/zfdocumentor.js"></script>
<script type="text/javascript" src="/scripts/XRegExp.js"></script>
<script type="text/javascript" src="/scripts/shCore.js"></script>
<script type="text/javascript" src="/scripts/shBrushPlain.js"></script>
<script type="text/javascript" src="/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="/scripts/shBrushPhp.js"></script>
<script type="text/javascript" src="/scripts/shBrushBash.js"></script>
<script type="text/javascript" src="/scripts/shBrushSql.js"></script>
<script type="text/javascript" src="/scripts/shBrushXml.js"></script>
<script type="text/javascript" src="/scripts/shBrushAS3.js"></script>
<script type="text/javascript" src="/scripts/shBrushJava.js"></script>
<script type="text/javascript" src="/scripts/shBrushCss.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-15219015-2\']);
  _gaq.push([\'_trackPageview\']);
  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>';
    }

    public function generateVersion()
    {
        static $bar = null;
        if ($bar == null) {
            $allLang = array('en', 'de', 'fr', 'ja');
            $versions = array('1.11' => array('en', 'de', 'es', 'fr', 'ja', 'pt-br'),
                              '1.10' => array('en', 'de', 'es', 'fr', 'ja', 'pt-br'),
                              '1.9' => array('en', 'de', 'fr', 'ja'),
                              '1.8' => array('en', 'de', 'fr', 'ja'),
                              '1.7' => array('en', 'de', 'fr', 'ja'),
                              '1.6' => array('en', 'de', 'fr', 'ja'),
                              '1.5' => array('en', 'de', 'fr', 'ja'),
                              '1.0' => array('en', 'de', 'fr', 'ja'));
            $bar = '';
            foreach ($versions as $num => $langs) {
                $img = '';
                foreach ($langs as $l) {
                    $img .= sprintf(
                      '<img src="/images/%s.png" title="%s" alt="%s">' . PHP_EOL,
                      $l,
                      $l,
                      $l
                    );
                }
                $bar .= sprintf('<li><a href="/%s/" class="version%s">ZF %s <span>%s</span></a></li>' . PHP_EOL,
                                $num,
                                ($num == $this->minorZf ? ' active' : ''),
                                $num,
                                $img
                                );
            }
        }
        return $bar;
    }

    protected function createNavBar($id)
    {
        static $initialTree = null;

        // Generate initial tree on three levels
        if ($initialTree === null) {
            $firstLevel = $this->getChildren('manual');
            foreach ($firstLevel as $fL) {
                $link = $this->createLink($fL, $desc);
                $initialTree[$fL]['link'] = $link;
                $initialTree[$fL]['desc'] = $desc;
                $initialTree[$fL]['pages'] = array();
                $secondLevel = $this->getChildren($fL);
                if (is_array($secondLevel)) {
                    foreach ($secondLevel as $sL) {
                        $link = $this->createLink($sL, $desc);
                        $initialTree[$fL]['pages'][$sL]['link'] = $link;
                        $initialTree[$fL]['pages'][$sL]['desc'] = $desc;
                        $initialTree[$fL]['pages'][$sL]['pages'] = array();
                        $thirdLevel = $this->getChildren($sL);
                        if (is_array($thirdLevel)) {
                            foreach ($thirdLevel as $tL) {
                                $link = $this->createLink($tL, $desc);
                                $initialTree[$fL]['pages'][$sL]['pages'][$tL]['link'] = $link;
                                $initialTree[$fL]['pages'][$sL]['pages'][$tL]['desc'] = $desc;
                            }
                        }
                    }
                }
            }
        }

        // Fetch ancestors of the current node
        $currentId = $id;
        $ancestors = array($id);
        while (($currentId = $this->getParent($currentId)) && $currentId != "index") {
            $ancestors[] = $currentId;
        }

        // Render the tree
        $navBar = "<dl>\n";
        foreach ($initialTree as $firstId => $firstLevel) {
            $navBar .= "<dt><span class=\"part\"><a href=\"{$firstLevel['link']}\">{$firstLevel['desc']}</a></dt>\n";
            $navBar .= "<dd><dl>\n";
            foreach ($firstLevel['pages'] as $secondId => $secondLevel) {
                if (in_array($secondId, $ancestors)) {
                    $class = 'class="active"';
                    $display = '';
                } else {
                    $class= '';
                    $display = 'style="display: none"';
                }
                $navBar .= "\t<dt><span class=\"chapter\"><a $class href=\"{$secondLevel['link']}\">{$secondLevel['desc']}</a></dt>\n";
                if (count($secondLevel)) {
                    $navBar .= "\t<dd><dl $display>\n";
                    foreach ($secondLevel['pages'] as $thirdId => $thirdLevel) {
                        if (in_array($thirdId, $ancestors)) {
                            $class = 'class="active"';
                        } else {
                            $class = '';
                        }
                        $navBar .= "\t\t<dt><span class=\"sect1\"><a $class href=\"{$thirdLevel['link']}\">{$thirdLevel['desc']}</a></dt>\n";
                    }
                    $navBar .= "\t</dl></dd>\n";
                }
            }
            $navBar .= "</dl></dd>\n";
        }
        $navBar .= "</dl>\n";
        return $navBar;
    }
}
