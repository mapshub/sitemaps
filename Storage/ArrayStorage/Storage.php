<?php

namespace Sitemaps\Storage\ArrayStorage;


class Storage extends \Sitemaps\Abstracts\Storage
{
    private $arrayStorage = [];
    private $id;

    public function count()
    {
        return count($this->arrayStorage);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function addLocation($loc)
    {
        $this->arrayStorage[] = $loc;
    }

    public function clear()
    {
        $this->arrayStorage = [];
    }

    public function each($closure)
    {
        array_walk($this->arrayStorage, function ($loc) use ($closure) {
            $closure($loc);
        });
    }

    /**
     * @return \Sitemaps\Abstracts\Location
     */
    public function createLocation()
    {
        return new Location();
    }
} 