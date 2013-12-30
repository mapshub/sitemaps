<?php

namespace Sitemaps\Abstracts;

abstract class Locations implements \Countable
{

    public abstract function __construct($id);

    public abstract function add($loc);

    public abstract function create();

    public abstract function clear();

} 