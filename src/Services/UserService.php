<?php

namespace Quiz\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Quiz\Models\UserModel;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class UserService
{
    private $repository;

    /**
     * UserService constructor.
     * @param UserRepository|null $repository
     */
    public function __construct(?UserRepository $repository = null)
    {
        $this->repository = $repository ?? new UserRepository();
    }

    /**
     * @param array $data
     * @return Model
     * @throws Exception
     */
    public function registerUser(array $data): Model
    {
        if ($this->repository->userExists(['email' => $data['email']])) {
            throw new Exception('User already registred');
        }
        return $this->repository->create($data);
    }

    /**
     * @param array $data
     * @throws Exception
     */
    /**
     * @param UserModel $user
     */
    protected function login(UserModel $user)
    {
        Session::getInstance()->setLoggedInUser($user);
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function attemptLogin(array $data)
    {
        $user = $this->repository->one(['email' => $data['email']]);

        $userExists = (bool)$user;
        $isPasswordCorrect = password_verify($data['password'], $user->password ?? '');
        if (!$userExists || !$isPasswordCorrect) {
            throw new \Exception('Could not log you in');
        }
        $this->login($user);
    }

}