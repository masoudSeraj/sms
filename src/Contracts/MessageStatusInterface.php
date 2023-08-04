<?php namespace Sunnyr\Sms\Contracts;

use Closure;

interface MessageStatusInterface
{
            
    /**
     * Method check
     *
     * @param $code $code [explicite description]
     * @param ?Closure $callback [explicite description]
     *
     * @return array<'status'|'validation', int>
     */
    public function check($code, ?Closure $callback=null);
    public function translateStatus($response);
    public function translateValidation($response);
}