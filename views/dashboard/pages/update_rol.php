<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; ACTUALIZAR ROL
    </h3>
    <p class="text-justify">
        Desde esta vista se pueden editar los roles
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR ROL</a>
        </li>
        <li>
            <a href="?c=Roles&a=read_rol"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ROLES</a>
        </li>
        <li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <form action="?c=Roles&a=update_rol" method="POST" class="form-neon" autocomplete="off">
        <fieldset>
            <legend><i class="fas fa-user"></i> &nbsp; Actualizar Rol</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <!-- ID oculto -->
                        <input name="id_rol" value="<?php echo $rol->get_id_rol(); ?>" type="hidden">

                        <div class="form-group">
                            <label for="name_rol_up" class="bmd-label-floating">Ingrese el Nombre para el rol</label>
                            <!-- Nombre del rol -->
                            <input 
                                name="name_rol_up" 
                                value="<?php echo $rol->get_name(); ?>" 
                                type="text"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}" 
                                class="form-control" 
                                id="name_rol_up" 
                                maxlength="40">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ACTUALIZAR ROL</button>
        </p>
    </form>
</div>
