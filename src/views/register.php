<?php

use Quiz\View;


/**
 * @var View $this
 */
?>
<div class="row">
    <form action="/registerPost" method="POST" class="form">

        <div class="form-group">
            <input type="text" name="name" placeholder="Name" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="password" class="form-control" required>
        </div>

        <button class="btn btn-info">Register</button>
    </form>
</div>