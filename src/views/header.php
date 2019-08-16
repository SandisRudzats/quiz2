<?php

use Quiz\ActiveUser;

?>
<header>

    <div class="navbar" >
        <div class="container">

           <?php if (ActiveUser::isLoggedIn()): ?>

               <a href="/logout">logout</a>
               <a href="/results">results</a>
            <?php else: ?>
               <a href="/login">login</a>
               <a href="/register">register</a>
            <?php endif; ?>


        </div>

    </div>

</header>



