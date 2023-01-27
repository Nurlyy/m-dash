<div class="modal inmodal" id="deleteUserModal" style="z-index: 2060 !important;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Вы уверены?</h4>
            </div>
            <div class="modal-body">
                <p id="deleteUserModalParagraph"></p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="deleteuser(userid)" class="btn btn-white" data-dismiss="modal">Да</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Нет</button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal fade" id="createUserModal" style="overflow-y:auto !important; overflow-x: hidden;" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="overflow-y:auto !important; overflow-x: hidden;">
        <div class="modal-content" style="overflow-y:auto !important; overflow-x: hidden;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title text-center">Создание нового пользователя</h4><br>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 justify-content-center">
                        <div class="panel panel-default" style="background-color:azure; ">
                            <div class="panel-body" style="text-align: center;">
                                <h3>Имя пользователя:</h3>
                                <input required="true" id="username" type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" /><br>
                                <h3>Email:</h3>
                                <input required="true" id="email" type="text" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" /><br>
                                <h3>Пароль:</h3>
                                <input required="true" id="password" type="password" class="form-control" style="width: 300px; margin-left: auto; margin-right: auto;" /><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>
                        <button type="button" id="btncreateuser" class="btn btn-primary">Создать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12" id="_users_table"></div>

<script>
    getTable();

    function getTable() {
        $.ajax({
            url: "/manage/users-table",
            method: "GET",
            success: function(data) {
                $("#_users_table").html(data);
            }
        });
    }

    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

        $("#btncreateuser").on("click", function() {
            username = $("#username").val();
            email = $("#email").val();
            password = $("#password").val();
            if (username !== null && username !== '' && email !== null && email !== '' && password !== null && password !== '') {
                $.ajax({
                    url: '/manage/createuser',
                    type: "POST",
                    data: {
                        username: username,
                        email: email,
                        password: password,
                        '<?= Yii::$app->request->csrfParam ?>': "<?= Yii::$app->request->csrfToken ?>"
                    },
                    success: function(data) {
                        console.log(data);
                        $("#createUserModal").modal('hide');
                        $("#username").val("");
                        $("#email").val("");
                        $("#password").val("");
                        toastr.success(`Аккаунт пользователя "${username}" успешно создан`, '')
                        getTable();
                    },
                    error: function(xhr, tStatus, e) {
                        if (!xhr) {
                            alert(" We have an error ");
                            alert(tStatus + "   " + e.message);
                        } else {
                            console.log("else: " + e.message); // the great unknown
                        }
                    }
                })
            }
        })
    });
</script>