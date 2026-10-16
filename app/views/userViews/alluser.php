<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h1>Usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Correo</th>
                <th>Username</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Role</th>
                <th>Estado de cuenta</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= htmlspecialchars((string) $usuario->id, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->nombre, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->apellido_paterno, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->apellido_materno, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->correo, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->username, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->created_at, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->updated_at, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->role, ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars((string) $usuario->estado_cuenta, ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
</body>
</html>
