<?php
global $db; 
class Oferta
{
    public $descuento;
    public $duracion;
    public $imagenNombre;
    public $titulo;
    public $subtitulo;
    public $descripcionOferta;

    private $ofertaImagen; // Instancia para la imagen y descuento
    private $ofertaTexto; // Instancia para el texto

    public function __construct()
    {
        // El constructor ya no recibe argumentos
    }

    public function crearOferta()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $producto_id = $_POST['producto'];
            $descuento = $_POST['descuento'];
            $duracion = $_POST['duracion'];
    
            // Obtener la información del producto usando PDO
            $sql = "SELECT * FROM productos WHERE id = :producto_id"; 
            $stmt = DataBase::connection()->prepare($sql);
            $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $producto = $stmt->fetch(PDO::FETCH_ASSOC);
                $precioOriginal = $producto['precio'];
                $imagen = $producto['imagen'];
    
                // Calcular el precio con descuento
                $precioDescuento = $precioOriginal - ($precioOriginal * ($descuento / 100));
    
                // Guardar la oferta en la base de datos
                $sql = "INSERT INTO ofertas (producto_id, descuento, duracion, imagen, precio_descuento) 
                        VALUES (:producto_id, :descuento, :duracion, :imagen, :precioDescuento)";
                $stmt = DataBase::connection()->prepare($sql);
                $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
                $stmt->bindParam(':descuento', $descuento, PDO::PARAM_INT);
                $stmt->bindParam(':duracion', $duracion, PDO::PARAM_INT);
                $stmt->bindParam(':imagen', $imagen, PDO::PARAM_STR);
                $stmt->bindParam(':precioDescuento', $precioDescuento);
    
                if ($stmt->execute()) {
                    // Obtener la ruta de la imagen
                    $imagenRuta = "img" . $imagen; // Ajusta la ruta según tu estructura de archivos
    
                    // Obtener la URL de la oferta (esto puede variar según tu aplicación)
                    $ofertaURL = "oferta" . $producto_id; // Ajusta la URL según tu aplicación
    
                    // Redirigir a la página de éxito y pasar la información de la oferta
                    header("Location: ?c=Oferta&a=crearOferta&exito=1&imagen=" . urlencode($imagenRuta) . "&url=" . urlencode($ofertaURL));
                    exit(); // Asegurar que el script se detenga después de la redirección
                } else {
                    echo "Error al crear la oferta: " . $stmt->errorInfo()[2]; 
                }
            } else {
                echo "Producto no encontrado.";
            }
        }
    }

    public function subirOfertaImagen()
    {
        session_start();
        $errors = array();
        $mensajeExito = "";

        // Obtener la extensión del archivo
        if (isset($_FILES['imagen']['name'])) {
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

            if (!in_array($extension, $allowedExtensions)) {
                $errors['imagen'] = 'La imagen debe tener una extensión válida.';
            }
        } else {
            $errors['imagen'] = 'No se ha seleccionado ninguna imagen.';
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/vendedor/menu/header.php";
            require_once "views/vendedor/menu/oferta.php"; // Vista para la imagen y descuento
            require_once "views/vendedor/menu/footer.php";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($_POST['descuento'])) {
                $errors['descuento'] = 'Por favor, ingresa el descuento.';
            }

            if (empty($errors)) {
                $imagenNombre = uniqid() . '.' . $extension;
                $target_dir = "img/";
                $target_file = $target_dir . basename($imagenNombre);

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                    // ---->  Crear la instancia aquí, con la información de la imagen
                    $this->ofertaImagen = new Oferta($_POST['descuento'], $_POST['duracion'], $imagenNombre);

                    try {
                        $this->ofertaImagen->crearOferta();
                        $mensajeExito = "Imagen de oferta creada con éxito.";
                        header("Location: ?c=Oferta&a=subirOfertaImagen&exito=1");
                    } catch (Exception $e) {
                        $errors['db'] = "Error al crear la oferta: " . $e->getMessage();
                    }
                } else {
                    $errors['imagen'] = 'Error al subir la imagen.';
                }
            }
        }

        require_once "views/vendedor/menu/header.php";
        require_once "views/vendedor/menu/oferta.php";
        require_once "views/vendedor/menu/footer.php";
    }

    public function subirTextoOferta()
    {
        session_start();
        $errors = array();
        $mensajeExito = "";

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once "views/vendedor/menu/header.php";
            require_once "views/vendedor/menu/texto_oferta.php"; // Nueva vista para el texto
            require_once "views/vendedor/menu/footer.php";
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validaciones para el texto
            if (empty($_POST['titulo'])) {
                $errors['titulo'] = 'Por favor, ingresa el título de la oferta.';
            }
            if (empty($_POST['subtitulo'])) {
                $errors['subtitulo'] = 'Por favor, ingresa el subtítulo de la oferta.';
            }
            if (empty($_POST['descripcionOferta'])) {
                $errors['descripcionOferta'] = 'Por favor, ingresa la descripción de la oferta.';
            }

            if (empty($errors)) {
                try {
                    $this->ofertaTexto->crearOferta(); // Guardar el texto de la oferta
                    $mensajeExito = "Texto de la oferta creado con éxito.";
                    header("Location: ?c=Oferta&a=subirTextoOferta&exito=1");
                } catch (Exception $e) {
                    $errors['db'] = "Error al crear el texto de la oferta: " . $e->getMessage();
                }
            }
        }

        require_once "views/vendedor/menu/header.php";
        require_once "views/vendedor/menu/texto_oferta.php";
        require_once "views/vendedor/menu/footer.php";
    }

    public function cerrarSecion()
    {
        session_start();
        session_destroy();
        header("Location: ?c=menu ");
    }
    function obtenerImagenesOfertas() {
        $sql = "SELECT imagen FROM ofertas"; 
        $result = DataBase::connection()->query($sql);
        $imagenes = [];
        if ($result) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $imagenes[] = "img/" . $row['imagen']; // Si las imágenes están en la carpeta "img"
            }
        }
        return $imagenes;
    }
}
?>