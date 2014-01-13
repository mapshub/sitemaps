<?php

namespace Sitemaps\Abstracts;


abstract class Sitemap
{
    public abstract function __construct($id);

    public abstract function getId();

    public abstract function setStorage($storage);

    public abstract function getStorage();

    public abstract function setBuilder($builder);

    public abstract function getBuilder();

    public abstract function addLocation($url, \DateTime $lastmod, $changefreq = "never", $priority = 0.5);

    public abstract function clear();

} 