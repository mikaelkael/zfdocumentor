<?php
namespace phpdotnet\phd;

class Package_Mkk_CHM extends Package_Mkk_ChunkedXHTML
{
    const DEFAULT_FONT = "Arial,10,0";
    const DEFAULT_TITLE = "Zend Framework Manual";

    // Array to manual code -> HTML Help Code conversion
    // Code list: http://www.helpware.net/htmlhelp/hh_info.htm
    // Charset list: http://msdn.microsoft.com/en-us/goglobal/bb896001.aspx
    // Language code: http://www.unicode.org/unicode/onlinedat/languages.html
    // MIME preferred charset list: http://www.iana.org/assignments/character-sets
    // Font list: http://www.microsoft.com/office/ork/xp/three/inte03.htm
    protected $LANGUAGES = array(
        "hk"    => array(
            "langcode" => "0xc04 Hong Kong Cantonese",
            "preferred_charset" => "CP950",
            "mime_charset_name" => "Big5",
            "preferred_font" => "MingLiu,10,0"
        ),
        "tw"    => array(
            "langcode" => "0x404 Traditional Chinese",
            "preferred_charset" => "CP950",
            "mime_charset_name" => "Big5",
            "preferred_font" => "MingLiu,10,0"
        ),
        "cs"    => array(
            "langcode" => "0x405 Czech",
            "preferred_charset" => "Windows-1250",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT,
        ),
        "da"    => array(
            "langcode" => "0x406 Danish",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Zend Framework Manualen"
        ),
        "de"    => array(
            "langcode" => "0x407 German (Germany)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Zend Framework Handbuch",
        ),
        "el"    => array(
            "langcode" => "0x408 Greek",
            "preferred_charset" => "Windows-1253",
            "mime_charset_name" => "Windows-1253",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "en"    => array(
            "langcode" => "0x809 English (United Kingdom)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Zend Framework Manual",
        ),
        "es"    => array(
            "langcode" => "0xc0a Spanish (International Sort)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "fa"    => array(
            "langcode" => "0x429 Persian",
            "preferred_charset" => "Windows-1254",
            "mime_charset_name" => "Windows-1254",
            "preferred_font" => "Sylfaen,10,0",
        ),
        "fr"    => array(
            "langcode" => "0x40c French (France)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Manuel Zend Framework"
        ),
        "fi"    => array(
            "langcode" => "0x40b Finnish",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "he"    => array(
            "langcode" => "0x40d Hebrew",
            "preferred_charset" => "Windows-1255",
            "mime_charset_name" => "Windows-1255",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "hu"    => array(
            "langcode" => "0x40e Hungarian",
            "preferred_charset" => "Windows-1250",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "it"    => array(
            "langcode" => "0x410 Italian (Italy)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Manuale Zend Framework",
        ),
        "ja"    => array(
            "langcode" => "0x411 Japanese",
            "preferred_charset" => "CP932",
            "mime_charset_name" => "csWindows31J",
            "preferred_font" => "MS PGothic,10,0"
        ),
        "kr"    => array(
            "langcode" => "0x412 Korean",
            "preferred_charset" => "CP949",
            "mime_charset_name" => "EUC-KR",
            "preferred_font" => "Gulim,10,0"
        ),
        "nl"    => array(
            "langcode" => "0x413 Dutch (Netherlands)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "no"    => array(
            "langcode" => "0x414 Norwegian (Bokmal)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "pl"    => array(
            "langcode" => "0x415 Polish",
            "preferred_charset" => "Windows-1250",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Podręcznik Zend Framework",
        ),
        "pt_BR" => array(
            "langcode" => "0x416 Portuguese (Brazil)",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT,
            "title" => "Manual do Zend Framework",
        ),
        "ro"    => array(
            "langcode" => "0x418 Romanian",
            "preferred_charset" => "ASCII//TRANSLIT//IGNORE",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "ru"    => array(
            "langcode" => "0x419 Russian",
            "preferred_charset" => "Windows-1251",
            "mime_charset_name" => "Windows-1251",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "sk"    => array(
            "langcode" => "0x41b Slovak",
            "preferred_charset" => "Windows-1250",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "sl"    => array(
            "langcode" => "0x424 Slovenian",
            "preferred_charset" => "Windows-1250",
            "mime_charset_name" => "Windows-1250",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "sv"    => array(
            "langcode" => "0x41d Swedish",
            "preferred_charset" => "Windows-1252",
            "mime_charset_name" => "Windows-1252",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "tr"    => array(
            "langcode" => "0x41f Turkish",
            "preferred_charset" => "Windows-1254",
            "mime_charset_name" => "Windows-1254",
            "preferred_font" => self::DEFAULT_FONT
        ),
        "zh"    => array(
            "langcode" => "0x804 Simplified Chinese",
            "preferred_charset" => "CP936",
            "mime_charset_name" => "gb2312",
            "preferred_font" => "simsun,10,0"
        )
    );

    // HTML Help Workshop project file
    protected $hhpStream;
    // CHM Table of contents
    protected $hhcStream;
    protected $currentTocDepth = 0;
    protected $lastContent = null;
    protected $toc;
    // CHM Index Map
    protected $hhkStream;
    // Project files Output directory
    protected $chmdir;


    public function __construct() {
        parent::__construct();
        $this->zfOutputDir = Config::output_dir() . "res" . DIRECTORY_SEPARATOR;
        $this->registerFormatName("Mkk-CHM");
    }

    public function __destruct() {
        self::footerChm();

        fclose($this->hhpStream);
        fclose($this->hhcStream);
        fclose($this->hhkStream);

        parent::__destruct();
    }

    public function update($event, $val = null) {
        switch($event) {
        case Render::CHUNK:
            parent::update($event, $val);
            break;

        case Render::STANDALONE:
            parent::update($event, $val);
            break;

        case Render::INIT:
            $this->chmdir = Config::output_dir();
            if(!file_exists($this->chmdir) || is_file($this->chmdir)) {
                mkdir($this->chmdir, 0777, true) or die("Can't create the CHM project directory");
            }
            $this->outputdir = Config::output_dir() . "res" . DIRECTORY_SEPARATOR;
            $this->postConstruct();
            if(!file_exists($this->outputdir) || is_file($this->outputdir)) {
                mkdir($this->outputdir, 0777, true) or die("Can't create the cache directory");
            }
            $lang = Config::language();
            $this->hhpStream = fopen($this->chmdir . "zf.hhp", "w");
            $this->hhcStream = fopen($this->chmdir . "zf.hhc", "w");
            $this->hhkStream = fopen($this->chmdir . "zf.hhk", "w");

            $stylesheet = '';
            if (Config::css()) {
                foreach(Config::css() as $cssname) {
                    $stylesheet .= $this->fetchStylesheet($cssname) . PHP_EOL;
                }
            } else {
                $stylesheet = $this->fetchStylesheet() . PHP_EOL;
            }

            self::headerChm();

            // Find referenced content - background images, sprites, etc.
            if (0 !== preg_match_all('`url\((([\'"]|)((?:(?!file:).)*)\2)\)`', $stylesheet, $stylesheet_urls)) {
                foreach(array_unique($stylesheet_urls[3]) as $stylesheet_url) {

                    // Parse the url, getting content from http://www.php.net if there is no scheme and host.
                    if (False !== ($parsed_url = parse_url($stylesheet_url))) {

                        if (!isset($parsed_url['scheme']) && !isset($parsed_url['host'])) {
                            $url_content = file_get_contents('http://www.php.net/' . $stylesheet_url);
                        } else {
                            // Otherwise content is fully identified.
                            $url_content = file_get_contents($stylesheet_url);
                        }

                        // Make sure the location to save the content is available.
                        @mkdir(dirname($content_filename = $this->outputdir . $parsed_url['path']));

                        // Save the referenced content to the new location.
                        file_put_contents($content_filename, $url_content);

                        // Add the content to the hpp file.
                        fwrite($this->hhpStream, 'res' . DIRECTORY_SEPARATOR . ($relative_url = trim(substr(realpath($content_filename), strlen(realpath($this->outputdir))), DIRECTORY_SEPARATOR)) . PHP_EOL);

                        // Force URLS to be relative to the "res" directory, but make them use the unix path separator as they will be processed by HTML.
                        $stylesheet = str_replace($stylesheet_url, str_replace(DIRECTORY_SEPARATOR, '/', $relative_url), $stylesheet);

                        v('Saved content from css : %s.', $parsed_url['path'], VERBOSE_MESSAGES);
                    } else {
                        v('Unable to save content from css : %s.', $stylesheet_url, E_USER_WARNING);
                    }
                }

            }

            // Save the stylesheet.
            file_put_contents($this->outputdir . "style.css", $stylesheet . 'body {padding : 3px;}' . PHP_EOL . '#usernotes {margin-left : inherit;}' . PHP_EOL);
            break;
        case Render::VERBOSE:
            parent::update($event, $val);
            break;
        }
    }

    protected function appendChm($name, $ref, $hasChild) {
        if ($this->flags & Render::OPEN) {
            $charset = $this->LANGUAGES[Config::language()]["preferred_charset"];
            $name = htmlspecialchars(iconv('UTF-8', $charset, html_entity_decode($name, ENT_QUOTES, 'UTF-8')), ENT_QUOTES);

            $this->currentTocDepth++;
            fwrite($this->hhpStream, "{$ref}\n");
            fwrite($this->hhkStream,
                "      <LI><OBJECT type=\"text/sitemap\">\n" .
                "        <param name=\"Local\" value=\"{$ref}\">\n" .
                "        <param name=\"Name\" value=\"" . self::cleanIndexName($name) . "\">\n" .
                "      </OBJECT>\n");
        } elseif ($this->flags & Render::CLOSE) {
            $this->currentTocDepth--;
        }
    }

    /**
    * Clean up the index name.
    * Newlines and double spaces don't look that good in some chm viewer apps.
    *
    * @param string $value Value to fix
    *
    * @return string Fixed/cleaned value
    */
    protected static function cleanIndexName($value)
    {
        return str_replace(
            array("\n", "\r", '  '),
            array('', '', ' '),
            $value
        );
    }


    protected function headerChm() {
        $lang = Config::language();
        fwrite($this->hhpStream, '[OPTIONS]
Binary TOC=Yes
Compatibility=1.1 or later
Compiled file=../../Zend_Framework_' . $this->minorZf . '.x_' . strtoupper($this->lang)  . '.chm
Contents file=zf.hhc
Default Font=' . ($this->LANGUAGES[$lang]["preferred_font"] ? $this->LANGUAGES[$lang]["preferred_font"] : self::DEFAULT_FONT). '
Default topic=res' . DIRECTORY_SEPARATOR . 'manual.html
Default Window=doc
Display compile progress=Yes
Enhanced decompilation=Yes
Full-text search=Yes
Index file=zf.hhk
Language=' . $this->LANGUAGES[$lang]["langcode"] . '
Title=' . (isset($this->LANGUAGES[$lang]["title"]) ? $this->LANGUAGES[$lang]["title"] : self::DEFAULT_TITLE) . '

[WINDOWS]
doc="' . (isset($this->LANGUAGES[$lang]["title"]) ? $this->LANGUAGES[$lang]["title"] : self::DEFAULT_TITLE) . '","zf.hhc","zf.hhk","res/manual.html","res/manual.html",,,,,0x33520,,0x70386e,,,,,,,,0

[FILES]
res/zfdocumentor.css
');
        fwrite($this->hhcStream, '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
  <head>
    <meta name="generator" content="PhD">
    <!-- Sitemap 1.0 -->
  </head>
  <body>
    <object type="text/site properties">
      <param name="Window Styles" value="0x800227">
    </object>
    <ul>
');
        fwrite($this->hhkStream, '<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
  <head>
    <meta name="generator" content="PhD">
    <!-- Sitemap 1.0 -->
  </head>
  <body>
    <object type="text/site properties">
      <param name="Window Styles" value="0x800227">
    </object>
    <ul>
');
    }

    protected function footerChm() {
        fwrite($this->hhcStream, $this->generateHhc());
        fwrite($this->hhcStream, "    </ul>\n" .
            "  </body>\n" .
            "</html>\n");
        fwrite($this->hhkStream, "    </ul>\n" .
            "  </body>\n" .
            "</html>\n");
    }

    public function generateHhc()
    {
        $initialTree = null;
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

        // Render the tree
        $hhc = '';
        foreach ($initialTree as $firstId => $firstLevel) {
            $hhc .= "\t\t<LI><OBJECT type=\"text/sitemap\">\n" .
                    "\t\t\t<param name=\"Name\" value=\"{$firstLevel['desc']}\">\n" .
                    "\t\t\t<param name=\"Local\" value=\"res/{$firstLevel['link']}\">\n" .
                    "\t\t</OBJECT></LI>\n";
            $hhc .= "\t\t<UL>\n";
            foreach ($firstLevel['pages'] as $secondId => $secondLevel) {
                $hhc .= "\t\t\t<LI><OBJECT type=\"text/sitemap\">\n" .
                        "\t\t\t\t<param name=\"Name\" value=\"{$secondLevel['desc']}\">\n" .
                        "\t\t\t\t<param name=\"Local\" value=\"res/{$secondLevel['link']}\">\n" .
                        "\t\t\t</OBJECT></LI>\n";
                if (count($secondLevel)) {
                    $hhc .= "\t\t<UL>\n";
                    foreach ($secondLevel['pages'] as $thirdId => $thirdLevel) {
                        $hhc .= "\t\t\t\t<LI><OBJECT type=\"text/sitemap\">\n" .
                                "\t\t\t\t\t<param name=\"Name\" value=\"{$thirdLevel['desc']}\">\n" .
                                "\t\t\t\t\t<param name=\"Local\" value=\"res/{$thirdLevel['link']}\">\n" .
                                "\t\t\t\t</OBJECT></LI>\n";
                    }
                    $hhc .= "\t\t</UL>\n";
                }
            }
            $hhc .= "\t\t</UL>\n";
        }
        return $hhc;
    }

    public function appendData($data) {
        if ($this->lastContent) {
            $this->appendChm($this->lastContent["name"], $this->lastContent["reference"], $this->lastContent["hasChild"]);
        }
        $this->lastContent = null;
        return parent::appendData($data);
    }

    public function format_chunk($open, $name, $attrs, $props) {
        $this->collectContent($attrs);
        return parent::format_chunk($open, $name, $attrs, $props);
    }

    public function format_container_chunk($open, $name, $attrs, $props) {
        $this->collectContent($attrs);
        return parent::format_container_chunk($open, $name, $attrs, $props);
    }

    public function format_root_chunk($open, $name, $attrs) {
        $this->collectContent($attrs);
        return parent::format_root_chunk($open, $name, $attrs);
    }

    public function format_varlistentry($open, $name, $attrs) {
        if ($open) {
            $this->collectContent($attrs);
            $charset = $this->LANGUAGES[Config::language()]["preferred_charset"];
            $content = htmlspecialchars(iconv('UTF-8', $charset, $this->lastContent["name"]), ENT_QUOTES);

            if ($content) {
                fwrite($this->hhkStream,
                    "      <LI><OBJECT type=\"text/sitemap\">\n" .
                    "        <param name=\"Local\" value=\"{$this->lastContent["reference"]}\">\n" .
                    "        <param name=\"Name\" value=\"{$content}\">\n" .
                    "      </OBJECT>\n");
            }
        }
        return parent::format_varlistentry($open, $name, $attrs);
    }

    private function collectContent($attrs) {
        if (isset($attrs[Reader::XMLNS_XML]["id"])) {
            $id = $attrs[Reader::XMLNS_XML]["id"];
            $this->lastContent = array(
                "name" => Format::getShortDescription($id),
                "reference" => "res" . DIRECTORY_SEPARATOR .
                    (Format::getFilename($id) ? Format::getFilename($id) : $id) . $this->ext,
                "hasChild" => (count(Format::getChildren($id)) > 0)
            );
        }
    }

    protected function fetchStylesheet($name = null) {
        /* Use a local CSS file if it can be found. If not, try and load it from http://www.php.net/styles. If no name is supplied then use the PHP default. */
        $stylesheet = file_get_contents($name = !is_null($name) && realpath($name) ? realpath($name) : "http://www.php.net/styles/" . (is_null($name) ? "site.css" : $name));
        if ($stylesheet) {
            v('Loaded %s stylesheet.', $name, VERBOSE_MESSAGES);
            return $stylesheet;
        } else {
            v('Stylesheet %s not fetched. Uses default rendering style.', $name, E_USER_WARNING);
            return "";
        }
    }

    private function offset($offset) {
        $spaces = "";
        for ($i = 0; $i < $offset + 2 * $this->currentTocDepth; $i++)
            $spaces .= "  ";
        return $spaces;
    }

    public function format_link($open, $name, $attrs, $props) {
        $link = parent::format_link($open, $name, $attrs, $props);
        // Add title attribute to external links so address can be seen in CHM files.
        $search = '`<a href="([^#"][^"]++)" class="link external">`';
        $replacement = '<a href="\1" class="link external" title="Link : \1">';
        $link = preg_replace($search, $replacement, $link);
        return $link;
    }

    public function generateVersion()
    {
        return '';
    }

    protected function createNavBar($id)
    {
        return '';
    }
}
