<?php

/* @var $this \core\base\Controller */
/* @var $content string */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test</title>
    <link rel="stylesheet" href="/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header class="header">
        <div class="navbar navbar-default navbar-simple">
            <div class="container">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?r=admin/index">Войти</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="container">
            <?= $content ?>
        </div>
    </div>
    <footer class="footer"></footer>

    <script src="/libs/jquery/jquery.min.js"></script>
    <script src="/libs/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
