<?php

require_once('app/config/database.php');
require_once('app/controllers/Sql.php');

$users = new Sql('user');

$todos_os_usuarios = $users->select('id, name, email');

echo json_encode($todos_os_usuarios);

echo '<hr>';

foreach($todos_os_usuarios as $usuario) {
    echo 'Nome: ' . $usuario->name . '<br>';
    echo 'Email: ' . $usuario->email . '<br>';
    echo '<hr>';
}

?>