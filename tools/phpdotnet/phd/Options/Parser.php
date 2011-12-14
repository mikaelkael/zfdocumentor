<?php
namespace phpdotnet\phd;
/* $Id: Parser.php 309879 2011-04-01 16:00:11Z rquadling $ */

class Options_Parser
{

    private $defaultHandler;
    private $packageHandlers = array();

    private function __construct() {
        $this->defaultHandler = new Options_Handler();
        $this->packageHandlers = $this->loadPackageHandlers();
    }

    public static function instance() {
        static $instance = null;
        if ($instance == null) {
            $instance = new self();
        }
        return $instance;
    }

    private function loadPackageHandlers() {
        $packageList = Config::getSupportedPackages();
        $list = array();
        foreach ($packageList as $package) {
            if ($handler = Format_Factory::createFactory($package)->getOptionsHandler()) {
                $list[strtolower($package)] = $handler;
            }
        }
        return $list;
    }

    public function handlerForOption($option) {
        if (method_exists($this->defaultHandler, "option_{$option}")) {
            return array($this->defaultHandler, "option_{$option}");
        }

        $opt = explode('-', $option);
        $package = strtolower($opt[0]);

        if (isset($this->packageHandlers[$package])) {
            if (method_exists($this->packageHandlers[$package], "option_{$opt[1]}")) {
                return array($this->packageHandlers[$package], "option_{$opt[1]}");
            }
        }
        return NULL;
    }

    public function getLongOptions() {
        $defaultOptions = array_keys($this->defaultHandler->optionList());
        $packageOptions = array();
        foreach ($this->packageHandlers as $package => $handler) {
            foreach ($handler->optionList() as $opt) {
                $packageOptions[] = $package . '-' . $opt;
            }
        }
        return array_merge($defaultOptions, $packageOptions);
    }

    public function getShortOptions() {
        return implode('', array_values($this->defaultHandler->optionList()));
    }

    public static function getopt() {
        $self = self::instance();

        $args = getopt($self->getShortOptions(), $self->getLongOptions());
        if ($args === false) {
            trigger_error("Something happend with getopt(), please report a bug", E_USER_ERROR);
        }

        foreach ($args as $k => $v) {
            $handler = $self->handlerForOption($k);
            if (is_callable($handler)) {
                call_user_func($handler, $k, $v);
            } else {
                var_dump($k, $v);
                trigger_error("Hmh, something weird has happend, I don't know this option", E_USER_ERROR);
            }
        }
    }

}

/*
* vim600: sw=4 ts=4 syntax=php et
* vim<600: sw=4 ts=4
*/

