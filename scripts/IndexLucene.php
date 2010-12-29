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

class IndexLucene
{
    /**
     * Create Lucene index for HTML format
     * @param string $lang
     */
    public static function makeSearchIndexAction($version = '1.11', $lang = 'en')
    {
        set_include_path(realpath('/mkk01/zfsvn/standard/trunk/library'));
        require_once 'Zend/Search/Lucene.php';
        echo "Building Lucene index for '$lang' manual..." . PHP_EOL;
        chdir(dirname(dirname(__FILE__)));
        self::_removeDir(dirname(dirname(__FILE__)) . '/output/index/' . $version . '/' . $lang);
        self::_createDir(dirname(dirname(__FILE__)) . '/output/index');
        $index = Zend_Search_Lucene::create(dirname(dirname(__FILE__)) . '/output/index/' . $version . '/' . $lang);
        $dir = new DirectoryIterator(dirname(dirname(__FILE__)) . '/output/html/' . $version . '/' . $lang);
        foreach ($dir as $file) {
            if (substr($file->getFileName(), - 5) == '.html') {
                echo ' - indexing: ' . $file->getFileName() . '...' . PHP_EOL;
                $doc = Zend_Search_Lucene_Document_Html::loadHTMLFile($file->getPathName(), true);
                $doc->addField(Zend_Search_Lucene_Field::Text('url', $file->getFileName()));
                $index->addDocument($doc);
            }
        }
        echo ' - optimisation...';
        $index->optimize();
        echo "Index is created and optimized.";
    }
    
    /**
     * Create a dir if not exists
     * @param string $path
     */
    protected static function _createDir($path)
    {
        if (! file_exists($path)) {
            mkdir($path);
        }
    }

    /**
     * Remove a dir and all of his content
     * @param string $path
     */
    protected static function _removeDir($path)
    {
        if (file_exists($path)) {
            $rdi = new RecursiveDirectoryIterator($path);
            $rii = new RecursiveIteratorIterator($rdi, RecursiveIteratorIterator::CHILD_FIRST);
            foreach ($rii as $obj) {
                if (is_dir($obj)) {
                    rmdir($obj);
                }
                if (is_file($obj)) {
                    unlink($obj);
                }
            }
            $rii = $rdi = $obj = null;
            if (file_exists($path)) {
                rmdir($path);
            }
        }
    }

    /**
     * Remove a file if exists
     * @param string $path
     */
    protected static function _removeFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

IndexLucene::makeSearchIndexAction($argv[1], $argv[2]);
