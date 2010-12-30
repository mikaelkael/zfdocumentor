<?php

/**
 * ZFDocumentor
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to perraud.mickael@orange.fr so we can send you a copy immediately.
 *
 * @category  Documentation
 * @author    Mickael Perraud <mikaelkael@php.net>
 * @copyright Copyright (c) 2010-2011 Mickael Perraud <perraud.mickael@orange.fr>
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */

set_include_path(get_include_path() . PATH_SEPARATOR . dirname(__FILE__) . '/pear');
require_once 'Text/LanguageDetect.php';

class HTML_Filter extends FilterIterator
{

    public function accept()
    {
        return (substr($this->current(), -5) == '.html');
    }
}

class HighlightHTML
{

    private static $_type = 'html';
    private static $_lang = 'en';
    private static $_version = '1.11';
    private static $_versionBar = null;

    public static function main($type, $version, $lang)
    {
        if (preg_match('/[0-9]{1}\.[0-9]{1,2}/i', $version)) {
            self::$_version = $version;
        } else {
            die("Version '$version' doesn't valid");
        }
        if (in_array($type, array('html', 'htmlhelp'))) {
            self::$_type = $type;
            if (!file_exists(dirname(dirname(__FILE__)) . '/output/' . $type)) {
                die("Type '$type' doesn't exist (1)");
            }
        } else {
            die("Type '$type' doesn't valid (2)");
        }
        if (preg_match('/^([a-z]{2}(\-[a-z]{2})?)$/i', $lang, $matches)) {
            self::$_lang = strtolower($lang);
            if (!file_exists(dirname(dirname(__FILE__)) . '/output/' . $type . '/' . $version . '/' . $lang)) {
                die("Language '$lang' doesn't exist (1)");
            }
        } else {
            die("Language '$lang' doesn't valid (2)");
        }
        self::generateToc();
        self::$_versionBar = self::generateVersion();
        self::highlightAllFile();
        /*self::insertImageLink();
        if (substr($lang, 0, 8) == 'htmlhelp') {
            self::removeTocFirstNode();
            self::changeChmTitle();
        }*/
    }
    
    public static function generateToc()
    {
        $directory = dirname(dirname(__FILE__)) . '/output/' . self::$_type . '/' . self::$_version . '/' . self::$_lang;
        $rawToc = file_get_contents($directory . '/index.html');
        if (function_exists('tidy_repair_string')) {
            $rawToc = tidy_repair_string(
              $rawToc,
              array(
                'indent'       => TRUE,
                'output-xhtml' => TRUE,
                'wrap'         => 0
              ),
              'utf8'
            );
        }
        $rawToc = self::_getSubstring($rawToc, '<dl>', '</dl>', true, true, true);
        $rawToc = file_get_contents($directory . '/toc.html');
        $matches = array();
        preg_match_all('$(<span class="(.*?)"><a href="(.*?)">)(.*?</a>)</span>$sm', $rawToc, $matches);
        $l = new Text_LanguageDetect();
        $mapping = array('english' => 'en', 'german' => 'de', 'french' => 'fr', 'japanese' => 'ja', 'spanish' => 'es', 'portuguese' => 'pt-br');
        for ($i = 0 ; $i < count($matches[0]) ; $i++) {
            if (in_array($matches[2][$i], array('sect1', 'sect2'))) {
                $flag = 'en';
                if (self::$_lang != 'en') {
                    // Analyse file
                    $file = explode('#', $matches[3][$i]);
                    $text = file_get_contents($directory . '/' . $file[0]);
                    $para = '';
                    preg_match_all('#<p>(.*?)</p>#sm', $text, $para);
                    $para = substr(implode(' ', array_map('strip_tags', $para[1])), 0, 9000);
                    $result = $l->detect($para, 4);
                    if (PEAR::isError($result)) {                        
                        echo 'Language detection ' . $file[0] . ': ' . $result->getMessage() . "\n";
                    } else {
                        $result = array_keys($result);
                        if (array_key_exists($result[0], $mapping)) {
                            $flag = $mapping[$result[0]];
                        }
                    }
                }
                if ($flag != self::$_lang) {
                    $flag = 'en';
                }
                // Add flag
                $rawToc = str_replace($matches[0][$i], $matches[1][$i] . '<img src="/images/' . $flag . '.png"/>' . $matches[4][$i], $rawToc);
            }
        }
        file_put_contents($directory . '/toc.html', $rawToc);
    }
    
    public static function generateVersion()
    {
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
                  '<img src="../../images/%s.png" title="%s" alt="%s">' . PHP_EOL,
                  $l,
                  $l,
                  $l
                );
            }
	    $bar .= sprintf(
		'<li><a href="../../%s/" class="version%s">ZF %s <span>%s</span></a></li>' . PHP_EOL,
		$num,
		($num == self::$_version ? ' active' : ''),
		$num,
		$img
	    );
        }
        return $bar;
    }

    private static function _getSubstring($text, $start, $end, $includeStart = true, $includeEnd = true, $strrpos = false)
    {
        if ($includeStart) {
            $prefix = 0;
        } else {
            $prefix = strlen($start);
        }

        if ($includeEnd) {
            $suffix = strlen($end);
        } else {
            $suffix = 0;
        }

        $start = strpos($text, $start);

        if ($strrpos) {
            $_end = strrpos($text, $end);
        } else {
            $_end = strpos($text, $end, $start);
        }

        if ($start !== FALSE) {
            return substr(
              $text,
              $start + $prefix,
              $_end - ($start + $prefix) + $suffix
            );
        } else {
            return '';
        }
    }

    public static function highlightAllFile()
    {
        $dir = new DirectoryIterator(dirname(dirname(__FILE__)) . '/output/' . self::$_type . '/' . self::$_version . '/' . self::$_lang);
        $filter = new HTML_Filter($dir);
        $template = file_get_contents(dirname(dirname(__FILE__)) . '/page.html.in');
        $svnRevision = trim(file_get_contents(dirname(dirname(__FILE__)) . '/temp/svn_rev'));
        foreach ($filter as $file) {
            $title   = '';
            $content = '';
            $prev    = '';
            $next    = '';

            if ($file->getFileName() == 'toc.html') {
                continue;
            }

            $text = file_get_contents($file->getPathName());
            $text = str_replace('class="programlisting"', 'class="programlisting brush: php"', $text);
            $title   = 'Zend Framework ' . self::_getZfVersion() . ' - ' . self::_getSubstring($text, '<title>', '</title>', false, false);

            $content = self::_getSubstring($text, '<div class="part"', '<div class="navfooter">', true, false);
            if (!$content) {
                $content = self::_getSubstring($text, '<div class="chapter"', '<div class="navfooter">', true, false);
            }
            if (!$content) {
                $content = self::_getSubstring($text, '<div class="appendix"', '<div class="navfooter">', true, false);
            }
            if (!$content) {
                $content = self::_getSubstring($text, '<div class="preface"', '<div class="navfooter">', true, false);
            }
            if (!$content) {
                $content = self::_getSubstring($text, '<div class="sect1"', '<div class="navfooter">', true, false);
            }

            $prev    = self::_getSubstring($text, '<link rel="prev" href="', '" title', false, false);
            $next    = self::_getSubstring($text, '<link rel="next" href="', '" title', false, false);
            if (!empty($prev)) {
                $prev = '<a accesskey="p" href="' . $prev . '"><img alt="Previous" src="../../images/prev.png" style="border:0" /></a>';
            }
            if (!empty($next)) {
                $next = '<a accesskey="n" href="' . $next . '"><img alt="Next" src="../../images/next.png" style="border:0" /></a>';
            }

            $zfVersion = implode('.', array_slice(explode('.', Zend_Version::VERSION), 0, 2));;
            $text =  str_replace(
              array('{title}', '{content}', '{editions}', '{prev}', '{next}', '{version}', '{revsvn}', '{lang}', '{shortVersion}'),
              array($title, $content, self::$_versionBar, $prev, $next, self::_getZfVersion(), $svnRevision, self::$_lang, $zfVersion),
              $template
            );

            if (function_exists('tidy_repair_string')) {
                $text = tidy_repair_string(
                  $text,
                  array(
                    'indent'       => TRUE,
                    'output-xhtml' => TRUE,
                    'wrap'         => 0
                  ),
                  'utf8'
                );
            }
            file_put_contents($file->getPathName(), $text);
        }
    }

    public static function removeTocFirstNode()
    {
        $file_name = './output/' . self::$_lang . '/toc.hhc';
        $index = file_get_contents($file_name);
        $index = preg_replace('/(<body>.*?)(<ul>.*?)(<ul>)/ims', "$1$3", $index);
        $index = preg_replace('/(<\/ul>(?:\r\n|\n))(<\/ul>(?:\r\n|\n)<\/body>)/im', '$2', $index);
        file_put_contents($file_name, $index);
    }

    private static function _getZfVersion()
    {
        $fileName = dirname(dirname(dirname(__FILE__))) . '/standard/branches/release-' . self::$_version . '/library/Zend/Version.php';
        if (file_exists($fileName) && is_readable($fileName)) {
            require_once $fileName;
            return Zend_Version::VERSION;
        }
    }

    public static function changeChmTitle()
    {
        $file_name = './output/' . self::$_lang . '/htmlhelp.hhp';
        $index = file_get_contents($file_name);
        preg_match('/Title=(.*)/', $index, $matches);
        $zf = self::_getZfVersion();
        $filtered = strtr(
                $matches[1], 
                'àáâãäåçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 
                'aaaaaaceeeeiiiinooooouuuuyyAAAAAACEEEEIIIINOOOOOUUUUY');
        $index = str_replace('Title=' . $matches[1], 'Title=ZF ' . $zf . '.x - ' . $filtered, $index);
        $index = str_replace('Main="' . $matches[1], 'Main="ZF ' . $zf . '.x - ' . $filtered, $index);
        file_put_contents($file_name, $index);
    }

    private static function _highlight($text)
    {
        $code = $text[2];
        // Replace element create by html compilation
        $code = str_replace(array('&gt;' , '&lt;'), array('>' , '<'), $code);
        // Highlight with tag < ?php since they are not present
        $code = highlight_string('<?php ' . $code, true);
        // After highlight remove equivalent to < ?php but just the first one
        $code = preg_replace(
                "`\<span style\=\"color\: \#0000BB\"\>\&lt\;\?php\&nbsp\;<br />`",
                '<span style="color: #0000BB">',
                $code,
                1);
        // Since we are in a tag <code> all \n will create a new line,
        // but we already have some <br/>:
        $code = str_replace("\n", '', $code);
        // In English manual, there is spaces between ]]> and </programlisting>,
        // we remode it:
        $code = preg_replace(
                '/(<br \/>)(\&nbsp\;)*(<\/span><\/code>)/',
                '$3',
                $code);
        $code = preg_replace('/(<br \/>)(\&nbsp\;)*(<\/span><\/span><\/code>)/', '$3', $code);
        return $text[1] . $code . $text[3];
    }
}

HighlightHTML::main($argv[1], $argv[2], $argv[3]);