<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE USUARIOS
    </h3>
    <p class="text-justify">
        vista dedicada a visualizar los usuario actuales en el sistema
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Users&a=create_user"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR USUARIO</a>
        </li>
        <li>
            <a class="active" href="?c=Users&a=read_user"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                USUARIOS</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>ID USUARIO</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>N° DOCUMENTO</th>
                    <th>TELEFONO</th>
                    <th>CORREO</th>
                    <th>CONTRASEÑA</th>
                    <th>ROL </th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users_all as $user) : ?>
                <tr class="text-center">
                    <td><?php echo $user->get_id_user(); ?></td>
                    <td><?php echo $user->get_name(); ?></td>
                    <td><?php echo $user->get_lastname(); ?></td>
                    <td><?php echo $user->get_id_number(); ?></td>
                    <td><?php echo $user->get_cel(); ?></td>
                    <td><?php echo $user->get_email(); ?></td> 
                    <td><?php echo $user->get_pass(); ?></td> 
                    <td><?php echo $user->get_rol(); ?></td> 
                    <td>
                        <a href="?c=Users&a=update_user&id_user=<?php echo $user->get_id_user(); ?>"
                            class="btn btn-success">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <!-- Botón de eliminación con SweetAlert -->
                        <a href="javascript:void(0);" class="btn btn-danger"
                            onclick="confirmDelete('<?php echo $user->get_id_user(); ?>')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>


                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

<script>
    function confirmDelete(id_user) {
        // Muestra un SweetAlert de confirmación inicial
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este cambio no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            // Si el usuario confirma la primera vez, pide una segunda confirmación
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡En serio?',
                    text: "¿Estás seguro de que deseas eliminar este rol?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, definitivamente',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((secondResult) => {
                    // Si el usuario confirma la segunda vez, redirige a la URL de eliminación
                    if (secondResult.isConfirmed) {
                        // Redirigir a la URL de eliminación
                        window.location.href = '?c=Users&a=delete_user&id_user=' + id_user;
                    }
                });
            }
        });
    }
</script>