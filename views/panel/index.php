<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="updateCurrentUser" tabindex="-1" aria-labelledby="updateCurrentUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCurrentUser">Actualizar datos propios</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-1" method="POST" action="<?= URL ?>panel/update/<?= $this->currentUser["id"] ?>" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="<?= URL ?>resource/img/avatar/<?= $this->currentPerson["person_avatar"] ?>" class="avatar-display" alt="...">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <input type="file" name="personAvatar" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="inputEmail4" value="<?= $this->currentUser["user_name"] ?>" name="nameUser">
                    </div>
                    <div class="col-md-8">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" value="<?= $this->currentUser["user_email"] ?>" name="emailUser">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="firstPassCurrentU" placeholder="Digite nueva clave" name="passwordUser">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Repita contraseña</label>
                        <input type="password" class="form-control" id="confirmedPassCurrentU" placeholder="Confirme clave">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputAddress" value="<?= $this->currentPerson["person_name"] ?>" name="personName">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="inputAddress2" value="<?= $this->currentPerson["person_lastname"] ?>" name="personLastname">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="actionButton btn btn-primary form-control" disabled>Guardar cambios</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>


<!-- MODAL AGREGAR USUARIO-->
<div class="modal fade" id="addNewUser" tabindex="-1" aria-labelledby="addNewUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewUser">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-1" method="POST" action="<?= URL ?>user/addUser" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img src="<?= URL ?>resource/img/avatar/default.png" class="avatar-display" alt="...">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <input type="file" required name="personAvatar" class="form-control" id="inputEmail4">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Usuario</label>
                        <input type="text" required class="form-control" id="inputEmail4" placeholder="user" name="nameUser">
                    </div>
                    <div class="col-md-8">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="email@example" required name="emailUser">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="firstPassAnotherU" placeholder="Digite clave" required name="passwordUser">
                    </div>
                    <div class="col-md-6">
                        <label for="inputPassword4" class="form-label">Repita contraseña</label>
                        <input type="password" required class="form-control " id="confirmedPassAnotherU" placeholder="Confirme clave">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="inputAddress" placeholder="Nombre personal" required name="personName">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="inputAddress2" placeholder="Apellidos" required name="personLastname">
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">Rol del usuario</label>
                        <select name="userRole" class="form-select" aria-label="Default select example">
                            <option selected value="2">Usuario por defecto</option>
                            <option value="1">Administrador</option>


                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary form-control actionButton" disabled>Agregar</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>

<!-- MODAL UPDATE ANOTHER USER-->
<div class="modal fade" id="updateAnotherUser" tabindex="-1" aria-labelledby="updateAnotherUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAnotherUser">Actualizar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-1" id="formUpdateUser" method="POST" action="<?= URL ?>user/editUser" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="text-center">
                            <img id="imgAnotherUser" src="<?= URL ?>resource/img/avatar/default.jpeg" class="avatar-display" alt="...">
                        </div>
                    </div>
                    <div class="col-md-12">

                        <input type="file" name="personAvatar" class="form-control" id="">
                    </div>
                    <div class="col-md-4">
                        <label for="" class="form-label">Usuario</label>
                        <input type="text" required class="form-control" id="nameUser" placeholder="user" name="nameUser">
                    </div>
                    <div class="col-md-8">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailUser" placeholder="email@example" required name="emailUser">
                    </div>

                    <div class="col-12">
                        <label for="inputAddress" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="personName" placeholder="Nombre personal" required name="personName">
                    </div>
                    <div class="col-12">
                        <label for="inputAddress2" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="personLastname" placeholder="Apellidos" required name="personLastname">
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">Rol del usuario</label>
                        <select name="userRole" class="form-select" aria-label="Default select example">
                            <option selected value="2">Usuario por defecto</option>
                            <option value="1">Administrador</option>


                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary form-control">Actualizar</button>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div>



<!-- MODAL DELETE USER -->
<div class="modal fade" id="deleteModalUser" tabindex="-1" aria-labelledby="deleteModalUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalUser">ADVERTENCIA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDeleteUser" method="POST">
                    <label for=""> <strong>¿Desea eliminar el registro?</strong></label>
                    <button type="submit" class="btn btn-danger">Si</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-----

    PERSONAL SITE

----->

<section class="section">
<div class="container-panel">
    <div class="personal-site">
        <div class="container-personal">
            <h1>Tu cuenta</h1>
            <div class="container-personal-data">
                <img class="personal-avatar" src="<?= URL ?>resource/img/avatar/<?= $this->currentPerson["person_avatar"] ?>" alt="">
                <h4>Bienvenido <?= $this->currentUser["user_name"] ?></h4>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateCurrentUser">
                <i class="fas fa-user-edit"></i>
                </button>
                
            </div>
            <a href="<?= URL ?>panel/close"><i class="fas fa-sign-out-alt"></i><div class="close">Cerrar sesion</div></a>
        </div>
    </div>

    <div class="users-site">
        <div class="users-container">
            <h1>Lista de usuarios</h1>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewUser">
                    Nuevo Usuario
                </button>
                

            </div>
            <div class="users-container-table">
                <table class="table table-hover table-dark" >
                    <tr>
                        <th>CODIGO</th>
                        <th>Avatar</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($this->allUsers as $user) {
                    ?>

                        <tr>
                            <td><?= $user["id"]; ?></td>
                            <td><img class="avatar-another-user" src="<?= URL ?>resource/img/avatar/<?= $user["person_avatar"] ?>" alt=""></td>
                            <td><?= $user["user_name"]; ?></td>
                            <td><?= $user["person_name"]; ?></td>
                            <td><?= $user["person_lastname"]; ?></td>
                            <td><a href="<?= URL ?>user/getUser/<?= $user["id"] ?>" class="updateButton btn btn-success">Editar</a>
                            </td>
                            <td><a href="<?= URL ?>user/deleteUser/<?= $user["id"] ?>" class="deleteButton btn btn-danger">Eliminar</a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </div>
</div>
</section>

<!----


    DASHBOARD SITE


----->







<script>
    $(document).ready(function() {

        // FUNCTION DELETE BUTTON
        $(".deleteButton").click(function(e) {
            var href = $(this).attr("href");
            var form = $("#formDeleteUser");
            form.attr("action", href);
            e.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('deleteModalUser'), {
                keyboard: false
            })
            myModal.show();
        });

        //FUNCTION UPDATE BUTTON
        $(".updateButton").click(function(e) {
            var form = $("#formUpdateUser");
            var img = $("#imgAnotherUser");
            var nameUser = $("#nameUser");
            var emailUser = $("#emailUser");
            var personName = $("#personName");
            var personLastname = $("#personLastname");
            var href = $(this).attr("href");
            e.preventDefault();
            var myModal = new bootstrap.Modal(document.getElementById('updateAnotherUser'), {
                keyboard: false
            })
            //REQUEST FOR USER DATA
            $.ajax({
                type: "POST",
                url: href,
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    form.attr("action", `<?= URL ?>user/editUser/${jsonData["id"]}`);
                    img.attr("src", `<?= URL ?>resource/img/avatar/${jsonData["person_avatar"]}`);
                    nameUser.val(jsonData["user_name"]);
                    emailUser.val(jsonData["user_email"]);
                    nameUser.val(jsonData["user_name"]);
                    personName.val(jsonData["person_name"]);
                    personLastname.val(jsonData["person_lastname"]);

                }
            });

            myModal.show();
        });

        $("#confirmedPassCurrentU").on("keyup", function() {
            var firstPass = $("#firstPassCurrentU").val();
            var confirmedPass = $(this).val();
            comparePasswords(firstPass, confirmedPass, $("#confirmedPassCurrentU"));
        });
        $("#firstPassCurrentU").on("keyup", function() {
            var firstPass = $(this).val();
            var confirmedPass = $("#confirmedPassCurrentU").val();
            comparePasswords(firstPass, confirmedPass, $("#confirmedPassCurrentU"));
        });

        $("#confirmedPassAnotherU").on("keyup", function() {
            var firstPass = $("#firstPassAnotherU").val();
            var confirmedPass = $(this).val();
            comparePasswords(firstPass, confirmedPass, $("#confirmedPassAnotherU"));
        });
        $("#firstPassAnotherU").on("keyup", function() {
            var firstPass = $(this).val();
            var confirmedPass = $("#confirmedPassAnotherU").val();
            comparePasswords(firstPass, confirmedPass, $("#confirmedPassAnotherU"));
        });

        function comparePasswords(val1, val2, input) {
            if (val1 != '' && val2 != '') {
                if (val1 != val2) {
                    input.addClass("form-control is-invalid");
                    $(".actionButton").prop("disabled", true);
                } else {
                    input.removeClass("is-invalid");
                    $(".actionButton").prop("disabled", false);
                }
            }
        }

    });
</script>