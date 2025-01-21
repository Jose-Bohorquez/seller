<!-- Page header -->
<div class="full-box page-header">
	<h3 class="text-left">
		<i class="fas fa-plus fa-fw"></i> &nbsp; CREAR ROL
	</h3>
	<p class="text-justify">
		Desde esta vista se pueden crear un nuevo rol
	</p>
</div>

<div class="container-fluid">
	<ul class="full-box list-unstyled page-nav-tabs">
		<li>
			<a class="active" href="client-new.html"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR ROL</a>
		</li>
		<li>
			<a href="?c=Roles&a=read_rol"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ROLES</a>
		</li>
	</ul>
</div>


<!-- Content here-->
<div class="container-fluid">
		<form action="?c=Roles&a=create_rol" method="POST" class="form-neon" autocomplete="off">
		<fieldset>
			<legend><i class="fas fa-user"></i> &nbsp; Información básica</legend>
			<div class="container-fluid">
				<div class="row">

					<div class="col">
						<div class="form-group">
							<label for="create_new_rol" class="bmd-label-floating">Nombre para el nuevo rol</label>
							<input 
								type="text" 
								pattern="[a-zA-Z\-]{1,40}" 
								class="form-control"
								name="create_new_rol" 
								id="create_new_rol" 
								maxlength="40">

						</div>
					</div>
				
				</div>
			</div>
		</fieldset>
		<br><br><br>
		<p class="text-center" style="margin-top: 40px;">
			<button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp;
				LIMPIAR</button>
			&nbsp; &nbsp;
			<button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp;
				CREAR ROL</button>
		</p>
	</form>
</div>