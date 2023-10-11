<?php

if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    // Realiza la validación con la base de datos (debes definir la conexión a la base de datos en tu archivo "conexion.php")
    include('conexion.php');
    $con = conectaDB();
    
    // Consulta SQL para verificar el usuario y contraseña
    $sql = "SELECT * FROM tb_usuarios WHERE NomUser = ? AND Passwd = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Usuario y contraseña válidos
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['nomusuario'] = $username;
        // Puedes obtener más datos del usuario si es necesario y almacenarlos en la sesión
        // Ejemplo: $_SESSION['nom_completo'] = $row['nombre_completo'];

        echo json_encode(array('success' => 1));
    } else {
        // Usuario y/o contraseña incorrectos
        echo json_encode(array('success' => 0));
    }

    $stmt->close();
    $con->close(); // Cierra la conexión a la base de datos
} else {
    // Datos de inicio de sesión incompletos
    echo json_encode(array('success' => 0));
}
?>
