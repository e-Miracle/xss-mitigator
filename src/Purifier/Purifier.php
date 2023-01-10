<?php
namespace CssFuto\ProjectXssMitigator\Purifier;

use HTMLPurifier;
use HTMLPurifier_Config;

class Purifier
{
    /**
     * @var HTMLPurifier
     */
    private $purifier;

    public function __construct()
    {
        $this->purifier = new HTMLPurifier(HTMLPurifier_Config::createDefault());
    }

    public function purify($html_content): string
    {
        return $this->purifier->purify($html_content);
    }
}