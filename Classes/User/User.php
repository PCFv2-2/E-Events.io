<?php

require_once '../../Required.php';

class User
{
    private $id;
    private $login;
    private $role;
    private $password;

    public function __construct($id = -1, $login = null, $role = UsersRolesEnum::NO_ROLE, $password = null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->role = $role;
        $this->password = $password;

        echo $login;
    }

    public function updateRole($role = UsersRolesEnum::NO_ROLE)
    {
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return int|mixed
     */
    public function getRole()
    {
        return $this->role;
    }
}