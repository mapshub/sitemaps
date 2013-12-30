<?php

namespace Sitemaps\Abstracts;


abstract class Location
{

    protected $loc;

    /**
     * @var \DateTime $lastmod
     */
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
    public function setLastmod(\DateTime $lastmod)
    {
        $this->lastmod = $lastmod;
    }

    /**
     * @return \DateTime|null
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