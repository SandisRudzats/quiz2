<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Quiz\Models\UserModel;

/**
 * Class UserAnswerModel
 * @package Quiz\Models
 * @property int $id
 * @property int $user_id
 * @property int $quiz_id
 * @property int $question_id
 * @property int $answer_id
 * @property AttemptModel $attempt

 * @property QuestionModel $question
 * @property AnswerModel $answer
 */


class UserAnswerModel extends BaseModel
{
    /** @var array  */
    public $guarded = [];
    /** @var string $table */
    public $table = 'user_answers';

    /**
     * @return HasOne
     */
    public function attempt()
    {
        return $this->hasOne(AttemptModel::class,'id', 'attempt_id');
    }

    /**
     * @return HasOne
     */
    public function question(): HasOne
    {
        return $this->hasOne(QuestionModel::class,'id','question_id');
    }

    /**
     * @return HasOne
     */
    public function answer(): HasOne
    {
        return $this->hasOne(AnswerModel::class,'id','answers_id');
    }
}