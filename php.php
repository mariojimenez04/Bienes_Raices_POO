<?php
    // Sanitizar va a hacer eso, limpiar los datos 
    // $estacionamiento = filter_var($numero, FILTER_SANITIZE_NUMBER_INT);

    // // Validar va a revisar que sea un tipo de dato valido.
    // $estacionamiento = filter_var($numero, FILTER_VALIDATE_INT);

    // Existe otra opción llamada mysqli_real_escape_string, esta función va a eliminar los caracteres especiales o escaparlos para hacerlos compatibles con la base de datos.
    
    // $titulo = mysqli_real_escape_string( $db, $_POST['titulo'] );
    
    // Todo esto de escapar datos y asegurarlos se puede evitar con Sentencias preparadas(inyeccion SQL)

     // mkdir(dirname($imagePath));
        // $rutaImagen = str_replace($carpetaImagenes, '', $imagePath);
