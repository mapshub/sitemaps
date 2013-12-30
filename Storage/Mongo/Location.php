<?php

namespace Sitemaps\Storage\Mongo;


class Location extends \Sitemaps\Abstracts\Location
{
    public function getId()
    {
        // TODO: Implement getId() method.
    }

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
}