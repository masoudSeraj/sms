<?php
namespace Sunnyr\Sms\Enums;

enum MessageStatus :int {
    case FINISHED = 1;
    case INTERACTING = 2;
    case NOTAUTHENTICATED = 3;
    case ACTIVE = 4;
    case CANCEL = 5;
    case RECHARGE = 6;
    case APPROVED = 7;
    case NOTCONFIRMED = 8;


    public function translate(): string
    {
        return match($this)
        {
            self::FINISHED            => 'پایان یافته',
            self::INTERACTING       => 'در حال ارتباط',
            self::NOTAUTHENTICATED  => 'عدم احراز هویت',
            self::ACTIVE            => 'فعال',
            self::CANCEL            => 'انصراف',
            self::RECHARGE          => 'شارژ کافی نیست!'
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
