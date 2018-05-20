<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:34
 */

namespace Slack;

class User extends Entity
{
    private $userName;
    private $passwordHash;

    public function __construct(int $id, string $userName, string $passwordHash)
    {
        parent::__construct($id);
        $this->userName = $userName;
        $this->passwordHash = $passwordHash;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

}