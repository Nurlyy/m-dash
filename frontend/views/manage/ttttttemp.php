<?php $city_id = null; ?>
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
                                            <a href="" onclick="showModal(<?= $project_id?>, <?= $city['id'] ?>)<?php $city_id = $city['id'] ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" style="margin-right:10px; font-size:medium;" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-trash" style="font-size:medium;" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div id="cityModal">
                                <div class="modal inmodal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" id="cityeditmodal">
                                        
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

    function showModal(project_id, city_id){
        $.ajax({
            url: "/manage/showmodal?project_id="+project_id+"&city_id="+city_id,
            method: "GET",
            success: function(data){
                $("#cityeditmodal").html(data);
            }
        })
    }

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

    var cityChanges = {};
    var resourcesChanges = {};
    var createdResources = {};
    var createdCities = {};

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
            cityChanges : cityChanges,
            resourcesChanges: resourcesChanges,
            createdResources: createdResources,
            createdCities : createdCities,
            '<?=Yii::$app->request->csrfParam?>': '<?=Yii::$app->request->getCsrfToken()?>'};
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
                console.log("success");
                console.log(resp);
            }
        });
        cityChanges = {};
        resourcesChanges = {};
        createdResources = {};
        createdCities = {};
    }
</script>