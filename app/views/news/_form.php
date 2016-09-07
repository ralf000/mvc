<div class="row">
    <div class="col-md-12">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="form-group">
                <label for="title">Заголовок</label>
                <input type="text" name="title" class="form-control" id="title" value="<?= $item->title ?>">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea name="description" class="form-control" id="description"><?= $item->description ?></textarea>
            </div>
            <div class="form-group">
                <label for="content">Контент</label>
                <textarea name="content" class="form-control" id="content"><?= $item->content ?></textarea>
            </div>
            <input type="submit" value="Сохранить" class="btn btn-default pull-right"/>
        </form>
    </div>
</div>