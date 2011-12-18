<?php
namespace phpdotnet\phd;

class Package_Mkk_Factory extends Format_Factory
{
    /**
     * List of cli format names and their corresponding class.
     *
     * @var array
     */
    private $formats = array(
        'xhtml'         => 'Package_Mkk_ChunkedXHTML',
        'pdf'           => 'Package_Mkk_PDF',
        'chm'           => 'Package_Mkk_CHM',
    );

    public function __construct()
    {
        parent::setPackageName('Mkk');
        parent::registerOutputFormats($this->formats);
    }
}
