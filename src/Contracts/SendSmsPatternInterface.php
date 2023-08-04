<?php namespace Sunnyr\Sms\Contracts;


interface SendSmsPatternInterface
{
    public function send(array $receivers, string $code);
}