<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE ROLES
    </h3>
    <p class="text-justify">
        vista dedicada a visualizar los roles actuales en el sistema
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR ROL</a>
        </li>
        <li>
            <a class="active" href="client-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                ROLES</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>ID ROL</th>
                    <th>NOMBRE ROL</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $rol) : ?>
                <tr class="text-center">
                    <td><?php echo $rol->get_id_rol(); ?></td>
                    <td><?php echo $rol->get_name(); ?></td>
                    <td>
                        <a href="?c=Roles&a=update_rol&id_rol=<?php echo $rol->get_id_rol(); ?>"
                            class="btn btn-success">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <!-- Botón de eliminación con SweetAlert -->
                        <a href="javascript:void(0);" class="btn btn-danger"
                            onclick="confirmDelete('<?php echo $rol->get_id_rol(); ?>')">
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
    function confirmDelete(id_rol) {
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
                        window.location.href = '?c=Roles&a=delete_rol&id_rol=' + id_rol;
                    }
                });
            }
        });
    }
</script>