<?php

use Quiz\ActiveUser;
use Quiz\Models\QuizModel;
use Quiz\Models\UserModel;
use Quiz\Session;
use Quiz\View;

?>

<?php if (ActiveUser::isLoggedIn()):
    $userName = ActiveUser::getLoggedInUser()->name;



    ?>

    <div class="row">
        <div style="margin-left:auto;margin-right:auto;">


        </div>
    </div>


<?php endif; ?>