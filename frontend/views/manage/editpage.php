<?php $city_id = null;
$res_name = "";
$res_id = null;

?>
<div class="col-12 text-center">
    <div class="panel panel-default">
        <div class="panel-header">
            <h2 class='text-center'><strong>Изменить проект</strong></h2>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-12 justify-content-center">
                    <div class="panel panel-default">
                        <div class="panel-body" style="text-align: center;">
                            <h3>Название:</h3>
                            <input type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" value="<?= $result['project']['name'] ?>" /><br>
                            <h3>Владелец:</h3>
                            <select name="owner" id="owner">
                                <option value="<?= $result['project']['user_id'] ?>"><?= $result['project']['username'] ?></option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                                <?php } ?>
                            </select><br><br>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <div class="panel panel-default">
                        <div class="panel-header">
                            <h2 class='text-center'><strong>Список городов проекта</strong></h2>
                        </div>
                        <?php
                        if (!empty($result['project']['cities'])) {
                            foreach ($result['project']['cities'] as $city) { ?>
                                <div class="panel-body">
                                    <div class="city-container row text-center ">
                                        <h4 style="padding:0px; margin: 0px;" class="col-4"><?= $city['name'] ?></h4>
                                        <p style="padding: 0px; margin: 0px;" class="col-4"><?= count($city['resources']) ?> ресурсов</p>
                                        <div class="col-4 text-right">
                                            <a href="" onclick="showModal(<?= $project_id ?>, <?= $city['id'] ?>)<?php $city_id = $city['id'] ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" style="margin-right:10px; font-size:medium;" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-trash" style="font-size:medium;" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="cityModal">
                                <div class="modal inmodal delresmodal" id="deleteResModal" style="z-index: 2060 !important;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content animated flipInY">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title">Вы уверены?</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p id="deleteResModalParagraph"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="deleteres(restype, resid)" class="btn btn-white" data-dismiss="modal">Да</button>
                                                <!-- <form action="/manage/deleteresource" method="POST"><input type="hidden" name="res_id" value="<?= $res_id ?>"><input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" /><input type="submit" value="Да" class="btn btn-white" /></form> -->
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal inmodal fade" id="editModal" style="overflow:auto !important;" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="overflow:auto !important;">
                                        <div class="modal-content" style="overflow:auto !important;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title text-center">Редактирование города</h4><br>
                                                <button type="button" class="btn btn-primary">Сохранить</button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-12 justify-content-center">
                                                        <div class="panel panel-default" style="background-color:azure; ">
                                                            <div class="panel-body" style="text-align: center;">
                                                                <h3>Название:</h3>
                                                                <input type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" value="<?= $result['project']['cities'][$city_id]['name'] ?>" /><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="panel panel-primary" style="background-color:azure; ">
                                                            <div class="panel-header">
                                                                <h2 class='text-center'><strong>Список ресурсов города</strong></h2>
                                                            </div>
                                                            <div style="padding: 15px;">
                                                                <div id="cities_container"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveChanges()">Сохранить</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <h3 style="padding:20px; font-style:normal;">Список пуст</h3>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let createdResCounter = 0;
    let restype = null;
    let resid = null;


    function showModal(project_id, city_id) {
        $.ajax({
            url: "/manage/showmodal?project_id=" + project_id + "&city_id=" + city_id,
            method: "GET",

        }).done(function success(data) {
            data = `<div class="btn btn-primary collapsible col-12" style="margin-bottom:15px;">Добавить новый ресурс</div>
                    <div id="collapsible-content" class="panel-body" style="display:none !important; margin-top:-30px;">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h3>Название ресурса:</h3>
                                <input type="text" id="name" class="form-control" /><br>
                                <h3>Ссылка ресурса:</h3>
                                <input type="text" id="url" class="form-control" /><br>
                                <h3>Изображение ресурса:</h3>
                                <input type="text" id="img" class="form-control" /><br>
                                <h3>Описание ресурса:</h3>
                                <input type="text" id="desc" class="form-control" /><br>
                                <button type="button" class="btn btn-primary" onclick="addnewres()">Добавить новый ресурс</button>
                            </div>
                        </div>
                    </div>` + data;
            $("#cities_container").html(data);
            var coll = document.getElementsByClassName("collapsible");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content = this.nextElementSibling;
                    if (content.style.display === "block") {
                        content.style.display = "none";
                    } else {
                        content.style.display = "block";
                    }
                });
            }
        })
    }

    var cityChanges = {};
    var resourcesChanges = {};
    var createdResources = {};
    var createdCities = {};

    function showDeleteResModal(type, id, name = null) {
        restype = type;
        resid = id;
        resname = null;
        if (type === "count") {
            resname = createdResources[id]['name'];
        } else if (type === "id") {
            if (resourcesChanges[id]) {
                if (resourcesChanges[id]['name']) {
                    resname = resourcesChanges[id]['name'];
                }
            } else {
                resname = name;
            }
        }
        console.log(resname);
        $("#deleteResModalParagraph").text("Вы точно хотите удалить ресурс \"" + resname + "\"");

    }

    function deleteres(type, id) {
        if (type === "count") {
            delete createdREsources[id];
            $("#col-count-" + id).remove();
            $(".colcontent-count-" + id).remove();
        } else if (type === "id") {
            $.ajax({
                url: "/manage/deleteres",
                type: "POST",
                data: {
                    resid: id,
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
                    console.log(resp);
                }
            });
            $("#col-id-" + id).remove();
            $(".colcontent-id-" + id).remove();
        }
    }


    function editAddedRes(count, field_name) {
        field_value = $("#" + field_name + "_added_" + count).val();
        createdResources[count][field_name] = field_value;
    }

    function addnewres() {
        name = $("#name").val();
        img = $("#img").val();
        url = $("#url").val();
        desc = $("#desc").val();

        createdResCounter += 1;

        createdResources[createdResCounter] = {};
        createdResources[createdResCounter]['name'] = name;
        createdResources[createdResCounter]['url'] = url;
        createdResources[createdResCounter]['photo'] = img;
        createdResources[createdResCounter]['description'] = desc;
        createdResources[createdResCounter]['city_id'] = <?= $city_id ?>;

        $("#cities_container").append(
            `<div class="btn btn-primary collapsible col-12" id="col-count-${createdResCounter}" style="margin-bottom:15px;">${name}</div>
                    <div id="collapsible-content" class="panel-body colcontent-count-${createdResCounter}" style="display:none !important; margin-top:-30px;">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h3>Название ресурса:</h3>
                                <input type="text" id="name_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'name')" value="${name}" /><br>
                                <h3>Ссылка ресурса:</h3>
                                <input type="text" id="url_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'url')" value="${url}" /><br>
                                <h3>Изображение ресурса:</h3>
                                <input type="text" id="photo_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'photo')" value="${img}" /><br>
                                <h3>Описание ресурса:</h3>
                                <input type="text" id="description_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'description')" value="${desc}" /><br>
                                <button type="button" class="btn btn-danger" onclick="showDeleteResModal('count', ${createdResCounter})" data-toggle="modal" data-target="#deleteResModal">Удалить ресурс</button>
                            </div>
                        </div>
                    </div>`);

        items = document.getElementsByClassName("collapsible");
        last = items[items.length - 1];
        last.addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
        last.scrollIntoView();

        name = document.getElementById("name").value = " ";
        img = document.getElementById("img").value = " ";
        url = document.getElementById("url").value = " ";
        desc = document.getElementById("desc").value = " ";

        // saveChanges();

        // $('.modal').modal('hide');
        // showModal(<?php #echo $project_id 
                        ?>, <?php #echo $city_id 
                            ?>)
        // $('#editModal').modal('show');

    }

    function updateSaveArrays(resource_id, field_name) {
        field_value = $("#" + field_name + "_" + resource_id).val();
        if (typeof(resourcesChanges[resource_id]) === 'object') {
            resourcesChanges[resource_id][field_name] = field_value;
        } else {
            resourcesChanges[resource_id] = {};
            resourcesChanges[resource_id][field_name] = field_value;
        }
        resourcesChanges[resource_id]['id'] = resource_id;
        // console.log(resourcesChanges);

    }

    function saveChanges() {
        // console.log(resourcesChanges);
        postdata = {
            cityChanges: cityChanges,
            resourcesChanges: resourcesChanges,
            createdResources: createdResources,
            createdCities: createdCities,
            '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
        };
        console.log(postdata);

        $.ajax({
            url: "/manage/applychanges",
            data: postdata,
            type: "POST",
            // dataType: 'json',
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(resp) {
                // nextThingToDo(resp); // deal with data returned
                console.log(resp);
            }
        });

        cityChanges = {};
        resourcesChanges = {};
        createdResources = [];
        createdCities = {};
    }
</script>