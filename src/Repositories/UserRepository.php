<?php

namespace Quiz\Repositories;


use http\Client\Curl\User;
use Quiz\Models\QuizModel;
use Quiz\Models\UserModel;

/**
 * Class QuizRepository
 * @package Quiz\Repositories
 * @method UserModel|null one($conditions = [])
 * @method UserModel all($conditions = [])
 * @method UserModel create (array $data): Model
 */
class UserRepository extends BaseRepository
{

    public function userExists(array $conditions = []): bool
    {
        return UserModel::query()->where($conditions)->exists();
    }

    /**
     * @param array $data
     * @return UserModel
     */
    public function createUser(array $data): UserModel
{
    $user = new UserModel();
    $user->fill($data);
    $user->save();
    return $user;
}


    /**
     *
     * @return UserModel|null
     */

    public function getModelClass()
    {
        return UserModel::class;
    }
}