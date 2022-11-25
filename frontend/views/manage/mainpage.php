<?php
if(isset($result['projects']))
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
                        <h4>Аккаунтов: <strong><?= $project['cities'] ?></strong></h4>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 p-sm">
                <button class="btn btn-danger">Отключить проект</button>
            </div>
        </div>
    </div>

    <script>
        
    </script>
<?php }

?>