<?php

namespace App\Model;

use Nette\Security;
use Nette\Database\Context;
use Tracy\Debugger;

class MyAuthenticator implements Security\IAuthenticator
{
    public $database;

    function __construct(Context $database)
    {
        $this->database = $database;
    }

    function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;
        $row = $this->database->table('users')
            ->where('user_name', $username)->fetch();

        if (!$row) {
            throw new Security\AuthenticationException('User not found.');
        }

        else if (Security\Passwords::hash($password) != $row->user_pass) {
            throw new Security\AuthenticationException('Invalid password.');
        }
        else
        {
            return new Security\Identity($row->user_id, ['user_name' => $row->user_name]);
        }

    }
}