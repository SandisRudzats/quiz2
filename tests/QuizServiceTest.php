<?php

namespace Quiz\Tests;

use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Quiz\Exceptions\QuizException;
use Quiz\Models\AnswerModel;
use Quiz\Models\AttemptModel;
use Quiz\Models\QuizModel;
use Quiz\Repositories\AnswerRepository;
use Quiz\Repositories\AttemptRepository;
use Quiz\Repositories\QuestionRepository;
use Quiz\Repositories\QuizRepository;
use Quiz\Repositories\UserAnswerRepository;
use Quiz\Repositories\UserRepository;
use Quiz\Services\QuizService;
use Quiz\Session;

class QuizServiceTest extends TestCase
{
    /** @var QuizRepository|MockInterface $quizRepository */
    private $quizRepository;

    /** @var QuestionRepository|MockInterface $questionRepository */
    private $questionRepository;

    /** @var UserRepository|MockInterface $userRepository */
    private $userRepository;
    /** @var AnswerRepository|MockInterface */
    private $answerRepository;
    /** @var UserAnswerRepository|MockInterface */
    private $userAnswerRepository;
    /** @var  Session |MockInterface Session $session */
    private $session;

    /** @var |MockInterface AttemptRepository */
    private $attemptRepository;
    /** @var QuizService $quizService */
    private $quizService;

    public function setUp(): void
    {
        parent::setUp();
        $this->quizRepository = \Mockery::mock(QuizRepository::class);
        $this->questionRepository = \Mockery::mock(QuestionRepository::class);
        $this->answerRepository = \Mockery::mock(AnswerRepository::class);
        $this->userRepository = \Mockery::mock(UserRepository::class);
        $this->attemptRepository = \Mockery::mock(AttemptRepository::class);
        $this->userAnswerRepository = \Mockery::mock(UserAnswerRepository::class);
        $this->session = \Mockery::mock(Session::class);

//        QuizRepository $repository = null,
//        AnswerRepository $answerRepository = null,
//        UserAnswerRepository $userAnswerRepository = null,
//        QuestionRepository $questionRepository = null,
//        UserRepository $userRepository = null,
//        AttemptRepository $attemptRepository = null,
//        Session $session = null
//    ) {null
        $this->quizService = new QuizService(
            $this->quizRepository,
            $this->answerRepository,
            $this->userAnswerRepository,
            $this->questionRepository,
            $this->userRepository,
            $this->attemptRepository,
            $this->session);


    }

    public function testQuizStart_userDoesntExist_exceptionThrown()
    {
        $this->userRepository->shouldReceive('userExists')
            ->atLeast()
            ->once()
            ->andReturnFalse();

        $this->expectException(QuizException::class);
        $this->quizService->start(1, 1);
    }

    public function testQuizStart_quizDoesntExists_exceptionThrown()
    {
        $this->userRepository->shouldReceive('userExists')
            ->atLeast()
            ->once()
            ->andReturnTrue();

        $this->quizRepository->shouldReceive('one')
        ->once()->andReturnNull();
        $this->expectException(QuizException::class);
        $this->quizService->start(1, 1);
    }

    public function testQuizStart_everythingIsCorrect_quizReturned()
    {
        $this->userRepository->shouldReceive('userExists')
            ->atLeast()
            ->once()
            ->andReturnTrue();
                $returnedQuiz = new QuizModel;
                $returnedQuiz->id = 500;

        $this->quizRepository->shouldReceive('one')
            ->atLeast()
            ->once()
            ->andReturn($returnedQuiz);

        $returnedAttempt = new AttemptModel;
        $returnedAttempt->id = 1000;
        $quizId = 15;
        $userId = 30;

        $this->attemptRepository
        ->shouldReceive('create')
            ->atLeast()
            ->once()
            ->with([
                'user_id' => $userId,
                'quiz_id' => $quizId
            ])->once()
            ->andReturn($returnedAttempt);

        $this->session->shouldReceive('set')->atLeast()->twice();
        $quiz = $this->quizService->start($userId, $quizId);

        $this->assertEquals($returnedQuiz->id , $quiz->id,'correct quiz returned');
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}