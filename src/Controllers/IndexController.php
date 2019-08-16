<?php


namespace Quiz\Controllers;
use Quiz\ActiveUser;
use Quiz\Models\QuizModel;
use Quiz\Services\QuizService;
use Quiz\Services\UserService;

/**
 * Class IndexController
 * @package Quiz\Controllers
 *
 */
class IndexController extends BaseController
{
    /** @var QuizService $quizService */
    public $quizService;
    public function __construct()
    {
        $this->quizService = new QuizService;
        parent::__construct();
    }

    /**
     * @return string
     *
     */
    public function index()
    {
        if(!ActiveUser::isLoggedIn()) {
            redirect('login');
        }
        try {
            $quizData = $this->quizService->getQuizRpcData();
        } catch  (\Exception $exception) {
            die($exception->getMessage());
        }
        return $this->view('home',['quizData' =>$quizData,]);
    }

    /**
     * @return string
     */
    public function about()
    {
        return $this->view('about');
    }
}