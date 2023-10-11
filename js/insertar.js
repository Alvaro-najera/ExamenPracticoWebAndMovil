$(document).ready(function(){
	// Listen to login button
	$('#guardarProducto').on('click', function(){
		guardarProduto();
	});
});

function guardarProduto() {
    // Obtener los valores del formulario
    var nombreProducto = $("#nombreProducto").val();
    var precioProducto = $("#precioProducto").val();
    var existenciaProducto = $("#existenciaProducto").val();

    if (nombreProducto === '' || precioProducto === '' || existenciaProducto === '') {
        alert('Por favor, complete todos los campos.');
        return; // Detener el envío del formulario si faltan datos
    }

    console.log("Nombre: " + nombreProducto);
    console.log("Precio: " + precioProducto);
    console.log("Existencia: " + existenciaProducto);

    // Enviar los datos al servidor utilizando AJAX
    $.ajax({
        url: 'controller/insertar.php',
        method: "POST",
        data: {
            nombreProducto: nombreProducto,
            precioProducto: precioProducto,
            existenciaProducto: existenciaProducto
        },
        success: function(response) {
            // Procesar la respuesta del servidor
            var resultado = JSON.parse(response);
            if (resultado.status == "success") {
                // Cerrar la ventana modal
                $("#exampleModal").modal("hide");

                // Actualizar la página o realizar otras acciones según tus necesidades
                location.reload();
            } else {
                // Mostrar un mensaje de error si es necesario
                alert("Error al guardar el producto.");
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
        }
    });
}



