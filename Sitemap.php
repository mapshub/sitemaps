<?php

namespace Sitemaps;


class Sitemap extends \Sitemaps\Abstracts\Sitemap
{
    private $driver;

    public function __construct($id)
    {
        $this->driver = new \Sitemaps\Storage\Mongo\Sitemap($id);
    }

    public function getId()
    {
        return $this->driver->getId();
    }

    public function getLocations()
    {
        return $this->driver->getLocations();
    }

    public function clear()
    {
        return $this->driver->clear();
    }
}