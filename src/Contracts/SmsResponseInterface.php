<?php namespace Sunnyr\Sms\Contracts;

interface SmsResponseInterface
{
    public function parse($userId, $message);
}