Sitemaps
========

**Генеатор файлов sitemap**

Для правильной генерации файлов sitemap, как этого требует яндекс:
- с разбивкой на файлы размером не более 10Mb
- количеством url в каждом файле не более 50000

**Принцип работы**

**Примеры**

*Пример с хранением временных данных в массиве PHP*

    public function testBuilderWithArrayStorage()
    {
        //для каждoго сайта свой Id
        $site_id = "com_example_array_storage";
        
        $sm = new \Sitemaps\Sitemap($site_id);
        
        $arrayStorage = new \Sitemaps\Storage\ArrayStorage\Storage();
        $sm->setStorage($arrayStorage);
        
        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");
        $sm->setBuilder($builder);
        
        $total = 2000;
        
        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }
        
        $sm->getBuilder()->build();
    }

Данный тип используется по-умолчанию, поэтому можно явно setStorage не делать.

    public function testBuilderWithArrayStorage()
    {
        //для каждoго сайта свой Id
        $site_id = "com_example_array_storage";
        
        $sm = new \Sitemaps\Sitemap($site_id);
        
        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");
        $sm->setBuilder($builder);
        
        $total = 2000;
        
        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }
        
        $sm->getBuilder()->build();
    }


*Пример с хранением временных данных в MongoDB*

    public function testBuilderWithMongoDBStorage()
    {
        //для каждoго сайта свой Id
        $site_id = "example_mongo_storage";
        
        $sm = new \Sitemaps\Sitemap($site_id);
        
        $mongoStorage = new \Sitemaps\Storage\Mongo\Storage();
        $sm->setStorage($mongoStorage);
        
        $builder = new \Sitemaps\Builder\XMLWriter\Builder();
        $builder->setOutputDir(__DIR__ . "/" . self::test_output_dir);
        $builder->setBaseUrl("http://example.com/sitemap/");
        $sm->setBuilder($builder);
        
        $sm->clear();
        
        $total = 2000;
        
        for ($i = 0; $i < $total; $i++) {
            $sm->addLocation("http://example.com/catalog/pages/{$i}/", new \DateTime("now"));
        }
        
        $sm->getBuilder()->build();
        
        $sm->clear();
    }
