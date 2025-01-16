<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Producto</title>
    <link rel="stylesheet" href="ofertas.css">
</head>
<body>

    <div class="contenedor">
    <div class="formulario-contenedor">
    <?php 
    global $db; 

    if (isset($_GET['exito']) && $_GET['exito'] == 1): ?>
        <div class="alert alert-success">
            Oferta creada con éxito.
        </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="?c=Oferta&a=crearOferta" method="POST">
        <fieldset>
            <legend>Crear Oferta</legend>

            <label for="producto">Producto:</label>
            <select name="producto" id="producto" required>
                <option value="">Selecciona un producto</option>
                <?php
                $sql = "SELECT id, nombreP FROM productos";
                $result = DataBase::connection()->query($sql);
                // Verificar si hay resultados
                if ($result) { 
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["id"] . "'>" . $row["nombreP"] . "</option>";
                    }
                } else {
                    echo "<option value=''>No se encontraron productos.</option>"; // Mostrar un mensaje dentro del select
                }
                ?>
            </select>

            <label for="descuento">Descuento (%):</label>
            <input type="number" name="descuento" id="descuento" required>

            <label for="duracion">Duración (días):</label>
            <input type="number" name="duracion" id="duracion" required>

            <button type="submit">Crear Oferta</button>
        </fieldset>
    </form>
</div>

    <div class="image-preview" id="imagePreview"></div>

    </div>

</body>
</html>