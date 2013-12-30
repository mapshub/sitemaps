<?php

namespace Sitemaps\Abstracts;

abstract class Storage
{

    public abstract function addLocation($loc);

    public abstract function clear();

    public abstract function each($closure);
} 