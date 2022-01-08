<?php 

    // Consultar la propiedad
    include 'includes/app.php';
    $db = conectarDb();


    // Inserta un admin
    $email = "correo@correo.com";
    $password = "hola";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    // echo strlen($passwordHash);


    // echo $passwordHash;


    $query = "INSERT INTO usuarios (email, password) VALUES('${email}', '${passwordHash}') ";

    mysqli_query($db, $query);


?>