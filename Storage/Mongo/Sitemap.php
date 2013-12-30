<?php

namespace Sitemaps\Storage\Mongo;


class Sitemap extends \Sitemaps\Abstracts\Sitemap
{
    private $id;
    private $locations;

    public function __construct($id)
    {
        $this->id = $id;
        $this->locations = new Locations($id);
    }

    public function getId()
    {
        return $this->getId();
    }

    public function getLocations()
    {
        return $this->locations;
    }

    public function clear()
    {
        return $this->getLocations()->clear();
    }
} 