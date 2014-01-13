<?php

namespace Sitemaps;


class Sitemap extends \Sitemaps\Abstracts\Sitemap
{
    private $id;
    private $storage;
    private $builder;

    private $hasErrors = false;

    private function setId($id)
    {
        $filtered_id = preg_replace("/[^0-9a-zA-Z\_]/u", "", $id);
        if ($filtered_id != $id) {
            $this->hasErrors = true;
            throw new \Exception("`Id` contains invalid chars [^0-9a-zA-Z\\_]");
        }
        $this->id = $filtered_id;
    }

    public function __construct($id)
    {
        $this->setId($id);
    }

    public function getId()
    {
        if (!$this->hasErrors) {
            return $this->getStorage()->getId();
        }
        return false;
    }

    public function setStorage($storage)
    {
        if (!($storage instanceof \Sitemaps\Abstracts\Storage)) {
            $this->hasErrors = true;
            throw new \Exception('Data storage must extends "\Sitemaps\Abstracts\Storage"');
        }
        $storage->setId($this->id);
        $this->storage = $storage;
    }

    /**
     * @return \Sitemaps\Abstracts\Storage
     */
    public function getStorage()
    {
        if (is_null($this->storage)) {
            $this->setStorage(new \Sitemaps\Storage\ArrayStorage\Storage());
        }
        return $this->storage;
    }

    public function setBuilder($builder)
    {
        if (!($builder instanceof \Sitemaps\Abstracts\Builder)) {
            $this->hasErrors = true;
            throw new \Exception('Sitemap builder must extends "\Sitemaps\Abstracts\Builder"');
        }
        $builder->setSitemap($this);
        $this->builder = $builder;
    }

    /**
     * @return \Sitemaps\Abstracts\Builder
     */
    public function getBuilder()
    {
        if (is_null($this->builder)) {
            $this->setBuilder(new \Sitemaps\Builder\XMLWriter\Builder());
        }
        return $this->builder;
    }

    public function addLocation($url, \DateTime $lastmod, $changefreq = "never", $priority = 0.5)
    {
        $loc = $this->getStorage()->createLocation();
        $loc->setLoc($url);
        $loc->setLastmod($lastmod);
        $loc->setChangefreq($changefreq);
        $loc->setPriority($priority);
        return $this->getStorage()->addLocation($loc);
    }

    public function clear()
    {
        if (!$this->hasErrors) {
            $this->getStorage()->clear();
        }
    }
}