<?php

namespace Sitemaps\Storage\Mongo;


class Storage extends \Sitemaps\Abstracts\Storage
{

    private $id = null;
    private $connection = null;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function addLocation()
    {
        // TODO: Implement addLocation() method.
    }

    public function getCount()
    {
        // TODO: Implement getCount() method.
    }
} 