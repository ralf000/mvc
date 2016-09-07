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
                         <div class="row">
                             <div class="col-md-12">
                                 <h3 class="page-header"><?= $item->title ?></h3>
                                 <small>Дата: <?= \app\helpers\Helper::dateConverter($item->created_at) ?></small>
                                 <p style='padding-top: 10px'><b><?= $item->description ?></b></p>
                                 <p style='padding: 10px 0px'><?= $item->content ?></p>
                                 <a class="pull-left btn btn-default" href="/?news/edit&id=<?= $item->id ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                 <a class="pull-right btn btn-default" href="/?news/index">Назад</a>
                             </div>
                         </div>
                     <? endif; ?>
            <? endif; ?>
        </div>
    </body>
</html>