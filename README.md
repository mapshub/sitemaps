Sitemaps
========

Генеатор файлов sitemap

    public function testBuilderWithArrayStorage()
    {
        $site_id = "example_array_storage";
        $sm = new \Sitemaps\Sitemap($site_id);

        $arrayStorage = new \Sitemaps\Storage\ArrayStorage\Storage();
        $sm->setStorage($arrayStorage);

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
