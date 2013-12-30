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
        // TODO: Implement add() method.
    }

    public function count()
    {
        return 0;
    }

    public function create()
    {
        return new Location();
    }

    public function clear()
    {
        return true;
    }
} 