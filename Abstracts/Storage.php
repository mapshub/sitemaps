<?php

namespace Sitemaps\Abstracts;

abstract class Storage implements \Countable
{

    public abstract function setId($id);

    public abstract function getId();

    public abstract function addLocation($loc);

    public abstract function clear();

    public abstract function each($closure);

    /**
     * @return \Sitemaps\Abstracts\Location
     */
    public abstract function createLocation();
}