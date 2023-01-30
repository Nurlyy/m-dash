<?php
if (isset($result['projects']))
    foreach ($result['projects'] as $project) { ?>
    <div class="col-12" id="project-<?= $project['id'] ?>">
        <div class="modal inmodal" id="deleteProjModal" style="z-index: 2060 !important;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Вы уверены?</h4>
                    </div>
                    <div class="modal-body">
                        <p id="deleteProjModalParagraph"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="deleteproj(projid)" class="btn btn-white" data-dismiss="modal">Да</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>
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
                        <h4>Источников: <strong><?= $project['resources'] ?></strong></h4>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 row row-horizontal space-between">
                <div class="p-sm m-sm">
                    <div class="btn btn-primary" style='font-size:small; margin-top: 20px;' onclick="openurl('manage', 'editpage?project_id=<?= $project['id'] ?>')">Изменить</div>
                </div>
                <div class="p-sm m-sm">
                    <button id="stateButton-<?= $project['id'] ?>" onclick="turnStateProject(<?= $project['id'] ?>)" class="<?= ($project['is_active']) ? "btn btn-warning" : "btn btn-primary" ?>" style='font-size:small; margin-top: 20px;'><?= ($project['is_active']) ? "Отключить" : "Включить" ?> проект</button>
                </div>
                <div class="p-sm m-sm" style="float:right;">
                    <div class="btn btn-danger" style='font-size:small; margin-top: 20px;' onclick="showDeleteProjModal(<?= $project['id'] ?>, '<?= $project['name'] ?>')" data-toggle="modal" data-target="#deleteProjModal">Удалить</div>
                </div>

            </div>

        </div>
    </div>

<?php }

?>


<script>
    projid = null;
    projects = <?= json_encode($result['projects']) ?>;
    temp = {};
    projects.forEach(element => {
        temp[element['id']] = element;
    });
    projects = temp;

    function showDeleteProjModal(id, name = null) {
        projid = id;
        projname = null;

        projname = name;

        $("#deleteProjModalParagraph").text("Вы действительно хотите удалить проект \"" + projname + "\"? \n Ваше действие будет невозможно отменить.");

    }

    function deleteproj(id) {
        $.ajax({
            url: "/manage/deleteproj",
            type: "POST",
            data: {
                projid: id,
                '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
            },
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(resp) {
                toastr.error(`Проект "${projects[id].name}" удален`, '')
                $("#project-" + id).remove();
                delete projects.id;
            }
        });

    }

    function turnStateProject(project_id) {
        project = projects[project_id];
        $.ajax({
            type: "POST",
            url: "/manage/turnstateproject",
            data: {
                project_id: project_id,
                state: (project.is_active == 0) ? 1 : 0,
                "<?= Yii::$app->request->csrfParam ?>": "<?= Yii::$app->request->csrfToken ?>"
            },
            type: "POST",
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    console.log(" We have an error ");
                    console.log(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(resp) {
                if (resp == 'true') {
                    project.is_active = (project.is_active == 0) ? 1 : 0;
                    $("#stateButton-" + project_id).removeClass();
                    if (project.is_active == 1) {
                        $("#stateButton-" + project_id).addClass("btn btn-warning");
                        $("#stateButton-" + project_id).text("Отключить проект");
                        toastr.success(`Проект "${project.name}" включен`, '')
                    } else if (project.is_active == 0) {
                        $("#stateButton-" + project_id).addClass('btn btn-primary');
                        $("#stateButton-" + project_id).text("Включить проект");
                        toastr.success(`Проект "${project.name}" отключен`, '')
                    }
                } else {
                    console.log(resp=='true')
                    toastr.error(`Произошла ошибка при отключении проекта "${project.name}" `, '')
                }


                // nextThingToDo(resp); // deal with data returned
            }

        })
    }
</script>