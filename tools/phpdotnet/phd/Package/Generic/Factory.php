<?php
namespace phpdotnet\phd;
/* $Id: Factory.php 298715 2010-04-28 18:49:33Z bjori $ */

class Package_Generic_Factory extends Format_Factory
{
    /**
     * List of cli format names and their corresponding class.
     *
     * @var array
     */
    private $formats = array(
        'xhtml'         => 'Package_Generic_ChunkedXHTML',
        'bigxhtml'      => 'Package_Generic_BigXHTML',
        'manpage'       => 'Package_Generic_Manpage',
    );

    public function __construct()
    {
        parent::setPackageName('Generic');
        parent::registerOutputFormats($this->formats);
    }
}

/*
* vim600: sw=4 ts=4 syntax=php et
* vim<600: sw=4 ts=4
*/

