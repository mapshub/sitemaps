<?php

namespace Sitemaps\Storage\Mongo;

class Locations extends \Sitemaps\Abstracts\Locations
{
    private $storage;

    public function __construct($id)
    {
        $this->storage = new Storage($id);
    }

    public function add($loc)
    {
        return $this->storage->addLocation($loc);
    }

    public function count()
    {
        return $this->storage->count();
    }

    public function create()
    {
        return new Location();
    }

    public function clear()
    {
        return $this->storage->clear();
    }

    public function each($closure)
    {
        $this->storage->each($closure);
    }
}