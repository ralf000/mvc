<html>
    <head>
        <title>Новости</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <? if (!empty($item)): ?>
                 <? if ($item instanceof app\models\News): ?>
                     <? require_once '_form.php';?>
                 <? endif; ?>
             <? endif; ?>
        </div>
    </body>
</html>