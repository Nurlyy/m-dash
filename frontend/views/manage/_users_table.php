<div class="ibox ">
    <div class="ibox-title text-center" style="padding-right:15px !important;">
        <h5>Список всех пользователей</h5>
    </div>
    <div class="ibox-content">

        <table class="footable table table-stripped toggle-arrow-tiny">
            <thead>
                <tr>

                    <th data-toggle="true">Проект</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Доступ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($users as $user) { ?>
                    <tr id="tr-<?= $user['id'] ?>">
                        <td>
                            <div class="<?= isset($user['name']) ? "navy" : "red" ?>-bg text-center" style="border-radius:15px;">
                                <a <?= isset($user['name']) ? "onclick='openurl(\"manage\", \"editpage?project_id={$user['pid']}\")'" : "" ?>><?= isset($user['name']) ? $user['name'] : "Нет" ?></a>
                            </div>
                        </td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><i id="status-<?= $user['id'] ?>" class="fa fa-<?= ($user['status'] < 10) ? "close text-danger" : "check  text-navy" ?>"></i>
                            <a><?= ($user['status'] < 10) ? "
                                <button id='div-" . $user['id'] . "' type='button' class='btn btn-primary' 
                                onclick='changestatus(" . $user['id'] . ")' 
                                style='margin-left:15px'>+</button>"
                                    : "<h6 style='display:none'>a</h6>
                                <button id='div-" . $user['id'] . "' type='button' class='btn btn-" . (isset($user['name']) ? "default'" : "danger' onclick='changestatus({$user['id']})'") . "
                                style='margin-left:15px'> - </button>" ?></a>
                        </td>
                        <td><a onclick="showDeleteUserModal(<?= $user['id'] ?>, '<?= $user['username'] ?>', <?= isset($user['name']) ? 'true' : 'false' ?>)"><i class="fa fa-trash text-<?= isset($user['name']) ? "danger" : "navy" ?>"></i></a></td>
                    </tr>
                <?php }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="footable visible">
                        <div class="row justify-content-between m-3">
                            <div type='button' class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">Создать нового пользователя</div>
                            <ul class="pagination float-right"></ul>
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
        <!-- <div class="btn btn-primary" type="button"><i class="fa fa-plus text-navy"></i>Добавить нового пользователя</div> -->
    </div>
</div>

<script>
    userid = null;
    users = <?= json_encode($users) ?>;
    temp = {};
    users.forEach(user => {
        temp[user['id']] = user;
    });
    users = temp;


    function showDeleteUserModal(id, name, project) {

        if (project == false) {
            userid = id;

            $("#deleteUserModalParagraph").text("Вы точно хотите удалить пользователя \"" + name + "\"? \n Ваше действие будет невозможно отменить.");
            $("#deleteUserModal").modal('show');
        }
    }

    function deleteuser(id) {
        $.ajax({
            url: '/manage/deleteuser',
            type: "POST",
            data: {
                'id': id,
                "<?= Yii::$app->request->csrfParam ?>": "<?= Yii::$app->request->csrfToken ?>"
            },
            error: function(xhr, tStatus, e) {
                if (!xhr) {
                    alert(" We have an error ");
                    alert(tStatus + "   " + e.message);
                } else {
                    console.log("else: " + e.message); // the great unknown
                }
            },
            success: function(data) {
                console.log(data);
                $("#tr-" + id).remove();
            }
        })
    }

    function changestatus(id) {
        status = users[id].status;
        temp = null;
        if (users[id].name == null) {
            $.ajax({
                url: '/manage/changestatus',
                type: "POST",
                data: {
                    'id': id,
                    "<?= Yii::$app->request->csrfParam ?>": "<?= Yii::$app->request->csrfToken ?>"
                },
                error: function(xhr, tStatus, e) {
                    if (!xhr) {
                        alert(" We have an error ");
                        alert(tStatus + "   " + e.message);
                    } else {
                        console.log("else: " + e.message);
                    }
                },
                success: function(data) {
                    console.log(data);
                    if (status == 9) {
                        $("#status-" + id).removeClass();
                        $("#status-" + id).addClass('fa fa-check text-navy');
                        $("#div-" + id).removeClass();
                        $("#div-" + id).addClass("btn btn-danger");
                        $("#div-" + id).text("-");
                        temp = 10;
                    } else if (status == 10) {
                        $("#status-" + id).removeClass();
                        $("#status-" + id).addClass('fa fa-close text-danger');
                        $("#div-" + id).removeClass();
                        $("#div-" + id).addClass("btn btn-primary");
                        $("#div-" + id).text("+");
                        temp = 9;
                    }
                    users[id].status = temp;
                }
            })
        }
    }
</script>