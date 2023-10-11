<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreProducto = $_POST['nombreProducto'];
    $precioProducto = $_POST['precioProducto'];
    $existenciaProducto = $_POST['existenciaProducto'];
    // Realizar la conexión a la base de datos (debes definir la función conectaDB() en tu archivo "conexion.php")
    include('conexion.php');
    $con = conectaDB();
    // Insertar los datos en la tabla "tb_productos" (asumiendo que "idPro" es autoincremental)
    $sql = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$nombreProducto', $precioProducto, $existenciaProducto)";
    if (mysqli_query($con, $sql)) {
        // Enviar una respuesta JSON exitosa
        echo json_encode(["status" => "success"]);
    } else {
        // Enviar una respuesta JSON de error
        echo json_encode(["status" => "error"]);
    }
    // Cerrar la conexión a la base de datos
    mysqli_close($con);
}
?>
