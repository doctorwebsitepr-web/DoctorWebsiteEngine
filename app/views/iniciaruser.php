<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?php echo htmlspecialchars($titulo); ?> </title>
</head>
<body>
	<h1> Formulario de usuario: </h1>
    <p> <?php echo htmlspecialchars($descripcion); ?> </p>
    <form action="/formuseriniciar" method="post">       

        <label for="username"> UserName </label>
        <input type="text" name="username">

        <label for="email"> Email: </label>      
        <input type="email" name="email">  

        <label for="password"> Password </label>
        <input type="password" name="password">

        <input type="submit" value="Submit">
    </form>
</body>
</html>
