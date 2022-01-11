<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

include '../../includes/app.php';
// Proteger esta ruta.
estaAutenticado();

// Verificar el id
$id =  $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if(!$id) {
    header('Location: /admin');
}

//Encontrar propiedad a editar
$propiedad = Propiedad::find($id);

//Validacion
$errores = Propiedad::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->syncUp($args);

    $errores = $propiedad->validate();

    //Subir Archivos
    //Generar nombre de imagen
    $imageName = md5(uniqid(rand(), true)) . ".jpg";

    if( $_FILES['propiedad']['tmp_name']['imagen'] ) {
        //Setear la imagen
        //Realizar fit a la imagen
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(500,500);
        $propiedad->setImage($imageName);
    }

    // El array de errores esta vacio
    if (empty($errores)) {
        // Insertar en la BD.
        // echo "No hay errores";

        debuguear($propiedad);
        $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', descripcion = '${descripcion}', habitaciones = '${habitaciones}', wc = '${wc}', estacionamiento = '${estacionamiento}', vendedorId = '${vendedor}', imagen = '${rutaImagen}'  WHERE id = '${id}' ";
        // echo $query;


        $resultado = mysqli_query($db, $query) or die(mysqli_error($db));
        // var_dump($resultado);
        // printf("Nuevo registro con el id %d.\n", mysqli_insert_id($db));

        if ($resultado) {
            header('location: /admin/index.php?mensaje=2');
        }
    }

    // Insertar en la BD.


}





?>

<?php
$nombrePagina = 'Crear Propiedad';
incluirTemplate('header');
?>

<h1 class="fw-300 centrar-texto">Administración - Editar Propiedad</h1>

<main class="contenedor seccion contenido-centrado">
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>

</main>


<?php

incluirTemplate('footer');

mysqli_close($db); ?>

</html>