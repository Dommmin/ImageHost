<?php

namespace App\Event;

use Symfony\Component\Security\Core\User\UserInterface;

class LoginErrorEvent
{
    const NAME = 'login.error';

    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }
}
