<?php

namespace Sitemaps\SitemapsTest;


class SitemapTest extends \PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $this->assertInstanceOf('Sitemaps\Sitemap', $sm);
        $sm->clear();
    }

    public function testLocations()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $loc = $sm->getLocations()->create();
        $this->assertInstanceOf('Sitemaps\Abstracts\Location', $loc);
        $sm->clear();
    }

    public function testLocationsCount()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $loc = $sm->getLocations()->create();
        $sm->getLocations()->add($loc);
        $this->assertEquals(1, count($sm->getLocations()));
        $sm->clear();
    }
}