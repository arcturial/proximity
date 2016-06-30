<?php
namespace App;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\Session\Session;
use \InvalidArgumentException;

class Auth
{
    public function __construct(UserService $userService, Session $session)
    {
        $this->userService = $userService;
        $this->session = $session;
    }

    public function authenticatedUser()
    {
        return $this->session->get('user');
    }

    public function authenticate($email, $password)
    {
        $user = $this->userService->fetchUserByEmail($email);

        if ($user->verifyPassword($password)) {
            $this->session->set('user', $user);
            return true;
        }

        throw new InvalidArgumentException('Password incorrect');
    }
}