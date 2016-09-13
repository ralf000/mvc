<html>
    <head>
        <title></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" style="margin-top: 50px;">
            <div class="panel panel-danger">
                <div class="panel-heading">Ошибка при работе с базой данных</div>
            </div>
            <div class="panel-body">
                <p><?= $this->data['exception']->getMessage() ?></p>
                <p><?= $this->data['exception']->getException() ?></p>
            </div>
        </div>
    </body>
</html>