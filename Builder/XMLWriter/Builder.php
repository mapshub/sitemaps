<?php

namespace Sitemaps\Builder\XMLWriter;

class Builder extends \Sitemaps\Abstracts\Builder
{
    const MAX_URL_COUNT = 50000;
    const MAX_FILE_SIZE = 10000;

    private $sitemap;
    private $outputDir;
    private $baseUrl;

    private $hasErrors = false;
    private $numDocs = 0;

    /**
     * @var \XMLWriter(
     */
    private $xwIndex;
    /**
     * @var \XMLWriter(
     */
    private $xwCurrent;

    private $nowDateTimeStr;

    public function __construct()
    {
        $dt = new \DateTime('now');
        $this->nowDateTimeStr = $dt->format(\DateTime::ISO8601);
    }

    private function openDocument($uri, $rootElName)
    {
        $xw = new \XMLWriter();
        $xw->openUri($uri);
        $xw->setIndent(true);
        $xw->startDocument('1.0', 'utf-8');
        $xw->startElement($rootElName);
        $xw->startAttribute("xmlns");
        $xw->text("http://www.sitemaps.org/schemas/sitemap/0.9");
        $xw->endAttribute();
        return $xw;
    }

    private function closeDocument(\XMLWriter $xw)
    {
        $xw->endElement();
        $xw->endDocument();
    }

    private function startDocument()
    {
        $this->numDocs++;
        $id = $this->getSitemap()->getId();
        $indexFile = "{$id}_sitemap_index.xml";
        $currentFile = "{$id}_sitemap_{$this->numDocs}.xml";
        if (is_null($this->xwIndex)) {
            $this->xwIndex = $this->openDocument('file://' . $this->getOutputDir() . "/" . $indexFile, "sitemapindex");
        }
        if (!is_null($this->xwCurrent)) {
            $this->closeDocument($this->xwCurrent);
        }
        $this->xwCurrent = $this->openDocument('file://' . $this->getOutputDir() . "/" . $currentFile, "urlset");

        $this->xwIndex->startElement("sitemap");
        $this->xwIndex->startElement("loc");
        $this->xwIndex->text($this->getBaseUrl() . $currentFile);
        $this->xwIndex->endElement();
        $this->xwIndex->startElement("lastmod");
        $this->xwIndex->text($this->nowDateTimeStr);
        $this->xwIndex->endElement();
        $this->xwIndex->endElement();

        return $this->xwCurrent;
    }

    private function endDocuments()
    {
        if (!is_null($this->xwIndex)) {
            $this->closeDocument($this->xwIndex);
        }
        if (!is_null($this->xwCurrent)) {
            $this->closeDocument($this->xwCurrent);
        }
    }


    public function build()
    {
        if (is_null($this->getOutputDir())) {
            throw new \Exception('Set output dir!');
        }
        if (is_null($this->getBaseUrl())) {
            throw new \Exception('Set base URL!');
        }
        $id = $this->getSitemap()->getId();
        if (empty($id)) {
            throw new \Exception('`ID` is invalid!');
        }

        $counter = 0;
        $fileSizeCurrent = 110;
        $this->startDocument();
        $this->getSitemap()->getStorage()->each(function (\Sitemaps\Abstracts\Location $loc) use (&$counter, &$fileSizeCurrent) {

            if ($counter == self::MAX_URL_COUNT || $fileSizeCurrent >= self::MAX_FILE_SIZE) {
                $this->startDocument();
                $counter = 0;
                $fileSizeCurrent = 110;
            }

            $url = $loc->getLoc();
            $lastmod = $loc->getLastmod()->format(\DateTime::ISO8601);
            $changefreq = $loc->getChangefreq();
            $priority = $loc->getPriority();

            $this->xwCurrent->startElement("url");
            $this->xwCurrent->startElement("loc");
            $this->xwCurrent->text($url);
            $this->xwCurrent->endElement();
            $this->xwCurrent->startElement("lastmod");
            $this->xwCurrent->text($lastmod);
            $this->xwCurrent->endElement();
            $this->xwCurrent->startElement("changefreq");
            $this->xwCurrent->text($changefreq);
            $this->xwCurrent->endElement();
            $this->xwCurrent->startElement("priority");
            $this->xwCurrent->text($priority);
            $this->xwCurrent->endElement();
            $this->xwCurrent->endElement();

            $fileSizeCurrent += 110;
            $fileSizeCurrent += mb_strlen($url, "utf-8");
            $fileSizeCurrent += mb_strlen($lastmod, "utf-8");
            $fileSizeCurrent += mb_strlen($changefreq, "utf-8");
            $fileSizeCurrent += mb_strlen($priority, "utf-8");
            $counter++;
        });
        $this->endDocuments();
    }

    public function setOutputDir($outputDir)
    {
        if (!is_dir($outputDir)) {
            $this->hasErrors = true;
            throw new \Exception("Output dir doesn't exist");
        }
        $this->outputDir = $outputDir;
    }

    public function getOutputDir()
    {
        return $this->outputDir;
    }

    public function setSitemap($sitemap)
    {
        $this->sitemap = $sitemap;
    }

    /**
     * @return \Sitemaps\Sitemap
     */
    public function getSitemap()
    {
        return $this->sitemap;
    }

    public function setBaseUrl($baseUrl)
    {
        $baseUrl = rtrim($baseUrl, "\\/");
        $baseUrl .= "/";
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
} 