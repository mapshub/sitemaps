<?php

namespace Sitemaps\Storage\Mongo;


class Location extends \Sitemaps\Abstracts\Location
{

    public function setChangefreqAlways()
    {
        $this->setChangefreq("always");
    }

    public function setChangefreqHourly()
    {
        $this->setChangefreq("hourly");
    }

    public function setChangefreqDaily()
    {
        $this->setChangefreq("daily");
    }

    public function setChangefreqWeekly()
    {
        $this->setChangefreq("weekly");
    }

    public function setChangefreqMonthly()
    {
        $this->setChangefreq("monthly");
    }

    public function setChangefreqYearly()
    {
        $this->setChangefreq("yearly");
    }

    public function setChangefreqNever()
    {
        $this->setChangefreq("never");
    }

    public function getArrayCopy()
    {
        return [
            'changefreq' => $this->getChangefreq(),
            'lastmod' => $this->getLastmod()->format(\DateTime::ISO8601),
            'loc' => $this->getLoc(),
            'priority' => $this->getPriority(),
        ];
    }

    public function hydrate($arr)
    {
        $this->setChangefreq($arr['changefreq']);
        $this->setLastmod(\DateTime::createFromFormat(\DateTime::ISO8601, $arr['lastmod']));
        $this->setLoc($arr['loc']);
        $this->setPriority($arr['priority']);
    }
}