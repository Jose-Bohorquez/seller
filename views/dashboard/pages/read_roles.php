<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS
    </h3>
    <p class="text-justify">
        Vista dedicada a visualizar los usuarios actuales en el sistema
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Users&a=create_user"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR USUARIO</a>
        </li>
        <li>
            <a class="active" href="?c=Users&a=read_user"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS</a>
        </li>
    </ul>
</div>

<!-- Content here -->
<div class="container-fluid">
    <div class="table-responsive">
        <table id="usersTable" class="table table-dark table-sm fs-6">
            <thead>
                <tr class="text-center roboto-medium">
                    <th class="w-10">ID ROL</th>
                    <th class="w-15">NOMBRE</th>
                    <th class="w-10">ACTUALIZAR</th>
                    <th class="w-10">ELIMINAR</th>
                </tr>
            </thead>


            <tbody>
    <?php foreach ($roles as $rol): ?>
        <?php if ($rol instanceof Rol): ?>
            <tr class="text-center">
                <td><?php echo $rol->get_id_rol(); ?></td>
                <td><?php echo $rol->get_name_rol(); ?></td>
                <td>
                    <a href="?c=Roles&a=update_rol&id_rol=<?php echo $rol->get_id_rol(); ?>" class="btn btn-success btn-sm">
                        <i class="fas fa-sync-alt"></i>
                    </a>
                </td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $rol->get_id_rol(); ?>)">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="4">Error: El elemento no es una instancia de la clase Rol.</td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</tbody>



        </table>
    </div>
</div>