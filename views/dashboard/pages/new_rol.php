<!-- Page header -->
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ROL
	</h3>
	<p class="text-justify">
		Desde esta vista se pueden crear, leer, editar y eliminar roles
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="client-new.html"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ROL</a>
		</li>
		<li>
			<a href="?c=Roles&a=read_rol"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ROLES</a>
		</li>
	</ul>
</div>

<!-- Content here-->
<div class="container-fluid">
	<form action="?c=Roles&a=create_rol" method="POST" class="form-neon">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Crear Rol</legend>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-12">
						<div class="form-group">
							<label for="cliente_nombre" class="bmd-label-floating">Ingrese el Nombre para el rol</label>
							<input name="rol_name" type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,40}"
								class="form-control" name="cliente_nombre_reg" id="cliente_nombre" maxlength="40"
								autofocus>
						</div>
					</div>
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp;
				LIMPIAR / BORRAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp;
				CREAR</button>
		</p>
	</form>
</div>