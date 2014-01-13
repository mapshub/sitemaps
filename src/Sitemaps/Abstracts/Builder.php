<?php

namespace Sitemaps\Abstracts;

abstract class Builder
{
    public abstract function build();

    public abstract function setSitemap($sitemap);
}