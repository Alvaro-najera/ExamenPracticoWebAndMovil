<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>
<html>
<head>
	<title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
    <link href="css/cmce-styles.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="insertar.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
	<div class="container-fluid">
    	<a class="navbar-brand"><b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?></a> 
		<a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
  </div>
</nav>
<center>
	<br><br><br><br>
		

	<form action="dashboard.php" method="GET">
	<div class="formpanel" id="f1">
		<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
		<button class="btn btn-primary" type="submit">Buscar</button>
	</div>
	</form>
	
	<br><br>
		<hr>
	<br><br>

	<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  		Nuevo Producto
	</button>

	<br><br>
<?php
    
    if (isset($_GET['eliminado']) && $_GET['eliminado'] === "exitoso") {
    echo "<script>
            // Abrir la ventana modal
            $('#mensajeModal').modal('show');
            // Establecer el mensaje en el cuerpo de la ventana modal
            $('#mensajeModalBody').html('Producto eliminado con éxito.');
          </script>";
}   
    
	include('conexion.php');
	$con = conectaDB();
	if(isset($_GET['pre'])==true)		
		$sql ="select idPro,Nombre,Precio from tb_productos where Precio > ".$_GET['pre'];
	else
		$sql ="select idPro,Nombre,Precio from tb_productos";
		
	echo "<table class='table' style='width:570;'>";
	echo "<thead class='table-dark'>";
	echo "<th>Nombre</th>";
	echo "<th>Precio</th>";
	echo "<th></th>";
	echo "</thead>";
	echo "<tbody>";
	
	$resultado = mysqli_query($con,$sql);  
	while($fila = mysqli_fetch_row($resultado)){
 	
        	echo "<tr>";
        echo "<td>".$fila[1]."</td>";
        echo "<td>".$fila[2]."</td>";
        echo "<td><a href='eliminar.php?idp=".$fila[0]."' onclick=\"return confirm('¿Estás seguro de que deseas eliminar este producto?')\"><img src='iconoeliminar.png' width='20' height='20'></a></td>";
        echo "</tr>";

	
	}
	
	echo "</tbody> </table>";
?>
<br><br>
	<!-- Modal Ventada de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

     <!-- Formulario de registro -->
     <div id="exitoMensaje" class="alert alert-success" style="display: none;">
    Producto guardado con éxito.
    </div>
<div class="modal-body">
  <form id="formularioRegistro">
    <div class="mb-3">
      <label for="nombreProducto" class="form-label">Nombre del Producto:</label>
      <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
    </div>
    <div class="mb-3">
      <label for="precioProducto" class="form-label">Precio:</label>
      <input type="text" class="form-control" id="precioProducto" name="precioProducto" required>
    </div>
    <div class="mb-3">
      <label for="existenciaProducto" class="form-label">Existencia:</label>
      <input type="text" class="form-control" id="existenciaProducto" name="existenciaProducto" required>
    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
  <button type="button" class="btn btn-success" id="guardarProducto">Guardar</button>
</div>
    </div>
  </div>
</div>



</center>

    <!-- Footer -->
    <footer class="footer bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white" ><b> Desarrollo de aplicaciones web y móviles   [ Alvaro Najera Verdugo And Alejandro Gomez Alvarado] </b></p>
      </div>
    </footer>

</body>
</html>