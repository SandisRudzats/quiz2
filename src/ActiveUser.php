<?php

namespace Quiz;


use Quiz\Models\UserModel;

/**
 * Class ActiveUser
 * @package Quiz
 *
 */
class ActiveUser
{
    /**
     * @return bool
     */
    public static function isLoggedIn(): bool 
    {
        return !is_null(Session::getInstance()->getLoggedInUserId());
    }

    /**
     * @return UserModel $user
     */

    public static function getLoggedInUser(): ?UserModel
    {
        $userId = Session::getInstance()->getLoggedInUserId();
        $user = UserModel::query()->where(['id' => $userId])->first();
        
        return $user;
    }
}