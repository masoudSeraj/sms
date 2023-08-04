<?php namespace Sunnyr\Sms\Contracts;

use Closure;

interface CheckDeliveryInterface
{
    public function check($code, ?Closure $callback=null);
    public function translate($response);
}