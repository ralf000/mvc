<html>
    <head>
        <title>Новости</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://getbootstrap.com/dist/css/bootstrap.min.css">
    </head>
    <body>
        <? if ($this->data['exceptions']): ?>
             <? $output = ''; ?>
             <? foreach ($this->data['exceptions'] as $e): ?>
                 <? $output .= $e->getMessage() . '<br>'; ?>
             <? endforeach; ?>
             <? if ($output): ?>
                 <div class="alert alert-danger" role="alert"><?= $output ?></div>
             <? endif; ?>
         <? endif; ?>
        <div class="container">
            <? require_once '_form.php'; ?>
        </div>
    </body>
</html>