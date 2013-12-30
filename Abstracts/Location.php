<?php

namespace Sitemaps\Abstracts;


abstract class Location
{

    public abstract function setChangefreq($changefreq);

    public abstract function getChangefreq();

    public abstract function setLastmod($lastmod);

    public abstract function getLastmod();

    public abstract function setLoc($loc);

    public abstract function getLoc();

    public abstract function setPriority($priority);

    public abstract function getPriority();
}