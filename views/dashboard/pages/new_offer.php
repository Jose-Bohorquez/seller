<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-plus fa-fw"></i> &nbsp; CREAR OFERTA
    </h3>
    <p class="text-justify">
        Desde esta vista se puede crear una nueva oferta en el sistema.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a class="active" href="?c=Offers&a=create_offer"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR OFERTA</a>
        </li>
        <li>
            <a href="?c=Offerts&a=read_offer"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE OFERTAS</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <form action="?c=Offerts&a=create_offer" method="POST" class="form-neon" enctype="multipart/form-data">
        <fieldset>
            <legend><i class="fas fa-gift"></i> &nbsp; Información de la Oferta</legend>
            <div class="container-fluid">
                <div class="row">
                    <!-- Campo Producto -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="product_id" class="bmd-label-floating">Producto</label>
                            <select name="product_id" id="product_id" class="form-control" required onchange="showProductImage()">
                                <option value="" disabled selected>Seleccione un Producto</option>
                                <?php
                                // Verifica si $products contiene datos antes de recorrerlo
                                if (!empty($products)) {
                                    foreach ($products as $product) {
                                        // Accedemos a las propiedades del objeto Product usando la notación de objeto
                                        echo "<option value='{$product->get_id()}' data-image='{$product->get_image()}'>
                                                ID: {$product->get_id()} - Nombre: {$product->get_name()} - Precio: {$product->get_price()} - Cantidad: {$product->get_amount()}
                                              </option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No hay productos disponibles</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Campo Imagen del Producto (se actualizará después de seleccionar el producto) -->
                    <div class="col-12 col-md-6" id="product-image-container">
                        <div class="form-group">
                            <label>Imagen del Producto</label>
                            <div id="product-image">
                                <!-- Aquí se actualizará la imagen seleccionada -->
                                <img src="" alt="Imagen del Producto" class="img-fluid" style="display: none; max-width: 150px; height: auto;">
                            </div>
                        </div>
                    </div>

                    <!-- Campo Descuento -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="discount" class="bmd-label-floating">Descuento (%)</label>
                            <input name="discount" type="number" class="form-control" required step="0.01" min="0" max="100" maxlength="5">
                        </div>
                    </div>

                    <!-- Campo Plazo -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="term" class="bmd-label-floating">Plazo (en días)</label>
                            <input name="term" type="number" class="form-control" required min="1" maxlength="3">
                        </div>
                    </div>

                    <!-- Campo Imagen de la Oferta -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="offer_image" class="bmd-label-floating">Imagen de la oferta</label>
                            <input type="file" class="form-control" name="offer_image" id="offer_image">
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; CREAR OFERTA</button>
        </p>
    </form>
</div>

<!-- Script para mostrar la imagen del producto al seleccionar -->
<script>
function showProductImage() {
    var select = document.getElementById("product_id");
    var selectedOption = select.options[select.selectedIndex];
    var imageUrl = selectedOption.getAttribute("data-image");

    // Mostrar la imagen si hay una seleccionada
    var imageContainer = document.getElementById("product-image");
    var imgElement = imageContainer.getElementsByTagName("img")[0];

    if (imageUrl) {
        imgElement.style.display = "block"; // Mostrar la imagen
        imgElement.src = imageUrl; // Cambiar la imagen
    } else {
        imgElement.style.display = "none"; // Ocultar si no hay imagen
    }
}
</script>
