<?php

namespace Quiz\Models;



use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserModel
 * @package Quiz\Models
 * @property int $id
 * @property string $name
 * @property UserAnswerModel
 * @property AttemptModel[] $attempts
 */
class UserModel extends BaseModel
{
    protected $fillable = ['name', 'password', 'email'];
    public $table = 'users';

    protected $rules = [];

    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function attempts()
    {
        return $this->hasMany(AttemptModel::class, 'user_id', 'id');
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }

}