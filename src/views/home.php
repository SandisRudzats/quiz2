<?php
/**
 *
 * @var View $this
 * @var QuizModel[]
 * @var $quizzes []
 * @var array $quizData
 */

use Quiz\ActiveUser;
use Quiz\Models\QuizModel;
use Quiz\View;


?>

<?php if (ActiveUser::isLoggedIn()):
    $userName = ActiveUser::getLoggedInUser()->name; ?>

    <div class="row">
        <div style="margin-left:auto;margin-right:auto;">
            <quiz :name='<?= json_encode($userName); ?>' :quizzes-prop='<?= json_encode($quizData); ?>'></quiz>
        </div>
    </div>




<?php endif; ?>



