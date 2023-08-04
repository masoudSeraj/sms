<?php namespace Sunnyr\Sms\Contracts;

use Closure;


interface SendSmsInterface
{
    public function send(array|string $recievers, string $message, ?Closure $callback=null) :array;
}