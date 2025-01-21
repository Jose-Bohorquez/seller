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

<!-- incluimos sweet alert2 -->
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Content here -->
<div class="container-fluid">
    <div class="table-responsive">
        <table id="usersTable" class="table table-dark table-sm fs-6">
            <thead>
                <tr class="text-center roboto-medium">
                    <th class="w-10">ID USUARIO</th>
                    <th class="w-15">NOMBRES</th>
                    <th class="w-15">APELLIDOS</th>
                    <th class="w-15">N&deg; DOCUMENTO</th>
                    <th class="w-10">TEL&Eacute;FONO</th>
                    <th class="w-20">CORREO</th>
                    <th class="w-15">CONTRASE&Ntilde;A</th>
                    <th class="w-10">ROL</th>
                    <th class="w-10">ACTUALIZAR</th>
                    <th class="w-10">ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users_all as $user): ?>
                <tr class="text-center">
                    <td class="text-truncate"><?php echo $user->get_id_user(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_name_user(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_lastname(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_id_number(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_cel(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_email(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_pass(); ?></td>
                    <td class="text-truncate"><?php echo $user->get_rol(); ?></td>
                    <td>
                        <a href="?c=Users&a=update_user&id_user=<?php echo $user->get_id_user(); ?>" class="btn btn-success btn-sm">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="confirmDelete(<?php echo $user->get_id_user(); ?>)">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>


                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(userId) {
        // Primera confirmación
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción eliminará al usuario permanentemente.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Segunda confirmación
                Swal.fire({
                    title: 'Confirmación final',
                    text: "¿Realmente deseas eliminar este usuario?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar definitivamente',
                    cancelButtonText: 'No, cancelar'
                }).then((finalResult) => {
                    if (finalResult.isConfirmed) {
                        // Redirigir al controlador para eliminar el usuario
                        window.location.href = `?c=Users&a=delete_user&id_user=${userId}`;
                    }
                });
            }
        });
    }
</script>

