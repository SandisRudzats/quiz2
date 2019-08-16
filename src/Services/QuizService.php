<?php

namespace Quiz\Services;


use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\QuestionModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Session;

class QuizService
{
    /** @var QuizRepository $repository */
    private $repository;

    /** @var QuestionRepository $questionRepository */
    private $questionRepository;

    /** @var UserRepository $userRepository */
    private $userRepository;
    /** @var  */
    private $answerRepository;
    /** @var  */
    private $userAnswerRepository;
    /** @var Session $session */
    private $session;
    protected const SESSION_KEY_CURRENT_ATTEMPT_ID = 'currentAttemptId';
    protected const SESSION_KEY_QUESTION_ANSWERED = 'questionsAnswered';
    /** @var AttemptRepository  */
    private $attemptRepository;
    public function __construct(
        QuizRepository $repository = null,
        AnswerRepository $answerRepository = null,
        UserAnswerRepository $userAnswerRepository = null,
        QuestionRepository $questionRepository = null,
        UserRepository $userRepository = null,
        AttemptRepository $attemptRepository = null,
        Session $session = null
    ) {

        $this->repository = $repository ?: new QuizRepository;
        $this->questionRepository = $questionRepository ?: new QuestionRepository;
        $this->userRepository = $userRepository ?: new UserRepository;
        $this->session = $session ?: Session::getInstance();
        $this->answerRepository = $answerRepository ?: new AnswerRepository;
        $this->userAnswerRepository = $userAnswerRepository ?: new UserAnswerRepository;
        $this->attemptRepository = $attemptRepository ?: new AttemptRepository;
    }

    public function getQuizRpcData()
    {
        $quizzes = $this->repository->all();

        $quizData = [];
        foreach ($quizzes as $quiz) {
            $questionCount = $this->questionRepository->count(['quiz_id' => $quiz->id]);
            $quizData[] = [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'questionCount' => $questionCount,
            ];

        }
        return $quizData;
    }
    public function getAllResults()
    {
        $quizzes = $this->repository->all();

        return $quizzes;
    }

    /**
     * @param int $userId
     * @param int $quizId
     * @return \Quiz\Models\QuizModel|null
     * @throws \Exception
     *
     */
    public function start(int $userId, int $quizId)
    {
        $userExists = $this->userRepository->userExists(['id' => $userId]);
        if (!$userExists) {
            throw new QuizException('unknown user');
        }
        $quiz = $this->getQuizById($quizId);

        $attempt = $this->attemptRepository->create([
           'user_id' => $userId,
           'quiz_id' =>$quizId,
        ]);

        $this->session->set(self::SESSION_KEY_CURRENT_ATTEMPT_ID, $attempt->id);
        $this->session->set(self::SESSION_KEY_QUESTION_ANSWERED, 0);

        return $quiz;
    }

    public function getNextQuestion()
    {
        $attemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($attemptId);

        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTION_ANSWERED);

        if ($questionsAnswered < 0) {
            throw new QuizException('questions answered not set');
        }

        $question =   $this->questionRepository->getQuestionByQuizIdAndOffset($attempt->quiz_id, $questionsAnswered);

        return $question;


    }

    public function getQuizQuestionRpcData(QuestionModel $question)
    {
        $answerData = [];
        foreach($question->answers as $answer) {
            $answerData[] = $this->getAnswerRpsData($answer);
        }
        return [
            'id' => $question->id,
            'text' => $question->text,
            'answers' => $answerData,
        ];
    }
    private function getAnswerRpsData(AnswerModel $answer)
    {
        return [
          'id' => $answer->id,
          'text' => $answer->text,
        ];
    }

    /**
     * @param int $quizId
     * @return \Quiz\Models\QuizModel|null
     * @throws \Exception
     */
    public function getQuizById(int $quizId)
    {
        $quiz = $this->repository->one(['id' => $quizId]);
        if (!$quiz) {
            throw new QuizException("could not find the quiz  #$quizId");
        }
        return $quiz;
    }

    public function saveAnswer($answerId)
    {
        $answer = $this->answerRepository->one(['id' => $answerId]);
        if(!$answer) {
            throw new QuizException("answer #$answerId not found");
        }
        $currentAttemptId = $this->session->get(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $attempt = $this->getAttemptById($currentAttemptId);

        $this->userAnswerRepository->create([
            'attempt_id' => $attempt->id,
            'question_id' => $answer->question_id,
            'answers_id' => $answer->id,



        ]);
        $questionsAnswered = $this->session->get(self::SESSION_KEY_QUESTION_ANSWERED);
        $questionsAnswered++;
        $this->session->set(self::SESSION_KEY_QUESTION_ANSWERED, $questionsAnswered);
    }

    /**
     * @return array
     */
    public function getResultData()
    {
        $currentAttemptId = $this->session->get(self:: SESSION_KEY_CURRENT_ATTEMPT_ID);

        $attempt = $this->getAttemptById($currentAttemptId);

        $correctAnswerCount = 0;
        foreach($attempt->userAnswers as $userAnswer) {
            $correctAnswerCount += $userAnswer->answer->is_correct;
    }
        $this->session->delete(self::SESSION_KEY_CURRENT_ATTEMPT_ID);
        $this->session->delete(self::SESSION_KEY_QUESTION_ANSWERED);

        return [
          'correctAnswerCount' => $correctAnswerCount,

        ];


    }

    /**
     * @param $attemptId
     * @return \Quiz\Models\AttemptModel|null
     * @throws \Exception
     */
    public function getAttemptById($attemptId)
    {
        $attempt = $this->attemptRepository->one([
            'id' => $attemptId
        ]);
        if (!$attempt) {
            throw new QuizException('quiz has not been started');
        }
        return $attempt;
    }

}