<?php

namespace Sitemaps;


class Sitemap extends \Sitemaps\Abstracts\Sitemap
{
    private $id;

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getCollection()
    {
        // TODO: Implement getCollection() method.
    }
} 