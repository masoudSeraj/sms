<?php namespace Sunnyr\Sms\Managers;

use Sunnyr\Sms\Contracts\SendSmsInterface;
use Sunnyr\Sms\Contracts\CheckDeliveryInterface;
use Sunnyr\Sms\Contracts\DriverDetailsInterface;
use Sunnyr\Sms\Contracts\MessageStatusInterface;
use Sunnyr\Sms\Contracts\SmsResponseInterface;

abstract class OperationManager
{
    abstract public function operationSend() :SendSmsInterface;
    abstract public function operationCheck() :CheckDeliveryInterface;
    abstract public function operationDriver() :DriverDetailsInterface;
    abstract public function operationParse($response) :SmsResponseInterface;
    abstract public function operationMessageStatus() :MessageStatusInterface;
}