<?php

namespace Sitemaps;


class Location extends \Sitemaps\Abstracts\Location
{

    protected $loc;
    protected $lastmod;
    protected $changefreq;
    protected $priority;

    /**
     * @param mixed $changefreq
     */
    public function setChangefreq($changefreq)
    {
        $this->changefreq = $changefreq;
    }

    /**
     * @return mixed
     */
    public function getChangefreq()
    {
        return $this->changefreq;
    }

    /**
     * @param mixed $lastmod
     */
    public function setLastmod($lastmod)
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @return mixed
     */
    public function getLastmod()
    {
        return $this->lastmod;
    }

    /**
     * @param mixed $loc
     */
    public function setLoc($loc)
    {
        $this->loc = $loc;
    }

    /**
     * @return mixed
     */
    public function getLoc()
    {
        return $this->loc;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }
}