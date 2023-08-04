<?php

namespace Sunnyr\Sms\Managers;

use Sunnyr\Sms\FarazSms\SendSms;
use Sunnyr\Sms\FarazSms\CheckDelivery;
use Sunnyr\Sms\FarazSms\DriverDetails;
use Sunnyr\Sms\FarazSms\MessageStatus;
use Sunnyr\Sms\FarazSms\ResponseParser;
use Sunnyr\Sms\Contracts\SendSmsInterface;
use Sunnyr\Sms\Contracts\SmsResponseInterface;
use Sunnyr\Sms\Contracts\CheckDeliveryInterface;
use Sunnyr\Sms\Contracts\DriverDetailsInterface;
use Sunnyr\Sms\Contracts\MessageStatusInterface;
use Sunnyr\Sms\Contracts\DeliveryStatusInterface;

class FarazManager extends OperationManager
{
    /**
     * Method send
     *
     * @return SendSmsInterface
     */
    public function operationSend(): SendSmsInterface
    {
        return new SendSms();
    }

    /**
     * Method check
     *
     * @return CheckDeliveryInterface
     */
    public function operationCheck(): CheckDeliveryInterface
    {
        return new CheckDelivery();
    }
    
    /**
     * Method driver
     *
     * @return DriverDetailsInterface
     */
    public function operationDriver(): DriverDetailsInterface
    {
        return new DriverDetails();
    }
    
    /**
     * Method parse
     *
     * @return SmsResponseInterface
     */
    public function operationParse($response) : SmsResponseInterface
    {
        return new ResponseParser($response);
    }

    
    /**
     * Method operationMessageStatus
     *
     * @return MessageStatusInterface
     */
    public function operationMessageStatus() : MessageStatusInterface
    {
        return new MessageStatus();
    }

}
