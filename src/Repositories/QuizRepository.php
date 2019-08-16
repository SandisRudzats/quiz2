<?php

namespace Quiz\Repositories;


use Quiz\Models\QuizModel;
use Quiz\Models\UserModel;


/**
 * Class QuizRepository
 * @package Quiz\Repositories
 * @method QuizModel|null one($conditions = [])
 * @method QuizModel all($conditions = [])
 * @method QuizModel create (array $data): Model
 */
class QuizRepository extends BaseRepository
 /**
 * @return string
 */
{
    protected function getModelClass()
    {
        return QuizModel::class;
    }


}