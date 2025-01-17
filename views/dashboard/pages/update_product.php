<!-- Page header -->
<div class="full-box page-header">
  <h3 class="text-left">
    <i class="fas fa-edit fa-fw"></i> &nbsp; ACTUALIZAR PRODUCTO
  </h3>
  <p class="text-justify">
    Desde esta vista puedes actualizar los detalles de un producto existente.
  </p>
</div>

<div class="container-fluid">
  <ul class="full-box list-unstyled page-nav-tabs">
    <li>
      <a href="?c=Products&a=create_product"><i class="fas fa-plus fa-fw"></i> &nbsp; CREAR PRODUCTO</a>
    </li>
    <li>
      <a class="active" href="?c=Products&a=read_product"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE PRODUCTOS</a>
    </li>
  </ul>  
</div>

<!-- Content here-->
<div class="container-fluid">
  <form action="?c=Products&a=update_product" method="POST" class="form-neon" enctype="multipart/form-data">
    <fieldset>
      <legend><i class="fas fa-box"></i> &nbsp; Información del Producto</legend>
      <div class="container-fluid">
        <div class="row">
          <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">
          <!-- Campo Nombre -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_nombre" class="bmd-label-floating">Nombre del Producto</label>
              <input name="product_name" type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 + ]{1,100}" class="form-control" id="producto_nombre" maxlength="100" required value="<?php echo $product->get_name(); ?>">
            </div>
          </div>
          
          <!-- Campo Descripción -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_descripcion" class="bmd-label-floating">Descripción del Producto</label>
              <textarea name="product_description" class="form-control" id="producto_descripcion" rows="4" maxlength="2000" required><?php echo $product->get_description(); ?></textarea>
            </div>
          </div>
          
          <!-- Campo Descripción Técnica -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_descripcion_tecnica" class="bmd-label-floating">Descripción Técnica</label>
              <textarea name="product_technical_description" class="form-control" id="producto_descripcion_tecnica" rows="4" maxlength="2000"><?php echo $product->get_technical_description(); ?></textarea>
            </div>
          </div>

          <!-- Campo Precio -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_precio" class="bmd-label-floating">Precio</label>
              <input name="product_price" type="number" step="0.01" class="form-control" id="producto_precio" maxlength="10" required value="<?php echo $product->get_price(); ?>">
            </div>
          </div>

          <!-- Campo Cantidad -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_cantidad" class="bmd-label-floating">Cantidad</label>
              <input name="product_amount" type="number" class="form-control" id="producto_cantidad" min="1" required value="<?php echo $product->get_amount(); ?>">
            </div>
          </div>

          <!-- Campo Categoría (select) -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_categoria" class="bmd-label-floating">Categoría</label>
              <select class="form-control" name="product_category" id="producto_categoria" required>
                <option value="1" <?php echo ($product->get_category() == 1) ? 'selected' : ''; ?>>Celulares</option>
                <option value="2" <?php echo ($product->get_category() == 2) ? 'selected' : ''; ?>>Computadores</option>
                <option value="3" <?php echo ($product->get_category() == 3) ? 'selected' : ''; ?>>Equipos usados</option>
              </select>
            </div>
          </div>

          <!-- Campo Imagen -->
          <div class="col-12 col-md-6">
            <div class="form-group">
              <label for="producto_imagen" class="bmd-label-floating">Imagen del Producto</label>
              <input type="hidden" name="existing_image" value="<?php echo $product->get_image(); ?>">
              <!-- Si hay imagen, mostrarla como miniatura -->
              <div class="mb-2">
                <?php if ($product->get_image()): ?>
                  <img src="<?php echo $product->get_image(); ?>" alt="Imagen del Producto" width="100">
                <?php else: ?>
                  <span>No disponible</span>
                <?php endif; ?>
              </div>
              <input name="product_image" type="file" class="form-control" id="producto_imagen" accept="image/*">
            </div>
          </div>
          
        </div>
      </div>
    </fieldset>
    <br><br><br>
    <p class="text-center" style="margin-top: 40px;">
      <button type="reset" class="btn btn-raised btn-secondary btn-sm"><i class="fas fa-paint-roller"></i> &nbsp; LIMPIAR / BORRAR</button>
      &nbsp; &nbsp;
      <button type="submit" class="btn btn-raised btn-info btn-sm"><i class="far fa-save"></i> &nbsp; ACTUALIZAR PRODUCTO</button>
    </p>
  </form>
</div>
