<?php

namespace Sitemaps\Storage\Mongo;


class Storage extends \Sitemaps\Abstracts\Storage
{

    const collection_name = "locations";
    private $id = null;
    private static $connection = null;
    private static $db = null;

    private $collection = null;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function getConnection()
    {
        if (is_null(self::$connection)) {
            self::$connection = new \MongoClient();
        }
        return self::$connection;
    }

    /**
     * @return \MongoDB|null
     */
    public function getDb()
    {
        if (is_null(self::$db)) {
            self::$db = $this->getConnection()->selectDB($this->id);
        }
        return self::$db;
    }

    public function getCollection()
    {
        if (is_null($this->collection)) {
            $this->collection = $this->getDb()->selectCollection(self::collection_name);
        }
        return $this->collection;
    }

    /**
     * @param Location $loc
     */
    public function addLocation($loc)
    {
        return $this->getCollection()->insert($loc->getArrayCopy());
    }

    public function clear()
    {
        return $this->getConnection()->dropDB($this->id);
    }

    public function count()
    {
        return $this->getCollection()->count();
    }

    public function each($closure)
    {
        $cursor = $this->getCollection()->find();
        foreach ($cursor as $arr) {
            $loc = new Location();
            $loc->hydrate($arr);
            $closure($loc);
        }
    }
}