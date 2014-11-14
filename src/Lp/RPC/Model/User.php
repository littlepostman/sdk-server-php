<?php

namespace Lp\RPC\Model;


class User
{

    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $isAccountAdmin;


    /**
     * @param int    $id
     * @param string $email
     * @param string $password
     * @param string $name
     * @param bool   $isAccountAdmin
     */
    public function __construct($id, $email, $password, $name, $isAccountAdmin)
    {
        $this->id             = $id;
        $this->email      = $email;
        $this->password   = $password;
        $this->name           = $name;
        $this->isAccountAdmin = $isAccountAdmin;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getIsAccountAdmin()
    {
        return $this->isAccountAdmin;
    }

    /**
     * @param string $isAccountAdmin
     */
    public function setIsAccountAdmin($isAccountAdmin)
    {
        $this->isAccountAdmin = $isAccountAdmin;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
