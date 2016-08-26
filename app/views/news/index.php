<html>
    <head>
        <title>Новости</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <? if (!empty($news) && is_array($news)): ?>
                 <? foreach ($news as $item): ?>
                     <? if ($item instanceof app\models\News): ?>
                         <div class="row">
                             <div class="col-md-12">
                                 <h3 class="page-header"><?= $item->title ?></h3>
                                 <small>Дата: <?= \app\helpers\Helper::dateConverter($item->created_at) ?></small>
                                 <p style='padding-top: 10px'><b><?= $item->description ?></b></p>
                                 <p style='padding: 10px 0px'><?= $item->content ?></p>
                                 <a class="btn btn-default pull-right" href="/?one-news=1&id=<?= $item->id ?>">Подробнее...</a>
                             </div>
                         </div>
                     <? endif; ?>
                 <? endforeach; ?>
             <? else: ?>
                 <p>Новостей нет</p>
            <? endif; ?>
        </div>
    </body>
</html>