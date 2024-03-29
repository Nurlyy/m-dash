<?php
$city_id = null;
$res_name = "";
$res_id = null;
$this->registerCssFile("css/plugins/toastr/toastr.min.css");
$this->registerJsFile("js/plugins/toastr/toastr.min.js");



?>
<div class="col-12 text-center">
    <div class="panel panel-default">
        <div class="panel-header">
            <h2 class='text-center'><strong>Изменить проект</strong></h2>
        </div>
        <div class="panel-body">

            <div class="modal inmodal delresmodal" id="deleteCityModal" style="z-index: 2060 !important;" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated flipInY">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Вы уверены?</h4>
                        </div>
                        <div class="modal-body">
                            <p id="deleteCityModalParagraph"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="deletecity(city_id)" class="btn btn-white" data-dismiss="modal">Да</button>
                            <!-- <form action="/manage/deleteresource" method="POST"><input type="hidden" name="res_id" value="<?= $res_id ?>"><input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" /><input type="submit" value="Да" class="btn btn-white" /></form> -->
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 justify-content-center">
                    <div class="panel panel-default">
                        <div class="panel-body" style="text-align: center;">
                            <h3>Название:</h3>
                            <input id="projectname" type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" value="<?= $result['project']['name'] ?>" /><br>
                            <h3>Владелец:</h3>
                            <select name="owner" id="owner">
                                <option value="<?= $result['project']['user_id'] ?>"><?= $result['project']['username'] ?></option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?= $user['id'] ?>"><?= $user['username'] ?></option>
                                <?php } ?>
                            </select><br><br><br>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveProjectChanges()">Сохранить</button>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <div id="cityModal">
                        <div class="modal inmodal fade" id="createCityModal" style="overflow-y:auto !important; overflow-x: hidden;" aria-hidden="true">
                            <div class="modal-dialog modal-lg" style="overflow-y:auto !important; overflow-x: hidden;">
                                <div class="modal-content" style="overflow-y:auto !important; overflow-x: hidden;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title text-center">Добавление города</h4><br>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="createCity()">Сохранить</button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">
                                            <div class="col-12 justify-content-center">
                                                <div class="panel panel-default" style="background-color:azure; ">
                                                    <div class="panel-body" style="text-align: center;">
                                                        <h3>Название:</h3>
                                                        <input id="create_cityname" type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" /><br>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="createCity();">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-header">
                            <h2 class='text-center'><strong>Список добавленных регионов проекта</strong></h2>
                        </div>
                        <div class="panel-body" style="cursor:pointer;" data-toggle="modal" data-target="#createCityModal">
                            <div class="city-container row text-center bg-primary " style="margin:0px;">

                                <h4 class="col-12" style="text-align:center;"><i style="margin-right:15px;" class="fa fa-plus" aria-hidden="true"></i>Добавить</h4>
                            </div>
                        </div>
                        <div class="cities">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    createdResCounter = 0;
    restype = null;
    resid = null;
    changedName = null;
    createdCityCounter = 0;
    result = <?= json_encode($result) ?>;
    city_id = null;
    newregion = null;
    cities = null;

    function getCities() {
        $.ajax({
            url: '/manage/getcities?project_id=<?= $project_id ?>',
            method: "GET",
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(data) {
                $(".cities").html(data);
            }
        });
        $.ajax({
            url: "/manage/get-cities-list?project_id=<?= $project_id ?>",
            method: "GET",
            success: function(data) {
                cities = JSON.parse(data);
                temp = {};
                Object.entries(cities).forEach(([key, value]) => {
                    tempres = {};
                    if (value['resources'] !== 'undefined') {
                        Object.entries(value['resources']).forEach(([reskey, res]) => {
                            tempres[res['id']] = res;
                        });
                    }
                    value['resources'] = tempres;
                    temp[value['id']] = value;
                })
                cities = temp;
            },
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
        })
    }

    getCities();

    function regionchange() {
        newregion = $("#newregion").val();
        // console.log(resid);
        // console.log(newregion);
        if (city_id == newregion) {

            newregion = null;
        }
    }

    function showMoveResModal(type, res_id) {
        if (type == "id") {
            $("#newregion").html(`<option value="${city_id}" selected>${cities[city_id]['name']}</option>`);
            $("#moveResModalTitle").text(`Перенос источника "${cities[city_id]['resources'][res_id]['name']}" в другой регион проекта`);
            resid = res_id;
            // r = result['project']['cities']
            // console.log(resid);
            Object.entries(cities).forEach(([key, value]) => {
                if (Number(value['id']) != city_id) {
                    $("#newregion").append(`<option value="${value['id']}">${value['name']}</option>`)
                }
            })

        }
    }

    function saveMove() {
        if (newregion != null) {
            console.log(newregion);
            $.ajax({
                url: "/manage/moveresource",
                data: {
                    res_id: resid,
                    newregion: newregion,
                    '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
                },
                type: "POST",
                success: function(resp) {
                    console.log(resp);
                    $("#col-id-" + resid).remove();
                    $(".colcontent-id-" + resid).remove();
                }
            })
        }

    }


    function showDeleteCityModal(cityid) {
        city_name = cities[cityid]['name'];
        $("#deleteCityModalParagraph").text(`Вы точно хотите удалить город ${city_name}? Ваше действие нельзя будет отменить`);
        city_id = cityid
    }

    function deletecity(city_id) {
        $.ajax({
            url: "/manage/deletecity",
            data: {
                city_id: city_id,
                '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
            },
            type: "POST",
            success: function(resp) {
                getCities();
            }
        });
    }

    function createCity() {
        cname = $("#create_cityname").val();
        $.ajax({
            url: '/manage/create-city',
            type: "POST",
            data: {
                '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->csrfToken ?>',
                'project_id': <?= $project_id ?>,
                'city_name': cname
            },
            success: function() {
                getCities();
            },
        })
    }


    function cityNameChange() {
        changedName = $("#cityname").val();
        c = city_id;
        cityChanges[c] = {};
        cityChanges[c]['id'] = city_id;
        cityChanges[c]['name'] = changedName;
    }


    function showModal(project_id, city_id) {
        // city_name = $("#city_name_" + cityid).text();
        $("#cityname").val($("#city_name_" + city_id).text());
        $.ajax({
            url: "/manage/showmodal?project_id=" + project_id + "&city_id=" + city_id,
            method: "GET",

        }).done(function success(data) {
            data = `<div class="btn btn-primary collapsible col-12" style="margin-bottom:15px;"><i style="margin-right:15px;" class="fa fa-plus" aria-hidden="true"></i>Добавить новый источник</div>
                    <div id="collapsible-content" class="panel-body" style="display:none !important; margin-top:-30px;">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h3>Название источника:</h3>
                                <input type="text" id="name" class="form-control" /><br>
                                <h3>Ссылка источника:</h3>
                                <input type="text" id="url" class="form-control" /><br>
                                <h3>Изображение источника:</h3>
                                <input type="text" id="img" class="form-control" /><br>
                                <h3>Описание источника:</h3>
                                <input type="text" id="desc" class="form-control" /><br>
                                <button type="button" class="btn btn-primary" onclick="addnewres()">Добавить новый источник</button>
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
            // getCities();
        })
    }

    var cityChanges = {};
    var resourcesChanges = {};
    var createdResources = {};

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
        $("#deleteResModalParagraph").text("Вы точно хотите удалить источник \"" + resname + "\"? \n Ваше действие будет невозможно отменить.");

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
                success: function(resp) {}
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
        createdResources[createdResCounter]['city_id'] = city_id;

        $("#cities_container").append(
            `<div class="btn btn-primary collapsible col-12" id="col-count-${createdResCounter}" style="margin-bottom:15px;">${name}</div>
                    <div id="collapsible-content" class="panel-body colcontent-count-${createdResCounter}" style="display:none !important; margin-top:-30px;">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h3>Название источника:</h3>
                                <input type="text" id="name_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'name')" value="${name}" /><br>
                                <h3>Ссылка источника:</h3>
                                <input type="text" id="url_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'url')" value="${url}" /><br>
                                <h3>Изображение источника:</h3>
                                <input type="text" id="photo_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'photo')" value="${img}" /><br>
                                <h3>Описание источника:</h3>
                                <input type="text" id="description_added_${createdResCounter}" class="form-control" onchange="editAddedRes(${createdResCounter}, 'description')" value="${desc}" /><br>
                                <button type="button" class="btn btn-danger" onclick="showDeleteResModal('count', ${createdResCounter})" data-toggle="modal" data-target="#deleteResModal">Удалить источник</button>
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

    }

    function saveChanges() {
        postdata = {
            cityChanges: cityChanges,
            resourcesChanges: resourcesChanges,
            createdResources: createdResources,
            '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
        };

        $.ajax({
            url: "/manage/applychanges",
            data: postdata,
            type: "POST",
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(resp) {
                console.log(resp)
                cityChanges = {};
                resourcesChanges = {};
                createdResources = {};
                getCities();
                // window.location.reload();
            }
        });



    }

    function saveProjectChanges() {
        projectname = $("#projectname").val();
        owner = $("#owner").val();
        projectid = <?= $project_id ?>;

        $.ajax({
            url: "/manage/saveprojectchanges",
            data: {
                projectname: projectname,
                owner: owner,
                projectid: projectid,
                '<?= Yii::$app->request->csrfParam ?>': '<?= Yii::$app->request->getCsrfToken() ?>'
            },
            type: "POST",
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
                toastr.success(`Проект "${projectname}" успешно сохранен`, '')
                projectname = null;
                owner = null;
                projectid = null;
                // window.location.reload();
            }
        });
    }
</script>