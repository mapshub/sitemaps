<?php

namespace Sitemaps\Abstracts;


abstract class Sitemap
{
    public abstract function __construct($id);

    public abstract function getId();

    public abstract function getLocations();

    public abstract function clear();

} 