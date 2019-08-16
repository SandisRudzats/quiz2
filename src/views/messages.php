<?php
use Quiz\Session;
use Quiz\View;
?>


<div class="container">
    <div>
        <?php if (\Quiz\Session::getInstance()->hasErrors()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (Session::getInstance()->getErrors(true) as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if (\Quiz\Session::getInstance()->hasMessages()): ?>
            <div class="alert alert-info">
                <ul>
                    <?php foreach (Session::getInstance()->getMessages(Session::TYPE_MESSAGE,
                        true) as $message): ?>
                        <li><?= $message ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>