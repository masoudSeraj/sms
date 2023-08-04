<?php

namespace Sunnyr\Sms\FarazSms;

use Sunnyr\Sms\Contracts\DriverDetailsInterface;
use Sunnyr\Sms\Traits\Specifications;

class DriverDetails implements DriverDetailsInterface
{
	use Specifications;

    public function getDriver()
    {
        return $this->driver;
    }

}
