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
        $loc->setLoc("http://example.com");
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
            $loc->setLoc("http://example.com");
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

    public function testBuilderWithDefaultStorage()
    {
        $site_id = "example_default_storage";
        $sm = new \Sitemaps\Sitemap($site_id);
        $sm->clear();

        $total = 2000;

        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }

        $this->assertEquals($total, $sm->getStorage()->count());

        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");

        $sm->setBuilder($builder);
        $sm->getBuilder()->build();

        $sm->clear();
    }

    public function testBuilderWithArrayStorage()
    {
        $site_id = "example_array_storage";
        $sm = new \Sitemaps\Sitemap($site_id);

        $arrayStorage = new \Sitemaps\Storage\ArrayStorage\Storage();
        $sm->setStorage($arrayStorage);

        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");

        $sm->clear();

        $total = 2000;

        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }

        $this->assertEquals($total, $sm->getStorage()->count());

        $sm->setBuilder($builder);
        $sm->getBuilder()->build();

        $sm->clear();
    }

    public function testBuilderWithMongoDBStorage()
    {
        $site_id = "example_mongo_storage";
        $sm = new \Sitemaps\Sitemap($site_id);

        $mongoStorage = new \Sitemaps\Storage\Mongo\Storage();
        $sm->setStorage($mongoStorage);

        $sm->clear();

        $total = 2000;

        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }

        $this->assertEquals($total, $sm->getStorage()->count());

        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");

        $sm->setBuilder($builder);
        $sm->getBuilder()->build();

        $sm->clear();
    }
}