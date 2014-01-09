<?php

namespace Sitemaps\SitemapsTest;


class SitemapTest extends \PHPUnit_Framework_TestCase
{
    const test_output_dir = "OutputTestData";

    public function testInstance()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $this->assertInstanceOf('Sitemaps\Sitemap', $sm);
        $this->assertEquals($site_id, $sm->getId());
        $sm->clear();
    }

    public function testLocations()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $loc = $sm->getStorage()->createLocation();
        $this->assertInstanceOf('Sitemaps\Abstracts\Location', $loc);
        $sm->clear();
    }

    public function testLocationsCount()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $loc = $sm->getStorage()->createLocation();
        $loc->setLoc("http://spbdealers.ru");
        $loc->setChangefreqHourly();
        $loc->setPriority(1);
        $loc->setLastmod(new \DateTime("now"));
        $sm->getStorage()->addLocation($loc);
        $this->assertEquals(1, count($sm->getStorage()));
        $sm->clear();
    }

    public function testForeachCollection()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);

        for ($i = 0; $i < 10; $i++) {
            $loc = $sm->getStorage()->createLocation();
            $loc->setLoc("http://spbdealers.ru");
            $loc->setChangefreqHourly();
            $loc->setPriority(1);
            $loc->setLastmod(new \DateTime("now"));
            $sm->getStorage()->addLocation($loc);
        }

        $counter = 0;
        $sm->getStorage()->each(function ($loc) use (&$counter) {
            $this->assertInstanceOf('Sitemaps\Abstracts\Location', $loc);
            $counter++;
        });

        $this->assertEquals(10, $counter);
        $sm->clear();
    }

    public function testBuilder()
    {
        $site_id = "sitetest";
        $sm = new \Sitemaps\Sitemap($site_id);
        $sm->clear();

        $total = 120000;

        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://spbdealers.ru/page/{$i}/116722000-Renault_Logan_1.4_%2875_%D0%BB.%D1%81.%29_MT", new \DateTime("now"));
        }

        $this->assertEquals($total, $sm->getStorage()->count());

        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://spbdealers.ru/sitemap/");

        $sm->setBuilder($builder);
        $sm->getBuilder()->build();

        $sm->clear();
    }
}