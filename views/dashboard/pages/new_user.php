<!-- Page header -->
<div class="full-box page-header">
  <h3 class="text-left">
    <i class="fas fa-plus fa-fw"></i> &nbsp; CREAR USUARIO
  </h3>
  <p class="text-justify">
    Desde esta vista se puede crear un usuario
  </p>
</div>

<div class="container-fluid">
  <ul class="full-box list-unstyled page-nav-tabs">
    <li>
      <a class="active" href="?c=Users&a=create_user"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR USUARIO</a>
    </li>
    <li>
      <a href="?c=Users&a=read_user"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
    </li>
  </ul>  
</div>

<!-- Content here -->
<div class="container-fluid">
  <form action="?c=Users&a=create_user" method="POST" class="form-neon">
    <fieldset>
      <legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
      <div class="container-fluid">
        <div class="row">
          <!-- Campo Nombre -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_name" class="bmd-label-floating">Nombres</label>
              <input name="user_name" type="text" class="form-control" id="user_name" maxlength="40" required>
            </div>
          </div>
          
          <!-- Campo Apellido -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_lastname" class="bmd-label-floating">Apellidos</label>
              <input name="user_lastname" type="text" class="form-control" id="user_lastname" maxlength="40" required>
            </div>
          </div>
          
          <!-- Campo DNI -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_doc" class="bmd-label-floating">N° de documento</label>
              <input name="user_doc" type="text" class="form-control" id="user_doc" maxlength="27" required>
            </div>
          </div>
          
          <!-- Campo Teléfono -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_cel" class="bmd-label-floating">Teléfono</label>
              <input name="user_cel" type="text" class="form-control" id="user_cel" maxlength="20" required>
            </div>
          </div>
          
          <!-- Campo Correo -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_email" class="bmd-label-floating">Correo</label>
              <input name="user_email" type="text" class="form-control" id="user_email" maxlength="100" required>
            </div>
          </div>

          <!-- Campo Dominio -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_domain" class="bmd-label-floating">Dominio</label>
              <select name="user_domain" class="form-control" id="user_domain" required>
                <option value="">Seleccione un dominio</option>
                <option value="@servitel.cc">@servitel.cc</option>
                <option value="@servientrega.co">@servientrega.co</option>
                <option value="@global.com">@global.com</option>
              </select>
            </div>
          </div>

          <!-- Campo Contraseña -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_pass" class="bmd-label-floating">Contraseña</label>
              <input name="user_pass" type="password" class="form-control" id="user_pass" maxlength="150" required>
            </div>
          </div>

          <!-- Campo Rol -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="user_rol_reg" class="bmd-label-floating">Rol</label>
              <select name="user_rol_reg" class="form-control" id="user_rol_reg" required>
                <option value="">Seleccione un rol</option>
                <?php foreach ($roles as $rol) : ?>
                  <option value="<?php echo $rol->get_id_rol(); ?>"><?php echo $rol->get_name(); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
      </div>
    </fieldset>
    <br><br>
    <p class="text-center">
      <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR</button>
      &nbsp;&nbsp;
      <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; CREAR USUARIO</button>
    </p>
  </form>
</div>
