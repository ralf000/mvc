<div class="row">
    <div class="col-md-12">
        <form action="<?= app\helpers\RequestRegistry::server('REQUEST_URI') ?>" method="post">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" class="form-control" id="title" value="<?= $this->article->title ?>">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description"><?= $this->article->description ?></textarea>
            </div>
            <div class="form-group">
                <label for="content">Контент</label>
                <textarea name="content" class="form-control" id="content"><?= $this->article->content ?></textarea>
            </div>
            <input type="submit" value="Сохранить" class="btn btn-default pull-right"/>
        </form>
    </div>
</div>