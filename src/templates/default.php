<?php

use Quiz\View;

/**
 * @var View $this
 * @var array $params
 */
$content = $this->renderContent($params);
$this->registerJsFile('https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous');
$this->registerCssFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous');
$this->registerJsFile('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous');
$this->registerJsFile('js/index.js');

$this->registerCssFile('assets/style.css');
$this->registerCssFile('css/main.css');


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php if ($this->cssFiles):
        foreach ($this->cssFiles as $cssFile): ?>
            <link rel="stylesheet" href="<?= $cssFile; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ($this->jsFiles):
        foreach ($this->jsFiles as $jsFile): ?>
            <script src="<?= $jsFile; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

</head>
<body>


<div id="app">

    <?= $this->renderView('header') ?>

    <?= $this->renderView('messages') ?>
    <?= $content; ?>




    <?php if ($this->js): ?>
        <script>
            <?=$this->js?>
        </script>
    <?php endif; ?>
</div>
<?= $this->renderView('footer') ?>
<script src='assets/scripts.js'></script>
</body>
</html>




