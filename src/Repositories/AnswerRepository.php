<?php


namespace Quiz\Repositories;

/**
 * @method AnswerModel|null one(array $conditions = []) : ?Model
 */

use Quiz\Models\AnswerModel;

class AnswerRepository extends BaseRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return AnswerModel::class;
    }
}