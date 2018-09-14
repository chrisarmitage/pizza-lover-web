<?php

namespace Application\Entity;

class User
{
    protected $mobile;
    protected $password;
    protected $name;
    protected $address;

    /**
     * User constructor.
     * @param $mobile
     * @param $password
     * @param $name
     * @param $address
     */
    public function __construct($mobile, $password, $name, $address)
    {
        $this->mobile = $mobile;
        $this->password = $password;
        $this->name = $name;
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }
}
