<?php

namespace Sitemaps\Abstracts;


abstract class Sitemap
{

    public abstract function setId($id);

    public abstract function getId();

    public abstract function getCollection();

} 