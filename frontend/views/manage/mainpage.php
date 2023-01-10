<?php
if (isset($result['projects']))
    foreach ($result['projects'] as $project) { ?>
    <div class="col-12">
        <div class="panel panel-default">
            <div class="panel-header">
                <h2 class='text-center'>Проект: <strong><?= $project['name'] ?></strong></h2>
            </div>
            <div class="panel-body">
                <div class="col-12 row">
                    <div class="col-lg-4 col-sm-12 p-sm">
                        <h4>Владелец: <strong><?= $project['username'] ?></strong></h4>
                        <h4>Email: <strong><?= $project['email'] ?></strong></h4>
                    </div>
                    <div class="col-lg-4 col-sm-12 p-sm">
                        <h4>Создано: <strong><?= $project['created_date'] ?></strong></h4>
                        <h4 class="text-primary">Статус: <strong><?= ($project['is_active'] == 1) ? "Активно" : "Отключен" ?></strong></h4>
                    </div>
                    <div class="col-lg-4 col-sm-12 p-sm">
                        <h4>Городов: <strong><?= $project['cities'] ?></strong></h4>
                        </h4>
                        <h4>Ресурсов: <strong><?= $project['resources'] ?></strong></h4>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 row row-horizontal space-between">
                <div class="p-sm m-sm">
                    <div class="btn btn-primary" style='font-size:small; margin-top: 20px;' onclick="openurl('manage', 'editpage?project_id=<?= $project['id'] ?>')">Изменить</div>
                </div>
                <div class="p-sm m-sm">
                    <form action="turnstateproject" method="POST">
                        <input id="form-token" type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>" />
                        <input id="project_id" type="hidden" name="project_id" value="<?= $project['id'] ?>" />
                        <input id="state" type="hidden" name="state" value="<?= ($project['is_active'] > 0) ? $project['is_active'] - 1 : $project['is_active'] + 1 ?>" />
                        <input type="submit" class="<?= ($project['is_active']) ? "btn btn-danger" : "btn btn-primary" ?>" style='font-size:small; margin-top: 20px;' value="<?= ($project['is_active']) ? "Отключить" : "Включить" ?> проект">
                    </form>
                </div>

            </div>

        </div>
    </div>

<?php }

?>


<script>

    function turnStateProject(project_id, state) {
        $.ajax({
            method: "POST",
            url: "/manage/turnstateproject",
            data: {
                project_id: project_id,
                state: !state,
            },
            type: "POST",
            dataType: 'json',
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    alert("else: " + e.message); // the great unknown
                }
            },
            success: function(resp) {
                // nextThingToDo(resp); // deal with data returned
                console.log(resp);
            }

        })
        // console.log(!state);
    }
</script>