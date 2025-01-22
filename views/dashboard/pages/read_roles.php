<!-- SweetAlert2 CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> -->

<!-- SweetAlert2 JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fab fa-dashcube fa-fw"></i> &nbsp; Listado de roles
    </h3>
    <p class="text-justify">
        Aquí podrás crear, editar, actualizar o eliminar los roles del sistema.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Roles&a=create_rol"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR ROL</a>
        </li>
    </ul>
</div>



<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th>EDITAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
<?php foreach ($roles as $rol ) : ?>
    <tr>
        <td><?php echo $rol -> get_id_rol(); ?></td>
        <td><?php echo $rol -> get_name_rol(); ?></td>
    </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
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

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `Vas a eliminar el rol "${roleName}". Esta acción no se puede deshacer.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `?c=Roles&a=delete_rol&id=${roleId}`;
                    }
                });
            });
        });
    });
</script>
