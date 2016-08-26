<html>
    <head>
        <title>Новости</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <? if (!empty($item) && is_array($item)): ?>
                     <? if ($item[0] instanceof app\models\News): ?>
                         <div class="row">
                             <div class="col-md-12">
                                 <h3 class="page-header"><?= $item[0]->title ?></h3>
                                 <small>Дата: <?= \app\helpers\Helper::dateConverter($item[0]->created_at) ?></small>
                                 <p style='padding-top: 10px'><b><?= $item[0]->description ?></b></p>
                                 <p style='padding: 10px 0px'><?= $item[0]->content ?></p>
                             </div>
                         </div>
                     <? endif; ?>
            <? endif; ?>
        </div>
    </body>
</html>