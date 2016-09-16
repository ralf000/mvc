<html>
    <head>
        <title>Новости</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container" style="margin-bottom: 40px; margin-top: 40px;">
            <? if (!empty($this->news) && is_string($this->news)): ?>
                 <? echo $this->news; ?>
             <? else: ?>
                 <p>Новостей нет</p>
            <? endif; ?>
        </div>
    </body>
</html>