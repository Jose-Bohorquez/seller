<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE OFERTAS
    </h3>
    <p class="text-justify">
        Vista dedicada a visualizar las ofertas actuales en el sistema.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Offerts&a=create_offer"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR OFERTA</a>
        </li>
        <li>
            <a class="active" href="?c=Offerts&a=read_offers"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE OFERTAS</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Descuento</th>
                    <th>Plazo</th>
                    <th>Imagen</th>
                    <th>ACTUALIZAR</th>
                    <th>ELIMINAR</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($offers as $offer) : ?>
                <tr class="text-center">
                    <td><?php echo $offer->get_id(); ?></td>
                    <td><?php echo $offer->get_product_id(); ?></td>
                    <td><?php echo $offer->get_discount(); ?>%</td>
                    <td><?php echo $offer->get_term(); ?> días</td>
                    <td><img src="<?php echo $offer->get_image(); ?>" alt="Imagen de oferta" width="100"></td>
                    <td>
                        <a href="?c=Offerts&a=update_offer&id=<?php echo $offer->get_id(); ?>" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <!-- Botón de eliminación con SweetAlert -->
                        <a href="javascript:void(0);" class="btn btn-danger"
                            onclick="confirmDelete('<?php echo $offer->get_id(); ?>')">
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
    function confirmDelete(id_offer) {
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
                    text: "¿Estás seguro de que deseas eliminar esta oferta?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, definitivamente',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((secondResult) => {
                    // Si el usuario confirma la segunda vez, redirige a la URL de eliminación
                    if (secondResult.isConfirmed) {
                        // Redirigir a la URL de eliminación
                        window.location.href = '?c=Offerts&a=delete_offer&id=' + id_offer;
                    }
                });
            }
        });
    }
</script>
