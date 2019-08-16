<?php


namespace Quiz\Controllers;


use Illuminate\Support\Arr;
use Quiz\Repositories\QuizRepository;
use Quiz\Services\QuizService;
use Quiz\Session;


/**
 * Class QuizController
 * @package Quiz\Controllers
 */
class QuizController extends BaseController
{


    private $quizService;

    public function __construct()
    {
        $this->quizService = new QuizService;
        parent::__construct();
    }

    /**
     * @return false|string
     */
    public function start()

    {
        $userId = Session::getInstance()->getLoggedInUserId();
        $quizId = Arr::get($_POST, 'quizId');
        try {
            $this->quizService->start($userId, $quizId);
            $question = $this->quizService->getNextQuestion();
            $questionData = $this->quizService->getQuizQuestionRpcData($question);
        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }
        return json_encode(
            ['questionData' => $questionData]);
    }

    /**
     * @return false|string
     */
    public function nextQuestion()
    {
        $answerId = Arr::get($_POST, 'answerId');
        try {

            $this->quizService->saveAnswer($answerId);
            $question = $this->quizService->getNextQuestion();


            if (!$question) {
                $resultData = $this->quizService->getResultData();
                return json_encode([
                    'resultData' => $resultData,
                ]);
            }

            $questionData = $this->quizService->getQuizQuestionRpcData($question);

        } catch (\Exception $exception) {
            return json_encode([
                'error' => $exception->getMessage(),
            ]);
        }

        return json_encode(
            ['questionData' => $questionData]);
    }

    /**
     * @return string
     */
    public function showResults()
    {

        return $this->view('results');
    }

}