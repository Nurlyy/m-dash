<?php

// foreach($cities as $city){
    // var_dump($city);
// }
// exit;
if (!empty($cities)) {
    foreach ($cities as $city) { ?>
        <div class="panel-body" id="project-<?= $city['id'] ?>">
            <div class="city-container row text-center " style="margin:0px;">
                <h4 style="padding:0px; margin: 0px;" id="city_name_<?= $city['id'] ?>" class="col-4"><?= $city['name'] ?></h4>
                <p style="padding: 0px; margin: 0px;" class="col-4"><?= count($city['resources']) ?> источников </p>
                <div class="col-4 text-right">
                    <a href="" onclick="showModal(<?= $project_id ?>, <?= $city['id'] ?>); city_id=<?= $city['id'] ?>" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" style="margin-right:10px; font-size:medium;" aria-hidden="true"></i></a>
                    <a href="" onclick="showDeleteCityModal(<?= $city['id'] ?>)" data-toggle="modal" data-target="#deleteCityModal"><i class="fa fa-trash" style="font-size:medium;" aria-hidden="true"></i></a>
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
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal inmodal fade" id="editModal" style="overflow-y:auto !important; overflow-x: hidden;" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="overflow-y:auto !important; overflow-x: hidden;">
                <div class="modal-content" style="overflow-y:auto !important; overflow-x: hidden;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title text-center">Редактирование города</h4><br>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveChanges()">Сохранить</button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 justify-content-center">
                                <div class="panel panel-default" style="background-color:azure; ">
                                    <div class="panel-body" style="text-align: center;">
                                        <h3>Название:</h3>
                                        <input id="cityname" onchange="cityNameChange()" type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" /><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="panel panel-primary" style="background-color:azure; ">
                                    <div class="panel-header">
                                        <h2 class='text-center'><strong>Список источников города</strong></h2>
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

        <div class="modal inmodal" id="moveResModal" style="overflow-y:auto !important; overflow-x: hidden; z-index:2500 !important; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 id="moveResModalTitle" class="modal-title text-center"></h4><br>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 justify-content-center">
                                <div class="panel panel-default" style="background-color:azure; ">
                                    <div class="panel-body" style="text-align: center;">
                                        <h3>Выберите регион:</h3>
                                        <select onchange="regionchange()" name="newregion" id="newregion">

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="saveMove()">Сохранить</button>
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