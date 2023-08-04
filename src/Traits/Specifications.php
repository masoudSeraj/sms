<?php

namespace Sunnyr\Sms\Traits;

trait Specifications
{
    protected $url;
	protected $username;
	protected $password;
	protected $from;
	protected $driver;
    
    public function setConfigDetails(?string $driver = 'default')
    {   
        $driver = config('sunnyrsms.' . $driver ?? $this->driver);
        $this->url = $driver['url'];
        $this->username = $driver['username'];
        $this->password = $driver['password'];
        $this->from = $driver['from'];
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;

    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setDriver($driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function getDriver()
    {
        return $this->driver;
    }
}
