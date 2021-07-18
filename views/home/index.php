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
            <a href="<?= URL ?>panel/close"><i class="fas fa-sign-out-alt"></i><div class="close">Cerrar Sesion</div></a>
        </div>
    </div>

    <div class="users-site">
        <div class="users-container">
            <h1>Usuarios registrados</h1>
            
            <div class="users-container-table">
                <table class="table table-hover table-dark" >
                    <tr>
                        
                        <th>Avatar</th>
                        <th>USUARIO</th>
                        <th>NOMBRE</th>
                    </tr>
                    <?php
                    foreach ($this->allUsers as $user) {
                    ?>

                        <tr>
                            <td><img class="avatar-another-user" src="<?= URL ?>resource/img/avatar/<?= $user["person_avatar"] ?>" alt=""></td>
                            <td><?= $user["user_name"]; ?></td>
                            <td><?= $user["person_name"]; ?></td>
                            
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