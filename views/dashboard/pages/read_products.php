<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS
    </h3>
    <p class="text-justify">
        Vista dedicada a visualizar los productos actuales en el sistema
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Products&a=create_product"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR PRODUCTO</a>
        </li>
        <li>
            <a class="active" href="?c=Products&a=read_product"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
        </li>
    </ul>
</div>

<!-- Content here -->
<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-dark table-sm">
            <thead>
                <tr class="text-center roboto-medium">
                    <th>Nombre Producto</th>
                    <th>Descripción</th>
                    <th>Descripción Técnica</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Actualizar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                <tr class="text-center">
                    <td><?php echo $product->get_name(); ?></td>
                    <td>
                        <?php echo substr($product->get_description(), 0, 50) . (strlen($product->get_description()) > 50 ? '...' : ''); ?>
                    </td>
                    <td>
                        <?php echo substr($product->get_technical_description(), 0, 50) . (strlen($product->get_technical_description()) > 50 ? '...' : ''); ?>
                    </td>
                    <td><?php echo number_format($product->get_price() ?? 0, 2); ?></td>
                    <td><?php echo $product->get_amount(); ?></td>
                    <td><?php echo $product->get_category(); ?></td>
                    <td>
                        <?php if ($product->get_image()) : ?>
                        <img src="<?php echo $product->get_image(); ?>" alt="Imagen del Producto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        <?php else : ?>
                        <span>No disponible</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="?c=Products&a=update_product&id=<?php echo $product->get_id(); ?>" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete('<?php echo $product->get_id(); ?>')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Script -->
<script>
    function confirmDelete(id_product) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Este cambio no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '¡En serio?',
                    text: "¿Estás seguro de que deseas eliminar este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, definitivamente',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((secondResult) => {
                    if (secondResult.isConfirmed) {
                        window.location.href = '?c=Products&a=delete_product&id=' + id_product;
                    }
                });
            }
        });
    }
</script>
