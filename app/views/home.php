<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?php echo htmlspecialchars($titulo); ?> </title>
</head>
<body>
    <h1>Test Room</h1>
    <div id="navigation" class="navigation">
        <ul>
            <li> <a href="/">HOME</a> </li>
            <li> <a href="/alluser">Todos los Usuarios</a> </li>
            <li> <a href="/formuser/crear">Formulario de Crear Formulario</a> </li>
            <li> <a href="/formuser/iniciar">Formulario de Iniciar Usuario</a> </li>
            <li> <a href="/formuser/verificar">Verificar Cuentas</a> </li>
        </ul>
    </div>
	<h6> EJ: </h6>
	<p> <?php echo htmlspecialchars($descripcion); ?> </p>
</body>
</html>
