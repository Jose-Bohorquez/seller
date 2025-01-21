<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR USUARIO
    </h3>
    <p class="text-justify">
        aqui podra Actualizar los datos del usuario
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Users&a=create_user" class="active"><i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR USUARIO</a>
        </li>
        <li>
            <a href="?c=Users&a=read_user"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <form action="?c=Users&a=update_user" method="POST" class="form-neon">
        <fieldset>
            <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
            <div class="container-fluid">
                <div class="row">
                    <!-- Campo oculto para el ID del usuario -->
                    <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($user->get_id_user()); ?>">

                    <!-- Campo Nombre -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_name" class="bmd-label-floating">Nombres</label>
                            <input value="<?php echo htmlspecialchars($user->get_name_user()); ?>" name="user_name" type="text" class="form-control" id="user_name" maxlength="40" required>
                        </div>
                    </div>

                    <!-- Campo Apellido -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_lastname" class="bmd-label-floating">Apellidos</label>
                            <input value="<?php echo htmlspecialchars($user->get_lastname()); ?>" name="user_lastname" type="text" class="form-control" id="user_lastname" maxlength="40" required>
                        </div>
                    </div>

                    <!-- Campo Documento -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_doc" class="bmd-label-floating">N° de documento</label>
                            <input value="<?php echo htmlspecialchars($user->get_id_number()); ?>" name="user_doc" type="text" class="form-control" id="user_doc" maxlength="27" required>
                        </div>
                    </div>

                    <!-- Campo Teléfono -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_cel" class="bmd-label-floating">Teléfono</label>
                            <input value="<?php echo htmlspecialchars($user->get_cel()); ?>" name="user_cel" type="text" class="form-control" id="user_cel" maxlength="20" required>
                        </div>
                    </div>

                    <!-- Campo Correo -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_email" class="bmd-label-floating">Correo</label>
                            <input value="<?php echo htmlspecialchars($user->get_email()); ?>" name="user_email" type="email" class="form-control" id="user_email" maxlength="100" required>
                        </div>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_pass" class="bmd-label-floating">Contraseña</label>
                            <input name="user_pass" type="password" class="form-control" id="user_pass" maxlength="150">
                            <small class="form-text text-muted">Deje este campo vacío si no desea cambiar la contraseña.</small>
                        </div>
                    </div>

                    <!-- Campo Rol -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="user_rol" class="bmd-label-floating">Rol</label>
                            <select name="user_rol" class="form-control" id="user_rol">
                                <option value="">Seleccione un rol</option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?php echo htmlspecialchars($rol->get_id_rol()); ?>" <?php echo $user->get_rol() == $rol->get_id_rol() ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($rol->get_name_rol()); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm">
                <i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR
            </button>
            &nbsp;&nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm">
                <i class="far fa-save"></i> &nbsp; ACTUALIZAR USUARIO
            </button>
        </p>
    </form>
</div>
