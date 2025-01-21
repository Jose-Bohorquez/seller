<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; Listado de roles
    </h3>
    <p class="text-justify">
        aqui podras Crear , Editar, Actualizar o Eliminar los roles del sistema
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR ROL </a>
        </li>
    </ul>
</div>

 <!-- incluimos las dependencias: -->
 <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Content here-->
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th colspan="2">ACCIONES EDITAR / ELIMINAR</th>
                </tr>
            </thead>
            <tbody>


<?php foreach ($roles as $rol ) : ?>

    <tr class="text-center">
        <td> <?php echo $rol -> get_id_rol() ; ?> </td>
        <td> <?php echo $rol -> get_name_rol() ; ?> </td>
        <td>
            <a href="?c=Roles&a=update_rol&id=<?php echo $rol -> get_id_rol() ; ?> " class="btn btn-success">
                <i class="fas fa-sync-alt"></i>
            </a>
        </td>
        <td>
            <button 
                class="btn btn-warning delete-btn" 
                data-id="<?php echo $rol->get_id_rol(); ?>" 
                data-name="<?php echo $rol->get_name_rol(); ?>">
                <i class="far fa-trash-alt"></i>
            </button>
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
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const roleId = this.dataset.id;
                const roleName = this.dataset.name;

                // Primera confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `Vas a eliminar el rol "${roleName}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, estoy seguro',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Segunda confirmación
                        Swal.fire({
                            title: 'Confirmación final',
                            text: '¿Realmente deseas eliminar este rol?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'No, cancelar'
                        }).then((finalResult) => {
                            if (finalResult.isConfirmed) {
                                // Redirigir a la acción de eliminar
                                window.location.href = `?c=Roles&a=delete_rol&id=${roleId}`;
                            }
                        });
                    }
                });
            });
        });
    });
</script>
