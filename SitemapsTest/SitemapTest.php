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
        $loc->setLoc("http://spbdealers.ru");
        $loc->setChangefreqHourly();
        $loc->setPriority(1);
        $loc->setLastmod(new \DateTime("now"));
        $sm->getLocations()->add($loc);
        $this->assertEquals(1, count($sm->getLocations()));
        $sm->clear();
    }

    public function testForeachCollection()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);

        for ($i = 0; $i < 10; $i++) {
            $loc = $sm->getLocations()->create();
            $loc->setLoc("http://spbdealers.ru");
            $loc->setChangefreqHourly();
            $loc->setPriority(1);
            $loc->setLastmod(new \DateTime("now"));
            $sm->getLocations()->add($loc);
        }

        $sm->getLocations()->each(function ($loc) {
            $this->assertInstanceOf('Sitemaps\Abstracts\Location', $loc);
        });

        $sm->clear();
    }

}