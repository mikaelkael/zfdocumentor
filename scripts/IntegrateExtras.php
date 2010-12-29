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

class IntegrateExtras
{

    private static $_lang = 'en';
    private static $_version = '1.11';
    private static $_file;

    public static function main($lang, $version)
    {
        if (preg_match('/[0-9]{1}\.[0-9]{1,2}/i', $version)) {
            self::$_version = $version;
        } else {
            die("Version '$version' doesn't valid");
        }
        if (preg_match('/[a-z]{2}/i', $lang) || $lang == 'pt-br') {
            self::$_lang = strtolower($lang);
            $fileName = realpath(dirname(dirname(__FILE__)) . '/temp/files/manual.xml');
            if (!file_exists($fileName)) {
                die("Manual file doesn't exist");
            }
            self::$_file = file_get_contents($fileName);
            self::_makeIntegration();
            file_put_contents($fileName, self::$_file);
        } else {
            die("Language '$lang' doesn't valid");
        }
        echo "  Integration Extras OK\n";
    }

    private static function _makeIntegration()
    {
        $extrasPath = dirname(dirname(dirname(__FILE__))) . '/extras/';
        $extrasManualFile = realpath($extrasPath . 'branches/release-' . self::$_version . '/documentation/manual/' . self::$_lang . '/manual.xml.in');
        $extrasLang = self::$_lang;
        if (!$extrasManualFile) {
            $extrasManualFile = realpath($extrasPath . 'branches/release-' . self::$_version . '/documentation/manual/en/manual.xml.in');
            $extrasLang = 'en';
            if (!$extrasManualFile) {
                die("Impossible to find extras manual");
            }
        }
        $extrasManual = file_get_contents($extrasManualFile);
        $files = glob(dirname($extrasManualFile) . '/module_specs/*.xml');
        foreach ($files as $f) {
            copy($f, realpath(dirname(dirname(__FILE__)) . '/temp/files/module_specs') . '/' . basename($f));
        }
        preg_match('/<chapter.*<\/chapter>/s', $extrasManual, $chapters);
        self::$_file = preg_replace('/<chapter id="zendx.*<\/chapter>/s', '', self::$_file);
        self::$_file = preg_replace('#</part>\s*<xi:include href="ref/requirements.xml"#m', $chapters[0] . "$0", self::$_file);
    }
}

IntegrateExtras::main($argv[1], $argv[2]);
