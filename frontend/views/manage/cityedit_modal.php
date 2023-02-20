<?php
if (!empty($result['project']['cities'][$city_id]['resources'])) {
    foreach ($result['project']['cities'][$city_id]['resources'] as $resource) { ?>
        <div class="btn btn-default collapsible col-12" id="col-id-<?= $resource['id'] ?>" style="margin-bottom:15px;"><?= ($resource['name']) ? $resource['name'] : $resource['url'] ?></div>
        <div id="collapsible-content" class="panel-body colcontent-id-<?= $resource['id'] ?>" style="margin-top:-30px;">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h3>Название ресурса:</h3>
                    <input type="text" id="name_<?= $resource['id'] ?>" onchange="updateSaveArrays(<?= $resource['id'] ?>, 'name')" class="form-control" value="<?= $resource['name'] ?>" /><br>
                    <h3>Ссылка ресурса:</h3>
                    <input type="text" id="url_<?= $resource['id'] ?>" onchange="updateSaveArrays(<?= $resource['id'] ?>, 'url', this.field_value )" class="form-control" value="<?= $resource['url'] ?>" /><br>
                    <h3>Изображение ресурса:</h3>
                    <input type="text" id="photo_<?= $resource['id'] ?>" onchange="updateSaveArrays(<?= $resource['id'] ?>, 'photo', this.field_value )" class="form-control" value="<?= $resource['photo'] ?>" /><br>
                    <h3>Описание ресурса:</h3>
                    <input type="text" id="description_<?= $resource['id'] ?>" onchange="updateSaveArrays(<?= $resource['id'] ?>, 'description', this.field_value )" class="form-control" value="<?= $resource['description'] ?>" /><br>
                    <button type="button" style="margin-right:15px;" class="btn btn-danger" onclick="showDeleteResModal('id', <?= $resource['id'] ?>, '<?= ($resource['name']) ? $resource['name'] : $resource['url'] ?>')" data-toggle="modal" data-target="#deleteResModal">Удалить ресурс</button>
                    <button type="button" class="btn btn-warning" onclick="showMoveResModal('id', <?= $resource['id'] ?>)" data-toggle="modal" data-target="#moveResModal">Перенести ресурс</button>
                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <h3 style="padding:20px; font-style:normal;">Список пуст</h3>
<?php } ?>