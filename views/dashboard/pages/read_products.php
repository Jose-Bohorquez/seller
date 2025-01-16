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
            <a class="active" href="client-list.html"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                PRODUCTOS</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
<!-- Filtro por Categoría (campo de búsqueda ajustado) -->
<div class="form-group row">
    <label for="categorySearch" class="col-md-2 col-form-label">Buscar por categoría</label>
    <div class="col-md-4">
        <input type="text" id="categorySearch" class="form-control form-control-sm" placeholder="Buscar categoría...">
    </div>
</div>

<!-- Filtro por Cantidad (campo de búsqueda ajustado) -->
<div class="form-group row">
    <label for="amountSearch" class="col-md-2 col-form-label">Buscar por cantidad</label>
    <div class="col-md-4">
        <input type="text" id="amountSearch" class="form-control form-control-sm" placeholder="Buscar cantidad...">
    </div>
</div>

</div>
<!-- Content here-->
<div class="container-fluid">
    <div class="table-responsive">
        <table id="productTable" class="table table-dark table-sm">
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
                        <!-- Muestra solo los primeros 50 caracteres de la descripción -->
                        <?php $short_description = substr($product->get_description(), 0, 50); ?>
                        <span data-toggle="tooltip" title="<?php echo $product->get_description(); ?>">
                            <?php echo $short_description . (strlen($product->get_description()) > 50 ? '...' : ''); ?>
                        </span>
                    </td>

                    <td>
                        <!-- Muestra solo los primeros 50 caracteres de la descripción técnica -->
                        <?php $short_description = substr($product->get_technical_description(), 0, 50); ?>
                        <span data-toggle="tooltip" title="<?php echo $product->get_technical_description(); ?>">
                            <?php echo $short_description . (strlen($product->get_technical_description()) > 50 ? '...' : ''); ?>
                        </span>
                    </td>

                    <td><?php echo number_format($product->get_price() ?? 0, 2); ?></td>
                    <td><?php echo $product->get_amount(); ?></td>
                    <td><?php echo $product->get_category(); ?></td>
                    <td>
                        <?php if ($product->get_image()) : ?>
                            <!-- Imagen en miniatura (tamaño ajustado) -->
                            <img src="<?php echo $product->get_image(); ?>" alt="Imagen del Producto" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                        <?php else : ?>
                            <!-- Icono o texto en caso de no tener imagen -->
                            <span>No disponible</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="?c=Products&a=update_product&id=<?php echo $product->get_id(); ?>" class="btn btn-success">
                            <i class="fas fa-sync-alt"></i>
                        </a>
                    </td>
                    <td>
                        <!-- Botón de eliminación con SweetAlert -->
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

<script type="text/javascript">
    $(document).ready(function() {
    // Inicializamos DataTables con 5 productos por página
    var table = $('#productTable').DataTable({
        "pageLength": 5, // Establecer 5 productos por página
        "language": {
            "lengthMenu": "Mostrar _MENU_ productos por página",
            "zeroRecords": "No se encontraron productos",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay productos disponibles",
            "infoFiltered": "(filtrado de _MAX_ productos en total)",
            "search": "Buscar: ",
            "paginate": {
                "previous": "Anterior",
                "next": "Siguiente"
            }
        }
    });

    // Aseguramos que el selector de cantidad de productos por página muestre la opción de "5"
    $('#productTable_length select').val('5'); // Establecer que por defecto se muestren 5 productos por página.

    // Función para buscar por categoría (campo de texto)
    $('#categorySearch').on('keyup', function() {
        var category = $(this).val(); // Obtener el texto del input
        table.column(5).search(category).draw(); // Filtrar por la columna de categoría
    });

    // Función para buscar por cantidad (campo de texto)
    $('#amountSearch').on('keyup', function() {
        var amount = $(this).val(); // Obtener el texto del input
        table.column(4).search(amount).draw(); // Filtrar por la columna de cantidad
    });

    // Mejoramos la responsividad del select de cantidad de productos por página
    $('select[name="productTable_length"]').addClass('form-control form-control-sm'); // Aplicar tamaño pequeño al select de cantidad de registros
});

// Función para confirmar la eliminación con SweetAlert
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