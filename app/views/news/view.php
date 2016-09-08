<html>
    <head>
        <title><?= $this->article->title?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <? if (!empty($this->article)): ?>
                     <? if ($this->article instanceof app\models\News): ?>
                         <div class="row">
                             <div class="col-md-12">
                                 <h3 class="page-header"><?= $this->article->title ?></h3>
                                 <small>Дата: <?= \app\helpers\Helper::dateConverter($this->article->created_at) ?></small>
                                 <small class="pull-right">Автор: <?= $this->article->author->name ?></small>
                                 <p style='padding-top: 10px'><b><?= $this->article->description ?></b></p>
                                 <p style='padding: 10px 0px'><?= $this->article->content ?></p>
                                 <a class="pull-left btn btn-default" href="/?news/edit&id=<?= $this->article->id ?>"><span class="glyphicon glyphicon-edit"></span></a>
                                 <a class="pull-right btn btn-default" href="/?news/index">Назад</a>
                             </div>
                         </div>
                     <? endif; ?>
            <? endif; ?>
        </div>
    </body>
</html>