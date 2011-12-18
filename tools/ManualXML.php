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
 * @copyright   Copyright (c) 2010-2011 Mickael Perraud <perraud.mickael@orange.fr>
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

class ManualXML
{

    private static $_file;

    public static function main($version)
    {
        if (file_exists(dirname(dirname(__FILE__)) . '/temp/manual.xml') && is_writable(dirname(dirname(__FILE__)) . '/temp/manual.xml')) {
            self::$_file = file_get_contents(dirname(dirname(__FILE__)) . '/temp/manual.xml');
            self::_insertZfVersion($version);
            self::_insertPublisher();
            self::_insertSvnRevision();
            self::_removeIndexLink();
            file_put_contents(dirname(dirname(__FILE__)) . '/temp/manual.xml', self::$_file);
        }
    }

    private static function _insertPublisher()
    {
        $fileName = dirname(dirname(__FILE__)) . '/temp/svn_rev';
        if (file_exists($fileName) && is_readable($fileName)) {
            $svn_rev = trim(file_get_contents($fileName));
            $link = "by <ulink url=\"http://www.mikaelkael.fr/zf-chm-pdf\">mikaelkael</ulink>";
            self::$_file = str_replace('</pubdate>', " $link</pubdate>", self::$_file);
        } else {
            echo "  Impossible to read svn revision\n";
        }
    }

    private static function _insertSvnRevision()
    {
        $fileName = dirname(dirname(__FILE__)) . '/temp/svn_rev';
        if (file_exists($fileName) && is_readable($fileName)) {
            $svn_rev = trim(file_get_contents($fileName));
            $link = "<ulink url=\"http://framework.zend.com/code/browse/Zend_Framework/standard/trunk/\">SVN $svn_rev</ulink>";
            self::$_file = str_replace('</pubdate>', " ($link)</pubdate>", self::$_file);
            echo "  SVN: $svn_rev\n";
        } else {
            echo "  Impossible to read svn revision\n";
        }
    }

    private static function _insertZfVersion($version)
    {
        $fileName = dirname(dirname(dirname(__FILE__))) . '/standard/branches/release-' . $version . '/library/Zend/Version.php';
        if (file_exists($fileName) && is_readable($fileName)) {
            require_once $fileName;
            $version = Zend_Version::VERSION;
            self::$_file = str_replace('</subtitle>', " $version</subtitle>", self::$_file);
            echo "  ZF version: $version\n";
        } else {
            echo "  Impossible to read ZF version\n";
        }
    }
    
    private static function _removeIndexLink()
    {
        self::$_file = str_replace('<index id="the.index"/>', '', self::$_file);
    }
}

ManualXML::main($argv[1]);