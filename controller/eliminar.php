<?php
if (isset($_GET['idp'])) {
    // Obtener el ID del producto a eliminar desde el parámetro GET
    $idProducto = $_GET['idp'];

    // Realizar la conexión a la base de datos (debes definir la función conectaDB() en tu archivo "conexion.php")
    include('conexion.php');
    $con = conectaDB();

    // Eliminar el producto de la tabla "tb_productos"
    $sql = "DELETE FROM tb_productos WHERE idPro = $idProducto";

    if (mysqli_query($con, $sql)) {
    // Redirigir de vuelta a dashboard.php después de eliminar el producto con un parámetro de éxito
    header("Location: dashboard.php?eliminado=exitoso");
    exit;
    } else {
        // Manejar el error si la eliminación falla
        echo "Error al eliminar el producto.";
    }


    // Cerrar la conexión a la base de datos
    mysqli_close($con);
} else {
    echo "ID de producto no proporcionado.";
}
?>