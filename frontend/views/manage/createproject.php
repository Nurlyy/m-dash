<div class="col-12 text-center">
    <div class="panel panel-default">
        <div class="panel-header">
            <h2 class='text-center'>Создание нового проекта</strong></h2>
        </div>
        <div class="panel-body">
            <div class="">
                <label for="name" style='font-size:small'>Название проекта:</label><br>
                <input id="projectname" type="text" style='font-size:medium' name="project_name"><br><br>
                <label for="owner" style='font-size:small'>Владелец:</label><br>
                <select id="projectowner" name="owner">
                    <?php foreach ($result as $user) { ?>
                        <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                    <?php } ?>
                </select><br><br>
                <!-- <input type="text" style='font-size:medium' id="owner" name="owner"><br> -->
                <button id="button" onclick="createproject()" type="button" class="btn btn-primary" style='font-size:medium; margin-top: 20px;'>Создать</button>
            </div>
        </div>
    </div>
</div>

<script>
    console.log(<?= json_encode($result)?>)
    function createproject() {
        $("#button").prop("disabled",true);
        name = $("#projectname").val();
        owner = $("#projectowner").val();
        
        $.ajax({
            url: "/manage/createproject",
            type: "POST",
            data: {project_name: name, owner: owner, "<?= Yii::$app->request->csrfParam ?>":"<?= Yii::$app->request->csrfToken ?>"},
            success: function (data) {
                console.log(data);
                toastr.success(`Проект "${name}" успешно создан`,'')
                // openurl('manage', 'mainpage');
            }
        })
    }
</script>