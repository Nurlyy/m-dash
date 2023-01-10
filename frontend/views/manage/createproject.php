<div class="col-12 text-center">
    <div class="panel panel-default">
        <div class="panel-header">
            <h2 class='text-center'>Создание нового проекта</strong></h2>
        </div>
        <div class="panel-body">
            <div class="row justify-content-center">
                <form action="createproject" method="POST">
                    <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
                    <label for="name" style='font-size:small'>Название проекта:</label><br>
                    <input type="text" style='font-size:medium' id="project_name" name="project_name"><br><br>
                    <label for="owner" style='font-size:small'>Владелец:</label><br>
                    <select name="owner" id="owner">
                        <?php foreach($result as $user){ ?>
                            <option value="<?= $user['id'] ?>"><?= $user['username']?></option>
                        <?php } ?>
                    </select><br><br>
                    <!-- <input type="text" style='font-size:medium' id="owner" name="owner"><br> -->
                    <input type="submit" class="btn btn-primary" style='font-size:medium; margin-top: 20px;' value="Создать">
                </form>
            </div>
        </div>
    </div>
</div>

<script>
</script>