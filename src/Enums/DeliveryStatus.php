<?php
namespace Sunnyr\Sms\Enums;

enum DeliveryStatus :int {
    case SENDING = 1;
    case SENT = 2;
    case PENDING = 3;
    case FAILED = 4;
    case BLACKED = 5;
    case DELIVERED = 6;

    public function translate(): string
    {
        return match($this)
        {
            self::SENDING   => 'در حال ارسال',
            self::SENT      => 'ارسال شده',
            self::PENDING   => 'رسیده به مخابرات',
            self::FAILED    => 'عدم ارسال ',
            self::BLACKED   => 'بلک لیست شده',
            self::DELIVERED => 'رسیده به موبایل'
        };
    }
    
    /**
     * Method getStatus
     *
     * @param string $name 
     * 
     * This method is for converting the string received from the sms provider into a value 
     * specified in the list of supported values for this enum.
     *
     * @return string
     */
    public static function getStatus(string $name): string
    {
        foreach (self::cases() as $status) {
            if( $name === $status->name ){
                return $status->value;
            }
        }
        throw new \ValueError("$name is not a valid backing value for enum " . self::class );
    }
}
