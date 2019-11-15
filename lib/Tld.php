<?php

namespace DTL\Extension\Fink;

use LayerShifter\TLDExtract\Exceptions\RuntimeException;
use LayerShifter\TLDExtract\Extract;

class Tld
{
    /**
     * @var Tld
     */
    public static $instance;
    private $extract;

    protected function __construct()
    {
        $this->extract = new Extract();
    }

    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function getTld($url)
    {
        try {
            $result = $this->extract->parse($url);
            return $result->getRegistrableDomain();
        } catch (RuntimeException $e) {}

        return false;
    }
}