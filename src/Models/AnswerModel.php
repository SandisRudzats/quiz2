<?php

namespace Quiz\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Quiz\Models\BaseModel;
use Quiz\Models\QuestionModel;
use Quiz\Models\UserAnswerModel;

/**
 * Class AnswerModel
 * @package Quiz\Models
 * @property int $id
 * @property string $text
 * @property bool $is_correct
 * @property AnswerModel[] $answers

 */
class AnswerModel extends BaseModel
{
    /**
     * @var string
     */
    public $table = 'answers';

    public function question()
    {
        $this->hasOne(QuestionModel::class,'id','question_id');
    }

    /**
     * @return HasMany
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswerModel::class, 'id', 'answers_id');
    }

}