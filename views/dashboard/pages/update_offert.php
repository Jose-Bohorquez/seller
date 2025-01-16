<!-- Page header -->
<div class="full-box page-header">
    <h3 class="text-left">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; ACTUALIZAR OFERTA
    </h3>
    <p class="text-justify">
        Desde esta vista puedes actualizar la oferta seleccionada.
    </p>
</div>

<div class="container-fluid">
    <ul class="full-box list-unstyled page-nav-tabs">
        <li>
            <a href="?c=Offers&a=create_offer"><i class="fas fa-plus fa-fw"></i> &nbsp; AGREGAR OFERTA</a>
        </li>
        <li>
            <a href="?c=Offers&a=read_offer"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE OFERTAS</a>
        </li>
    </ul>
</div>

<!-- Content here-->
<div class="container-fluid">
    <form action="?c=Offerts&a=update_offer" method="POST" class="form-neon" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $offer->get_id(); ?>">
        <fieldset>
            <legend><i class="fas fa-gift"></i> &nbsp; Información de la Oferta</legend>
            <div class="container-fluid">
                <div class="row">
                    <!-- Campo Producto -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="product_id" class="bmd-label-floating">ID Producto</label>
                            <input name="product_id" type="text" class="form-control" value="<?php echo $offer->get_product_id(); ?>" required maxlength="20">
                        </div>
                    </div>

                    <!-- Campo Descuento -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="discount" class="bmd-label-floating">Descuento (%)</label>
                            <input name="discount" type="number" class="form-control" value="<?php echo $offer->get_discount(); ?>" required step="0.01" min="0" max="100" maxlength="5">
                        </div>
                    </div>

                    <!-- Campo Plazo -->
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label for="term" class="bmd-label-floating">Plazo (en días)</label>
                            <input name="term" type="number" class="form-control" value="<?php echo $offer->get_term(); ?>" required min="1" maxlength="3">
                        </div>
                    </div>

                    <!-- Campo Imagen -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="offer_image" class="bmd-label-floating">Imagen de la oferta</label>
                            <input type="file" class="form-control" name="offer_image" id="offer_image">
                            <!-- Mostrar la imagen actual si existe -->
                            <?php if ($offer->get_image()): ?>
                                <div class="mt-2">
                                    <label>Imagen actual:</label>
                                    <img src="<?php echo $offer->get_image(); ?>" alt="Imagen actual" width="100" class="img-fluid">
                                    <input type="hidden" name="existing_image" value="<?php echo $offer->get_image(); ?>"> <!-- Mantener la imagen existente -->
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <br><br><br>
        <p class="text-center" style="margin-top: 40px;">
            <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR</button>
            &nbsp; &nbsp;
            <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ACTUALIZAR OFERTA</button>
        </p>
    </form>
</div>
