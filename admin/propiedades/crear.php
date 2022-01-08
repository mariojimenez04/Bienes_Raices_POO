<?php

include '../../includes/app.php';
// Proteger esta ruta.

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$db = conectarDb();

$propiedad = new Propiedad;

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// Leer datos del formulario... 

// Validar 

$errores = Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $propiedad = new Propiedad($_POST);

    $imagePath = md5(uniqid(rand(), true)) . ".jpg";

    if( $_FILES['imagen']['tmp_name'] ) {
        //Setear la imagen
        //Realizar fit a la imagen
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(500,500);
        $propiedad->setImage($imagePath);
    }
    
    //Validar
    $errores = $propiedad->validate();
    // El array de errores esta vacio
    if (empty($errores)) {
        //Subir la imagen
        if ( !is_dir( CARPETA_IMAGENES ) ) {
            mkdir( CARPETA_IMAGENES );
        }
        
        //Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $imagePath);

        $resultado = $propiedad->save_record();

        if ($resultado) {
            header('location: /admin/index.php?mensaje=1');
        }
    }
}
?>

<?php
    incluirTemplate('header');
?>

<h1 class="fw-300 centrar-texto">Administración - Nueva Propiedad</h1>

<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <div class="mt-3">
        <?php foreach ($errores as $error) : ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        
    <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplate('footer');

mysqli_close($db); ?>

</html>