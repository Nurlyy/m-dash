<div class="col-12">
    <form action="/super/createproject" method="POST">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>" />
        <label for="name">Название проекта:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="owner">Владелец:</label><br>
        <input type="text" id="owner" name="owner"><br>
        <input type="submit" value="Создать">
    </form>
</div>